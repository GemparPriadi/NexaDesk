<?php

namespace App\Events;

use App\Models\Ticket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketCreated implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('tickets'),
        ];
    }
}