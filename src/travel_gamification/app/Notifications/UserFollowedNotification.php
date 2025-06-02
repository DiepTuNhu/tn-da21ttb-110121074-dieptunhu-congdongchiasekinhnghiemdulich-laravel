<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\User;

class UserFollowedNotification extends Notification
{
    use Queueable;

    public $follower;

    public function __construct(User $follower)
    {
        $this->follower = $follower;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->follower->username} đã theo dõi bạn.",
            'follower_id' => $this->follower->id,
        ];
    }
}