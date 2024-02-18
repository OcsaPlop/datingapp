<?php

namespace App\Events;

use App\Http\Resources\ChatMessageResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $message;

  /**
   * Create a new event instance.
   */
  public function __construct($message)
  {
    $this->message = $message;
  }

  public function broadcastWith()
  {
    return [
      'message' => new ChatMessageResource($this->message),
    ];
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return array<int, \Illuminate\Broadcasting\Channel>
   */
  public function broadcastOn(): Channel
  {
    return new PrivateChannel('chat.' . $this->message->receiver_id);
  }
}
