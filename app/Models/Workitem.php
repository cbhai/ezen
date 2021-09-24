<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workitem extends Model
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

    public $table = 'workitems';

    public $orderable = [
        'room.name',
        'name',
        'rate',
        'unit',
    ];

    public $filterable = [
        'room.name',
        'name',
        'rate',
        'unit',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'room_id',
        'name',
        'description',
        'rate',
        'unit',
        'is_master',
    ];

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
