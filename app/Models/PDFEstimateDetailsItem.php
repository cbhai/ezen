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

class PDFEstimateDetailsItem extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use Tenantable;
    use Auditable;

    public $workitemName;

    public $workitemDescription;

    public $workitemRate;

    public $workitemQuantity;

    public $workitemUnit;

    public $workitemTotal;

    // /**
    //  * @var string
    //  */
    // public $title;

    // /**
    //  * @var string
    //  */
    // public $units;

    // /**
    //  * @var float
    //  */
    // public $quantity;

    // /**
    //  * @var float
    //  */
    // public $price_per_unit;

    // /**
    //  * @var float
    //  */
    // public $sub_total_price;

    // /**
    //  * @var float
    //  */
    // public $discount;

    // /**
    //  * @var bool
    //  */
    // public $discount_percentage;

    // /**
    //  * @var float
    //  */
    // public $tax;

    // /**
    //  * @var float
    //  */
    // public $tax_percentage;

    /**
     * EstimateDetailsItem constructor.
     */
    public function __construct()
    {
        // $this->quantity = 1.0;
        // $this->discount = 0.0;
        // $this->tax      = 0.0;
    }

    // /**
    //  * @param string $title
    //  * @return $this
    //  */
    // public function title(string $title)
    // {
    //     $this->title = $title;

    //     return $this;
    // }

    /**
     * @param string $workitemName
     * @return $this
     */
    public function WorkitemName(string $workitemName)
    {
        $this->workitemName = $workitemName;

        return $this;
    }

    /**
     * @param string $workitemDescription
     * @return $this
     */
    public function WorkitemDescription(string $workitemDescription)
    {
        $this->workitemDescription = $workitemDescription;

        return $this;
    }


    // /**
    //  * @param string $units
    //  * @return $this
    //  */
    // public function units(string $units)
    // {
    //     $this->units = $units;

    //     return $this;
    // }

    /**
     * @param string $workitemUnit
     * @return $this
     */
    public function WorkitemUnit(string $workitemUnit)
    {
        $this->workitemUnit = $workitemUnit;

        return $this;
    }


    // /**
    //  * @param float $quantity
    //  * @return $this
    //  */
    // public function quantity(float $quantity)
    // {
    //     $this->quantity = $quantity;

    //     return $this;
    // }

    /**
     * @param float $workitemQuantity
     * @return $this
     */
    public function WorkitemQuantity(float $workitemQuantity)
    {
        $this->workitemQuantity = $workitemQuantity;

        return $this;
    }

    /**
     * @param float $workitemRate
     * @return $this
     */
    public function WorkitemRate(float $workitemRate)
    {
        $this->workitemRate = $workitemRate;

        return $this;
    }

    /**
     * @param float $workitemTotal
     * @return $this
     */
    public function WorkitemTotal(float $workitemTotal)
    {
        $this->workitemTotal = $workitemTotal;

        return $this;
    }

    // /**
    //  * @param float $amount
    //  * @param bool $byPercent
    //  * @return $this
    //  * @throws Exception
    //  */
    // public function discount(float $amount, bool $byPercent = false)
    // {
    //     if ($this->hasDiscount()) {
    //         throw new Exception('InvoiceItem: unable to set discount twice.');
    //     }

    //     $this->discount                           = $amount;
    //     !$byPercent ?: $this->discount_percentage = $amount;

    //     return $this;
    // }

    // /**
    //  * @param float $amount
    //  * @param bool $byPercent
    //  * @return $this
    //  * @throws Exception
    //  */
    // public function tax(float $amount, bool $byPercent = false)
    // {
    //     if ($this->hasTax()) {
    //         throw new Exception('InvoiceItem: unable to set tax twice.');
    //     }

    //     $this->tax                           = $amount;
    //     !$byPercent ?: $this->tax_percentage = $amount;

    //     return $this;
    // }

    // /**
    //  * @param float $amount
    //  * @return $this
    //  * @throws Exception
    //  */
    // public function discountByPercent(float $amount)
    // {
    //     $this->discount($amount, true);

    //     return $this;
    // }

    // /**
    //  * @param float $amount
    //  * @return $this
    //  * @throws Exception
    //  */
    // public function taxByPercent(float $amount)
    // {
    //     $this->tax($amount, true);

    //     return $this;
    // }

    // /**
    //  * @return bool
    //  */
    // public function hasUnits()
    // {
    //     return !is_null($this->units);
    // }

    // /**
    //  * @return bool
    //  */
    // public function hasDiscount()
    // {
    //     return $this->discount !== 0.0;
    // }

    // /**
    //  * @return bool
    //  */
    // public function hasTax()
    // {
    //     return $this->tax !== 0.0;
    // }

    // /**
    //  * @param int $decimals
    //  * @return $this
    //  */
    // public function calculate(int $decimals)
    // {
    //     if (!is_null($this->sub_total_price)) {
    //         return $this;
    //     }

    //     $this->sub_total_price = PricingService::applyQuantity($this->price_per_unit, $this->quantity, $decimals);
    //     $this->calculateDiscount($decimals);
    //     $this->calculateTax($decimals);

    //     return $this;
    // }

    // /**
    //  * @param int $decimals
    //  */
    // public function calculateDiscount(int $decimals): void
    // {
    //     $subTotal = $this->sub_total_price;

    //     if ($this->discount_percentage) {
    //         $newSubTotal = PricingService::applyDiscount($subTotal, $this->discount_percentage, $decimals, true);
    //     } else {
    //         $newSubTotal = PricingService::applyDiscount($subTotal, $this->discount, $decimals);
    //     }

    //     $this->sub_total_price = $newSubTotal;
    //     $this->discount        = $subTotal - $newSubTotal;
    // }

    // /**
    //  * @param int $decimals
    //  */
    // public function calculateTax(int $decimals): void
    // {
    //     $subTotal = $this->sub_total_price;

    //     if ($this->tax_percentage) {
    //         $newSubTotal = PricingService::applyTax($subTotal, $this->tax_percentage, $decimals, true);
    //     } else {
    //         $newSubTotal = PricingService::applyTax($subTotal, $this->tax, $decimals);
    //     }

    //     $this->sub_total_price = $newSubTotal;
    //     $this->tax             = $newSubTotal - $subTotal;
    // }

    /**
     * @throws Exception
     */
    public function validate()
    {
        // have to add more to this

        if (is_null($this->workitemName)) {
            throw new Exception('EstimateDetailsItem: Name not defined.');
        }

        if (is_null($this->workitemRate)) {
            throw new Exception('EstimateDetailsItem: Rate not defined.');
        }

    }
}
