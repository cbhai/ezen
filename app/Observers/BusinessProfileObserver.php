<?php

namespace App\Observers;

use App\Models\BusinessProfile;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class BusinessProfileObserver
{
    public function created(BusinessProfile $businessProfile): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($businessProfile), $businessProfile->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
