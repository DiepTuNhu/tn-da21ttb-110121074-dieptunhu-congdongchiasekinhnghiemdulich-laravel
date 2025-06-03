<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Post;
use App\Models\User;

class PostSharedNotification extends Notification
{
    use Queueable;

    public $post;
    public $sharer;

    public function __construct(Post $post, User $sharer)
    {
        $this->post = $post;
        $this->sharer = $sharer;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->sharer->username} đã chia sẻ bài viết của bạn: {$this->post->title}",
            'post_id' => $this->post->id,
            'sharer_id' => $this->sharer->id,
        ];
    }
}