<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSubmissionNotification extends Notification
{
    use Queueable;

    protected $submission;

    /**
     * Create a new notification instance.
     */
    public function __construct($submission)
    {
        $this->submission = $submission;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification for database storage.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'submission_id' => $this->submission->id,
            'submission_no' => $this->submission->submission_no,
            'user_name' => $this->submission->guest_name ?? $this->submission->user->name ?? 'Guest',
            'amount' => $this->submission->total_cards,
            'message' => "New Submission #{$this->submission->submission_no} Received!",
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): array
    {
        return [
            'data' => [
                'submission_id' => $this->submission->id,
                'submission_no' => $this->submission->submission_no,
                'user_name' => $this->submission->guest_name ?? $this->submission->user->name ?? 'Guest',
                'amount' => $this->submission->total_cards,
                'message' => "New Submission #{$this->submission->submission_no} Received!",
            ]
        ];
    }
}
