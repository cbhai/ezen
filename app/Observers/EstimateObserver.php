<?php

namespace App\Observers;

use App\Models\Estimate;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class EstimateObserver
{
    public function created(Estimate $estimate): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($estimate), $estimate->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
