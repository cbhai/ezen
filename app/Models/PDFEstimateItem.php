<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use App\Traits\Tenantable;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PDFEstimateItem extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use Tenantable;
    use Auditable;

    /**
     * @var int
     */
    public $estimate_id;

    /**
     * @var string
     */
    public $estimate_title;

    /**
     * @var datetime
     */
    public $estimate_date;

    /**
     * @var string
     */
    public $estimate_terms;

    /**
     * @var int
     */
    public $estimate_add_header;

    /**
     * @var int
     */
    public $estimate_add_footer;

        /**
     * @var int
     */
    public $estimate_header;

    /**
     * @var int
     */
    public $estimate_footer;

    /**
     * @var int
     */
    public $estimate_total;

    /**
     * InvoiceItem constructor.
     */
    public function __construct()
    {
        // $this->quantity = 1.0;
        // $this->discount = 0.0;
        // $this->tax      = 0.0;
    }

    /**
     * @param int $estimate_id
     * @return $this
     */
    public function EstimateID(int $estimate_id)
    {
        $this->estimate_id = $estimate_id;

        return $this;
    }
     /**
     * @param string $estimate_title
     * @return $this
     */
    public function EstimateTitle(string $estimate_title)
    {
        $this->estimate_title = $estimate_title;

        return $this;
    }

     /**
     * @param string $estimate_date
     * @return $this
     */
    public function EstimateDate(string $estimate_date)
    {
        $this->estimate_date = $estimate_date;

        return $this;
    }

    /**
     * @param string $estimate_terms
     * @return $this
     */
    public function EstimateTerms(string $estimate_terms = null)
    {
        //dd($estimate_terms);
        if(!empty($estimate_terms)){
            $this->estimate_terms = $estimate_terms;
        }else{
            $this->estimate_terms = "";
        }
        return $this;
    }
    /**
     * @param int $estimate_add_header
     * @return $this
     */
    public function EstimateAddHeader(int $estimate_add_header = null)
    {
        //dd($estimate_add_header);
        $this->estimate_add_header = $estimate_add_header;

        return $this;
    }

    /**
     * @param int $estimate_add_footer
     * @return $this
     */
    public function EstimateAddFooter(int $estimate_add_footer = null)
    {
        $this->estimate_add_footer = $estimate_add_footer;

        return $this;
    }

        /**
     * @param string $estimate_header
     * @return $this
     */
    public function EstimateHeader(string $estimate_header = null)
    {
        $this->estimate_header = $estimate_header;

        return $this;
    }

    /**
     * @param string $estimate_footer
     * @return $this
     */
    public function EstimateFooter(string $estimate_footer = null)
    {
        $this->estimate_footer = $estimate_footer;

        return $this;
    }

        /**
     * @param float $estimate_total
     * @return $this
     */
    public function EstimateTotal(float $estimate_total)
    {
        $this->estimate_total = $estimate_total;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasEstimateTerms()
    {
        return !is_null($this->estimate_terms);
    }

    /**
     * @throws Exception
     */
    public function validate()
    {
        if (is_null($this->estimate_id)) {
            throw new Exception('EstimateItem: estimate_id not defined.');
        }

        if (is_null($this->estimate_date)) {
            throw new Exception('EstimateItem: estimate_date not defined.');
        }

        if (is_null($this->estimate_title)) {
            throw new Exception('EstimateItem: estimate_title not defined.');
        }

        if (is_null($this->estimate_total)) {
            throw new Exception('EstimateItem: estimate_total not defined.');
        }

    }
}
