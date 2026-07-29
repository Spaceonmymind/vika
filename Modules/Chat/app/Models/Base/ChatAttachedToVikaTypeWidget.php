<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Chat\Models\ChatVikaType;
use Modules\Chat\Models\ChatWidget;
use Illuminate\Database\Eloquent\Model;
use Modules\Chat\Models\ChatWidgetCategory;

/**
 * Class ChatAttachedToVikaTypeWidget
 *
 * @property int $id
 * @property int $chat_widget_id
 * @property int $vika_type_id
 * @property int|null $category_id
 * @property int $order
 *
 * @property \Modules\Chat\Models\Base\ChatWidgetCategory|null $chat_widget_category
 * @property ChatWidget $chat_widget
 * @property ChatVikaType $chat_vika_type
 *
 * @package App\Models\Base
 */
class ChatAttachedToVikaTypeWidget extends Model
{
	protected $table = 'chat_attached_to_vika_type_widgets';
	public $timestamps = false;

	protected $casts = [
		'chat_widget_id' => 'int',
		'vika_type_id' => 'int',
		'category_id' => 'int',
		'order' => 'int',
        'is_favorite' => 'boolean'
	];

	public function category():BelongsTo
	{
		return $this->belongsTo(ChatWidgetCategory::class, 'category_id');
	}

	public function widget():BelongsTo
	{
		return $this->belongsTo(ChatWidget::class,'chat_widget_id');
	}

	public function vika_type():BelongsTo
	{
		return $this->belongsTo(ChatVikaType::class, 'vika_type_id');
	}
}
