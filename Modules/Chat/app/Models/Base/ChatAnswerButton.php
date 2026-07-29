<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Chat\Models\ChatWidget;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Chat\Models\ChatAnswer;
use Modules\Chat\Models\ChatAnswerButtonEntity;
use Modules\Chat\Models\ChatAnswerButtonType;

/**
 * Class ChatAnswerButton
 *
 * @property int $id
 * @property int $button_type_id
 * @property string $name
 * @property int $answer_id
 * @property string $button_message_text
 * @property string|null $url
 * @property int|null $chat_widget_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property \Modules\Chat\Models\Base\ChatAnswer $chat_answer
 * @property \Modules\Chat\Models\Base\ChatAnswerButtonType $chat_answer_button_type
 * @property ChatWidget|null $chat_widget
 * @property Collection|\Modules\Chat\Models\Base\ChatAnswerButtonEntity[] $chat_answer_button_entities
 *
 * @package App\Models\Base
 */
class ChatAnswerButton extends Model
{
	protected $table = 'chat_answer_buttons';

	protected $casts = [
		'button_type_id' => 'int',
		'answer_id' => 'int',
		'chat_widget_id' => 'int'
	];

	public function chat_answer(): BelongsTo
	{
		return $this->belongsTo(ChatAnswer::class, 'answer_id');
	}

	public function chat_answer_button_type(): BelongsTo
	{
		return $this->belongsTo(ChatAnswerButtonType::class, 'button_type_id');
	}

	public function chat_widget(): BelongsTo
	{
		return $this->belongsTo(ChatWidget::class,'chat_widget_id');
	}

	public function chat_answer_button_entities():HasMany
	{
		return $this->hasMany(ChatAnswerButtonEntity::class, 'button_id');
	}
}
