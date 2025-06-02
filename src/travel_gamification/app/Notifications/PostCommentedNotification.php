<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Post;
use App\Models\User;

class PostCommentedNotification extends Notification
{
    use Queueable;

    public $post;
    public $commenter;

    public function __construct(Post $post, User $commenter)
    {
        $this->post = $post;
        $this->commenter = $commenter;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->commenter->username} đã bình luận bài viết của bạn: {$this->post->title}",
            'post_id' => $this->post->id,
            'commenter_id' => $this->commenter->id,
        ];
    }
}