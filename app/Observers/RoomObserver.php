<?php

namespace App\Observers;

use App\Models\Room;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class RoomObserver
{
    public function created(Room $room): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($room), $room->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
