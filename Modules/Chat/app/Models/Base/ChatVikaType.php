<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatVikaType
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 *
 * @property Collection|\Modules\Chat\Models\Base\ChatAnswer[] $chat_answers
 * @property Collection|\Modules\Chat\Models\ChatWidgetCategory[] $widget_categories
 * @package App\Models\Base
 */
class ChatVikaType extends Model
{
	protected $table = 'chat_vika_types';
	public $timestamps = false;
}
