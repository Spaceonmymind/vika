<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatMessage as BaseChatMessage;
use OpenApi\Attributes as OA;

#[OA\Schema(
    properties: [
        new OA\Property(property: 'id', type: 'integer'),
        new OA\Property(property: 'message', type: 'string'),
        new OA\Property(property: 'chat_id', type: 'string'),
        new OA\Property(property: 'vika_type_id', type: 'integer'),
        new OA\Property(property: 'answer', type: 'object'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
    ]
)]
class ChatMessage extends BaseChatMessage
{
    protected $fillable = [
        'message',
        'chat_id',
        'vika_type_id',
        'answer',
    ];

}
