<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use App\Traits\Tenantable;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Exception;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Contracts\PartyContract;
use LaravelDaily\Invoices\Traits\CurrencyFormatter;
use LaravelDaily\Invoices\Traits\DateFormatter;
use LaravelDaily\Invoices\Traits\InvoiceHelpers;
use LaravelDaily\Invoices\Traits\SavesFiles;
use LaravelDaily\Invoices\Traits\SerialNumberFormatter;



class PDFEstimatePDF
{
    // use HasFactory;
    // use HasAdvancedFilter;
    // use SoftDeletes;
    // use Tenantable;
    // use Auditable;

    use CurrencyFormatter;
    use DateFormatter;
    use InvoiceHelpers;
    use SavesFiles;
    use SerialNumberFormatter;

    const TABLE_COLUMNS = 4;

    /**
     * @var string
     */
    public $name;

        /**
     * @var string
     */
    public $estimate_title;

    /**
     * @var PartyContract
     */
    public $seller;

    /**
     * @var PartyContract
     */
    public $buyer;

    // /**
    //  * @var Collection
    //  */
    // public $items;

    /**
     * @var Collection
     */
    public $rooms;

    /**
     * @var Collection
     */
    public $pdfEstimateItem;

    /**
     * @var string
     */
    public $template;

    /**
     * @var string
     */
    public $filename;

    /**
     * @var string
     */
    public $notes;

    /**
     * @var string
     */
    public $logo;

    /**
     * @var int
     */
    public $table_columns;

    /**
     * @var PDF
     */
    public $pdf;

    /**
     * @var string
     */
    public $output;

    /**
     * @var mixed
     */
    protected $userDefinedData;

    /**
     * Invoice constructor.
     * @param string $name
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct($name = 'Estimate')
    {
        // Invoice
        $this->name     = $name;

        $this->seller   = app()->make(config('invoices.seller.class'));
        //$this->items    = Collection::make([]);
        $this->rooms    = Collection::make([]);
        //$this->template = 'default';
        $this->template = 'estimate';


        // Date
        $this->date           = Carbon::now();
        $this->date_format    = config('invoices.date.format');
        $this->pay_until_days = config('invoices.date.pay_until_days');

        // Serial Number
        $this->series               = config('invoices.serial_number.series');
        $this->sequence_padding     = config('invoices.serial_number.sequence_padding');
        $this->delimiter            = config('invoices.serial_number.delimiter');
        $this->serial_number_format = config('invoices.serial_number.format');
        $this->sequence(config('invoices.serial_number.sequence'));

        // Filename
        $this->filename($this->getDefaultFilename($this->name));

        // Currency
        $this->currency_code                = config('invoices.currency.code');
        $this->currency_fraction            = config('invoices.currency.fraction');
        $this->currency_symbol              = config('invoices.currency.symbol');
        $this->currency_decimals            = config('invoices.currency.decimals');
        $this->currency_decimal_point       = config('invoices.currency.decimal_point');
        $this->currency_thousands_separator = config('invoices.currency.thousands_separator');
        $this->currency_format              = config('invoices.currency.format');

        $this->disk          = config('invoices.disk');
        $this->table_columns = static::TABLE_COLUMNS;
    }

    /**
     * @param string $name
     * @return EstimatePDF
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function make($name = 'EstimatePDF')
    {
        return new static($name);
    }

    /**
     * @param array $attributes
     * @return Party
     */
    public static function makeParty(array $attributes = [])
    {
        return new Party($attributes);
    }

    // /**
    //  * @param string $title
    //  * @return InvoiceItem
    //  */
    // public static function makeItem(string $title = '')
    // {
    //     return (new InvoiceItem())->title($title);
    // }

    /**
     * @param string $title
     * @return PDFRoomItem
     */
    public static function makeRoom(string $title = '')
    {
        return (new PDFRoomItem())->roomTitle($title);
    }

    public function getLogoFileNow()
    {
        //dd($this->logo);
        $type   = pathinfo($this->logo, PATHINFO_EXTENSION);

        $data   = file_get_contents($this->logo);
        dd($data);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        return $base64;
    }

    /**
     * @param PDFRoomItem $item
     * @return $this
     */
    public function addRoom(PDFRoomItem $room)
    {
        //dd('reached');
        $this->rooms->push($room);

        foreach($room->workitems as $i){
            foreach($i as $a){
                //dd($a);
                //dd($a->workitemName . " " . $a->workitemQuantity);
            }
        }

        return $this;
    }

    /**
     * @param $rooms
     * @return $this
     */
    public function addRooms($rooms)
    {
        //print_r($rooms);
        foreach ($rooms as $room) {
            foreach($room as $i){
                //dd($i);
                $this->addRoom($i);
            }
        }
        return $this;
    }


    /**
     * @param $estimateItem
     * @return $this
     */
    public function addEstimateItem($estimateItem)
    {
        $this->estimateItem = $estimateItem;

        //dd($this->estimateItem);
        return $this;
    }


    // /**
    //  * @param InvoiceItem $item
    //  * @return $this
    //  */
    // public function addRoomDetail(InvoiceItem $item)
    // {
    //     $this->items->push($item);

    //     return $this;
    // }

    // /**
    //  * @param InvoiceItem $item
    //  * @return $this
    //  */
    // public function addItem(InvoiceItem $item)
    // {
    //     $this->items->push($item);

    //     return $this;
    // }

    // /**
    //  * @param $items
    //  * @return $this
    //  */
    // public function addItems($items)
    // {
    //     foreach ($items as $item) {
    //         $this->addItem($item);
    //     }

    //     return $this;
    // }

    /**
     * @return $this
     * @throws Exception
     */
    public function render()
    {
        if (!$this->pdf) {
            //$this->beforeRender(); (this calls src\trait\ validate & caluclate)

            $template = sprintf('invoices::templates.%s', $this->template);
            $view     = View::make($template, ['invoice' => $this]);
            $html     = mb_convert_encoding($view, 'HTML-ENTITIES', 'UTF-8');

            $this->pdf    = PDF::setOptions(['enable_php' => true])->loadHtml($html);
            $this->output = $this->pdf->output();
        }

        return $this;
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function stream()
    {
        $this->render();

        return new Response($this->output, Response::HTTP_OK, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $this->filename . '"',
        ]);
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function download()
    {
        $this->render();

        return new Response($this->output, Response::HTTP_OK, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $this->filename . '"',
            'Content-Length'      => strlen($this->output),
        ]);
    }
}
