<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Modules\Chat\Models\ChatIntent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatIntentHandler
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $class
 *
 * @property Collection|ChatIntent[] $chat_intents
 *
 * @package App\Models\Base
 */
class ChatIntentHandler extends Model
{
	protected $table = 'chat_intent_handlers';
	public $timestamps = false;

	public function chat_intents()
	{
		return $this->hasMany(ChatIntent::class, 'handler_id');
	}
}
