<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Modules\Chat\Models\ChatWidget;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Chat\Models\ChatWidgetCategory;

/**
 * Class ChatWidgetIcon
 *
 * @property int $id
 * @property string $code
 * @property string $name
 *
 * @property Collection|ChatWidgetCategory[] $chat_widget_categories
 * @property Collection|ChatWidget[] $chat_widgets
 *
 * @package App\Models\Base
 */
class ChatWidgetIcon extends Model
{
	protected $table = 'chat_widget_icons';
	public $timestamps = false;

	public function chat_widget_categories()
	{
		return $this->hasMany(ChatWidgetCategory::class, 'icon_id');
	}

	public function chat_widgets()
	{
		return $this->hasMany(ChatWidget::class, 'icon_id');
	}
}
