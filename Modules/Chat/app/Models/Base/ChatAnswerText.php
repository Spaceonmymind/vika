<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatAnswerText
 *
 * @property int $id
 * @property string $text
 * @property int $answer_id
 *
 * @property ChatAnswer $chat_answer
 *
 * @package App\Models\Base
 */
class ChatAnswerText extends Model
{
	protected $table = 'chat_answer_texts';
	public $timestamps = false;

	protected $casts = [
		'answer_id' => 'int'
	];

	public function chat_answer()
	{
		return $this->belongsTo(ChatAnswer::class, 'answer_id');
	}
}
