<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatWidgetType as BaseChatWidgetType;

/**
 * Class ChatWidgetType
 *
 * @property int $id
 * @property string $code
 * @property string $name
 *
 * @package Modules\Chat\Models
 */
class ChatWidgetType extends BaseChatWidgetType
{
    protected $fillable = [
        'code',
        'name'
    ];
}
