<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterWorkitem extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public const UNIT_SELECT = [
        'rft'     => 'Per R. Ft.',
        'sft'     => 'Per S. Ft.',
        'lumpsum' => 'Lumpsum',
    ];

    public $table = 'master_workitems';

    public $orderable = [
        'id',
        'room.name',
        'name',
        'description',
        'unit',
        'rate',
    ];

    public $filterable = [
        'id',
        'room.name',
        'name',
        'description',
        'unit',
        'rate',
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
        'unit',
        'rate',
    ];

    public function room()
    {
        return $this->belongsTo(MasterRoom::class);
    }

    public function getUnitLabelAttribute($value)
    {
        return static::UNIT_SELECT[$this->unit] ?? null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
