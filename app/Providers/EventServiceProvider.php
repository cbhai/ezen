<?php

namespace App\Providers;

use App\Listeners\AssignRoleForRegisteredUser;
use App\Models\BusinessProfile;
use App\Models\Customer;
use App\Models\Estimate;
use App\Models\Room;
use App\Models\User;
use App\Observers\BusinessProfileObserver;
use App\Observers\CustomerObserver;
use App\Observers\EstimateObserver;
use App\Observers\RoomObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            AssignRoleForRegisteredUser::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        BusinessProfile::observe(BusinessProfileObserver::class);
        Customer::observe(CustomerObserver::class);
        Estimate::observe(EstimateObserver::class);
        Room::observe(RoomObserver::class);
    }
}
