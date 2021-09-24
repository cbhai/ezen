<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstimateDetail extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use Tenantable;

    public const UNIT_SELECT = [
        'rft'     => 'Per R. Ft.',
        'sft'     => 'Per S. Ft.',
        'lumpsum' => 'Lumpsum',
    ];

    public $table = 'estimate_details';

    public $orderable = [
        'estimate.title',
        'room.name',
        'name',
        'description',
        'rate',
        'unit',
        'quantity',
        'total',
    ];

    public $filterable = [
        'estimate.title',
        'room.name',
        'name',
        'description',
        'rate',
        'unit',
        'quantity',
        'total',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'estimate_id',
        'room_id',
        'name',
        'description',
        'rate',
        'unit',
        'quantity',
        'total',
    ];

    public function estimate()
    {
        return $this->belongsTo(Estimate::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function getUnitLabelAttribute($value)
    {
        return static::UNIT_SELECT[$this->unit] ?? null;
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
