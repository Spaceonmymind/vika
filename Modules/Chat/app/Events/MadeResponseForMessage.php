<?php

namespace Modules\Chat\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MadeResponseForMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private array $answer;
    private ?int $messageId;
    private string $chatId;

    /**
     * Create a new event instance.
     */
    public function __construct(string $chatId, array $answer, ?int $messageId)
    {
        $this->chatId = $chatId;
        $this->answer = $answer;
        $this->messageId = $messageId;
    }

    /**
     * Get the channels the event should be broadcast on.
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('chat.' . $this->chatId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'chat.response-message-made';
    }

    public function broadcastWith(): array
    {
        return [
            'message_id' => $this->messageId,
            'answer' => $this->answer,
        ];
    }
}
