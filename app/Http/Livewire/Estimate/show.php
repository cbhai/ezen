<?php

namespace App\Http\Livewire\Estimate;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Branding;
use App\Models\BusinessProfile;
use App\Models\Estimate;
use App\Models\EstimateDetail;
use App\Models\PDFEstimateDetailsItem;
use App\Models\PDFEstimateItem;
use App\Models\PDFEstimatePDF;
use App\Models\PDFRoomItem;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use LaravelDaily\Invoices\Classes\EstimateDetailsItem;
use LaravelDaily\Invoices\Classes\EstimateItem;
use LaravelDaily\Invoices\Classes\Party;

class Show extends Component
{
    public BusinessProfile $businessProfile;
    public Estimate $estimate;
    public $tableArray = [];
    public $tableArrayRoomID = [];
    public $tableArrayRoomTotal = [];

    public $allRooms = [];

    public $arrEstimateDetails = [];

    public $roomDetailHolder = [];

    public function mount($estimate)
    {
        //dd($estimate->owner_id);
        $this->businessProfile = BusinessProfile::where('owner_id', $estimate->owner_id)->first();

        $this->estimate = $estimate;

        $this->allRooms = Room::all();

        $this->tableArrayRoomID = EstimateDetail::where('estimate_id', $this->estimate->id)
        ->distinct('room_id')->pluck('room_id');



        foreach($this->tableArrayRoomID as $key => $item){

            $rtotal = EstimateDetail::where('estimate_id', $this->estimate->id)
            ->where('room_id', "=" , $this->tableArrayRoomID[$key])
            ->pluck('total')->sum();

            //$room =  $this->allRooms->where('id', $this->tableArrayRoomID[$key])->first();
            $room = $this->allRooms->where('id', $this->tableArrayRoomID[$key])->first();

            $this->tableArray[] = [
            'room_id' => $this->tableArrayRoomID[$key],
            'roomName' => $room->name,
            'roomTotal' => $rtotal,
            ];

            $estDetailsEditmode = EstimateDetail::where([
                'estimate_id' => $this->estimate->id,
                'room_id'   => $this->tableArrayRoomID[$key],
            ])->get();

            //load EstimateDetails for each room
            foreach($estDetailsEditmode as $item){
                //ddd($item);
                // $this->arrEstimateDetails[] = [
                $this->arrEstimateDetails[] = [
                    'id' =>$item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'unit' => $item->unit,
                    'rate' => $item->rate,
                    'quantity' => $item->quantity,
                    'total' => $item->total,
                    'estimate_id' => $item-> estimate_id,
                    'room_id' => $item-> room_id,
                    'is_saved' => true,
                    'row_type' => 'addAllWorkitems',
                ];
            }
        }

        //dd($this->arrEstimateDetails);
    }

    public function render()
    {

        return view('livewire.estimate.show');
    }

    public function print(){


        //$this->validate();
        if(count($this->tableArray) < 1  ){
            return;
        }

        $logo_url = "";
        $branding = Branding::where('owner_id', auth()->id())->first();

        foreach($branding->logo as $key => $entry){
            $logo_url = $entry['url'];
        }
        //dd($logo_url);
        //dd($branding->logo);
        if(empty($logo_url)){
            //$logo_url = asset('vendor/invoices/estimate-zen.png');
            $logo_url = public_path('vendor/invoices/estimate-zen.png');
        }

        //dd($logo_url);

        $pro = new Party([
            'business_name' => $this->businessProfile->company_name,
            'name'          => $this->businessProfile->fullName(),
            'phone'         => $this->businessProfile->phone,
            'email'         => $this->businessProfile->email,
            'address'       => isset($this->businessProfile->street_address) ? $this->businessProfile->street_address : "",
            'city'          => $this->businessProfile->city,
            'state'         => $this->businessProfile->state,
            'custom_fields' => [
                //'note'        => 'IDDQD',
                //'business id' => '365#GG',
            ],
        ]);


        $customer = new Party([
            'name'          => $this->estimate->customer->fullName() ,
            'phone'         => isset($this->estimate->customer->phone) ? $this->estimate->customer->phone : "",
            'email'         => isset($this->estimate->customer->email) ? $this->estimate->customer->email : "",
            'address'       => isset($this->estimate->customer->address) ? $this->estimate->customer->address : "",
            'city'          => isset($this->estimate->customer->city) ? $this->estimate->customer->city : "",
            'state'         => isset($this->estimate->customer->state) ? $this->estimate->customer->state : "",
            'custom_fields' => [
                //'order number' => '> 654321 <',
            ],
        ]);
        //$this->estimate->terms = $notes;

        //dd($this->estimate);
        //$this->estimate->terms = $this->estimate->estimate_terms;
        //$this->estimate->total = $this->estimate->total;


        $pdfEstimateItem = (new PDFEstimateItem())
                        ->EstimateID($this->estimate->id)
                        ->EstimateTitle($this->estimate->title)
                        ->EstimateTotal($this->estimate->total)
                        ->EstimateDate($this->estimate->date)
                        ->EstimateTerms($this->estimate->terms)
                        ->EstimateAddHeader(isset($this->estimate->header) ? $this->estimate->header : 0)
                        ->EstimateAddFooter (isset($this->estimate->footer) ? $this->estimate->footer : 0)
                        ->EstimateHeader($branding->header)
                        ->EstimateFooter($branding->footer);

        //dd($this->estimate->header . '-' . $this->estimate->footer);

        //dd($estimateItem);

        $now = Carbon::now();
        $unique_code = $now->format('YmdHi');
        $file_name = 'Estimate-' . $this->estimate->customer->fullName() . '-' . $unique_code . '.pdf';

        $pdfrooms = [];
        foreach($this->tableArray as $room){
            //dd($this->estimate->id . " " . $room['room_id']);

            $workitems = EstimateDetail::where([
                ['estimate_id', $this->estimate->id],
                ['room_id', $room['room_id']],
            ])->get();

            foreach($workitems as $item){

                $pdfitems[] = [
                    (new PDFEstimateDetailsItem())
                        ->WorkitemName($item['name'])
                        ->WorkitemDescription($item['description'])
                        ->WorkitemRate($item['rate'])
                        ->WorkitemUnit($item['unit'])
                        ->WorkitemQuantity($item['quantity'])
                        ->WorkitemTotal($item['total'])
                ];
            }


            $pdfrooms[] = [
                (new PDFRoomItem())->roomTitle($room['roomName'])->roomTotal($room['roomTotal'])->roomWorkitems($pdfitems)
            ];

            unset($pdfitems);
         }

         //dd($logo_url);

        $invoice = PDFEstimatePDF::make('Estimate')
            ->series('BIG')
            ->sequence(667)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($pro)
            ->buyer($customer)
            ->date(now()->subWeeks(3))
            ->dateFormat('d/m/Y')
            ->payUntilDays(14)
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($file_name)
            //->addItems($items)
            ->addRooms($pdfrooms)
            ->addEstimateItem($pdfEstimateItem)
            ->notes($this->estimate->terms)
            //->logo(public_path('vendor/invoices/sample-logo.png'))
            ->logo($logo_url)
            // You can additionally save generated invoice to configured disk
            ->save('public');

        $link = $invoice->url();
        // Then send email to party with link
        //dd($link);
        //dd($customer->name);
        return response()->streamDownload(function () use($invoice) {
            echo  $invoice->stream();
        }, $file_name);
    }

}
