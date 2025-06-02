<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Post;
use App\Models\User;

class PostLikedNotification extends Notification
{
    use Queueable;

    public $post;
    public $liker;

    public function __construct(Post $post, User $liker)
    {
        $this->post = $post;
        $this->liker = $liker;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->liker->username} đã thích bài viết của bạn: {$this->post->title}",
            'post_id' => $this->post->id,
            'liker_id' => $this->liker->id,
        ];
    }
}