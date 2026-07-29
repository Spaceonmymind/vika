<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Modules\Chat\Models\ChatWidget;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatWidgetType
 *
 * @property int $id
 * @property string $code
 * @property string $name
 *
 * @property Collection|ChatWidget[] $chat_widgets
 *
 * @package App\Models\Base
 */
class ChatWidgetType extends Model
{
	protected $table = 'chat_widget_types';
	public $timestamps = false;

	public function chat_widgets()
	{
		return $this->hasMany(ChatWidget::class, 'type_id');
	}
}
