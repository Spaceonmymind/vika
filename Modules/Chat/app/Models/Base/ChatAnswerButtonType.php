<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Chat\Models\ChatAnswerButton;

/**
 * Class ChatAnswerButtonType
 *
 * @property int $id
 * @property string $code
 * @property string $name
 *
 * @property Collection|\Modules\Chat\Models\Base\ChatAnswerButton[] $chat_answer_buttons
 *
 * @package App\Models\Base
 */
class ChatAnswerButtonType extends Model
{
	protected $table = 'chat_answer_button_types';
	public $timestamps = false;

	public function chat_answer_buttons():HasMany
	{
		return $this->hasMany(ChatAnswerButton::class, 'button_type_id');
	}
}
