<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Utility;

class NewUtilityCreated extends Notification
{
    use Queueable;

    public $utility;
    public $userName;

    /**
     * Create a new notification instance.
     */
    public function __construct(Utility $utility, $userName)
    {
        $this->utility = $utility;
        $this->userName = $userName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Bài viết về tiện ích mới được tạo')
            ->line('Một bài viết về tiện ích mới vừa được tạo: ' . $this->utility->name)
            ->action('Xem chi tiết', url('/admin/utilities/' . $this->utility->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'utility_id' => $this->utility->id,
            'name' => $this->utility->name,
            'user_name' => $this->userName,
            'type' => 'utility',
        ];
    }
}
