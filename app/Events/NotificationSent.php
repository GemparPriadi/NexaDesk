<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $userId;

    /**
     * Create a new event instance.
     */
    public function __construct($message, $userId)
    {
        $this->message = $message;

        $this->userId = $userId;
    }

    /**
     * CHANNEL
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('notifications.' . $this->userId),
        ];
    }

    /**
     * EVENT NAME
     */
    public function broadcastAs(): string
    {
        return 'notification.sent';
    }

    /**
     * DATA
     */
    public function broadcastWith(): array
    {
        return [

            'message' => $this->message,

            'userId' => $this->userId,

        ];
    }
}