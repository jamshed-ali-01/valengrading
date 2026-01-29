<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ContactQuery; // Assuming ContactQuery is a model

class NewContactQuery extends Notification
{
    use Queueable;

    public $contactQuery;
    protected $channels;

    /**
     * Create a new event instance.
     */
    public function __construct(ContactQuery $contactQuery, array $channels = null)
    {
        $this->contactQuery = $contactQuery;
        $this->channels = $channels;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return $this->channels ?? ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Contact Query: ' . ($this->contactQuery->subject ?? 'No Subject'))
            ->view('emails.contact_query', ['data' => $this->contactQuery]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'form_id' => $this->contactQuery->id,
            'message' => 'New contact message from ' . ($this->contactQuery->name ?? 'Guest'),
            'type' => 'contact_query',
        ];
    }
}
