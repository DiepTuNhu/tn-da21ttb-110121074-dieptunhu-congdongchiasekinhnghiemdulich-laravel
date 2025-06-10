<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReportSubmitted extends Notification
{
    use Queueable;

    public $reportData;

    /**
     * Create a new notification instance.
     */
    public function __construct($reportData)
    {
        $this->reportData = $reportData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase($notifiable)
    {
        return [
            'type' => $this->reportData['type'], // 'post' hoặc 'comment'
            'object_id' => $this->reportData['id'],
            'reason' => $this->reportData['reason'],
            'user_name' => $this->reportData['user_name'],
            'object_title' => $this->reportData['object_title'] ?? null,
        ];
    }
}
