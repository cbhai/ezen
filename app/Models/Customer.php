<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use Tenantable;
    use Auditable;

    public const STATUS_SELECT = [
        'lead'    => 'Lead',
        'Client'  => 'Client',
        'partner' => 'Partner',
    ];

    public $table = 'customers';

    public $orderable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'city',
    ];

    public $filterable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'city',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'description',
    ];

    public function getStatusLabelAttribute($value)
    {
        return static::STATUS_SELECT[$this->status] ?? null;
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
