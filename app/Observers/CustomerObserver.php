<?php

namespace App\Observers;

use App\Models\Customer;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class CustomerObserver
{
    public function created(Customer $customer): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($customer), $customer->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
