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

class PDFRoomItem extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use Tenantable;
    use Auditable;

    // public const STATUS_SELECT = [
    //     'lead'    => 'Lead',
    //     'Client'  => 'Client',
    //     'partner' => 'Partner',
    // ];

    // public $table = 'customers';

    // public $orderable = [
    //     'first_name',
    //     'last_name',
    //     'email',
    //     'phone',
    //     'city',
    // ];

    // public $filterable = [
    //     'first_name',
    //     'last_name',
    //     'email',
    //     'phone',
    //     'city',
    // ];

    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    //     'deleted_at',
    // ];

    // protected $fillable = [
    //     'first_name',
    //     'last_name',
    //     'status',
    //     'email',
    //     'phone',
    //     'address',
    //     'city',
    //     'state',
    //     'description',
    // ];

    // public function getStatusLabelAttribute($value)
    // {
    //     return static::STATUS_SELECT[$this->status] ?? null;
    // }

    // public function fullName() {
    //     return $this->first_name . ' ' .  $this->last_name;
    // }

    // public function owner()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // protected function serializeDate(DateTimeInterface $date)
    // {
    //     return $date->format('Y-m-d H:i:s');
    // }

        /**
     * @var string
     */
    public $room_title;


    public $workitems = [];

    /**
     * @var float
     */
    public $room_total;



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
     * @param string $roomTitle
     * @return $this
     */
    public function roomTitle(string $title)
    {
        $this->room_title = $title;

        return $this;
    }

    /**
     * @param float $price
     * @return $this
     */
    public function roomTotal(float $total)
    {
        $this->room_total = $total;

        return $this;
    }

    /**
     * @param float $price
     * @return $this
     */
    public function roomWorkitems(array $workitems)
    {
        $this->workitems = $workitems;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasRoomTitle()
    {
        return !is_null($this->room_title);
    }

     /**
     * @return bool
     */
    public function hasRoomTotal()
    {
        return !is_null($this->room_total);
    }

    /**
     * @throws Exception
     */
    public function validate()
    {
        if (is_null($this->room_title)) {
            throw new Exception('RoomItem: room_title not defined.');
        }

        if (is_null($this->room_total)) {
            throw new Exception('RoomItem: room_total not defined.');
        }

    }
}
