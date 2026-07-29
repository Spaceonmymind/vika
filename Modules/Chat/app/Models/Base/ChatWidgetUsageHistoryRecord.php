<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Chat\Models\ChatWidget;

/**
 * Class ChatWidgetUsageHistoryRecord
 *
 * @property int $id
 * @property string $chat_id
 * @property bool $from_tg
 * @property bool $from_max
 * @property int $widget_id
 * @property Carbon $called_at
 * @property ChatWidget $widget
 *
 * @package App\Models\Base
 */
class ChatWidgetUsageHistoryRecord extends Model
{
    protected $table = 'chat_widget_usage_history_records';
    public $timestamps = false;

    protected $casts = [
        'from_tg' => 'bool',
        'from_max' => 'bool',
        'widget_id' => 'int',
        'called_at' => 'datetime:d.m.Y H:i:s'
    ];

    public function widget(): BelongsTo
    {
        return $this->belongsTo(ChatWidget::class, 'widget_id');
    }
}
