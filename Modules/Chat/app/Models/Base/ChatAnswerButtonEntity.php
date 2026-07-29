<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Chat\Models\ChatAnswerButton;

/**
 * Class ChatAnswerButtonEntity
 *
 * @property int $id
 * @property int $button_id
 * @property string $name
 * @property string $code
 * @property string $param_name
 * @property bool $multiple
 * @property string|null $table
 * @property string|null $column
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property \Modules\Chat\Models\Base\ChatAnswerButton $chat_answer_button
 *
 * @package App\Models\Base
 */
class ChatAnswerButtonEntity extends Model
{
	protected $table = 'chat_answer_button_entities';

	protected $casts = [
		'button_id' => 'int',
		'multiple' => 'bool'
	];

	public function chat_answer_button():BelongsTo
	{
		return $this->belongsTo(ChatAnswerButton::class, 'button_id');
	}
}
