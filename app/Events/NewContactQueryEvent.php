<?php

namespace App\Events;

use App\Models\ContactQuery;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewContactQueryEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $contactQuery;

    /**
     * Create a new event instance.
     */
    public function __construct(ContactQuery $contactQuery)
    {
        $this->contactQuery = $contactQuery;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('admin-notifications'),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->contactQuery->id,
            'user_name' => $this->contactQuery->name ?? 'Guest',
            'subject' => $this->contactQuery->subject ?? 'No Subject',
            'message' => 'New contact message from ' . ($this->contactQuery->name ?? 'Guest'),
            'type' => 'contact_query',
        ];
    }
}
