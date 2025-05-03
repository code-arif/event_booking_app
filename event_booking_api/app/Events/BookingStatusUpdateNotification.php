<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingStatusUpdateNotification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $bookingData;
    public function __construct($bookingData)
    {
        $this->bookingData = $bookingData;
    }

    public function broadcastOn(): array
    {
        return [new Channel('first_broadcast')];
    }

    public function broadcastAs(){
        return 'booking-status';
    }

    public function broadcastWith(): array
    {
        return ['bookingData' => $this->bookingData];
    }
}
