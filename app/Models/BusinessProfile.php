<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessProfile extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use Tenantable;
    use Auditable;

    public $table = 'business_profiles';

    public $orderable = [
        'business_name',
        'city',
    ];

    public $filterable = [
        'business_name',
        'city',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'business_name',
        'first_name',
        'last_name',
        'phone',
        'email',
        'address',
        'city',
        'state',
        'pin_code',
        'about',
    ];

    public function fullName() {
        return $this->first_name . ' ' .  $this->last_name;
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
