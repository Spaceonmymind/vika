<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Chat\Models\ChatVikaType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Chat\Models\ChatAttachedToVikaTypeWidget;
use Modules\Chat\Models\ChatWidgetIcon;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ChatWidgetCategory
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $icon_id
 * @property int $vika_type_id
 * @property int $order
 *
 * @property \Modules\Chat\Models\Base\ChatWidgetIcon|null $chat_widget_icon
 * @property ChatVikaType $chat_vika_type
 * @property Collection|ChatAttachedToVikaTypeWidget[] $attached_to_vika_type_widgets
 *
 * @package App\Models\Base
 */
class ChatWidgetCategory extends Model
{
	protected $table = 'chat_widget_categories';
	public $timestamps = false;

	protected $casts = [
		'icon_id' => 'int',
		'vika_type_id' => 'int',
		'order' => 'int',
        'is_favorite'=>'bool',
	];

	public function icon():BelongsTo
	{
		return $this->belongsTo(ChatWidgetIcon::class, 'icon_id');
	}

	public function vika_type():BelongsTo
	{
		return $this->belongsTo(ChatVikaType::class, 'vika_type_id');
	}

	public function attached_to_vika_type_widgets():HasMany
	{
		return $this->hasMany(ChatAttachedToVikaTypeWidget::class, 'category_id');
	}
}
