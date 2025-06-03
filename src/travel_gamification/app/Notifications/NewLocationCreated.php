<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Destination; // Thay vì Location

class NewLocationCreated extends Notification
{
    use Queueable;

    public $destination;
    public $userName;

    /**
     * Create a new notification instance.
     */
    public function __construct(Destination $destination, $userName) // Đổi Location thành Destination
    {
        $this->destination = $destination;
        $this->userName = $userName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database']; // gửi qua email và lưu vào database
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Địa điểm mới được tạo')
                    ->line('Một địa điểm mới vừa được tạo: ' . $this->destination->name)
                    ->action('Xem chi tiết', url('/admin/locations/' . $this->destination->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'location_id' => $this->destination->id,
            'name' => $this->destination->name,
            'user_name' => $this->userName,
        ];
    }
}
