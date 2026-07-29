<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Chat\Models\ChatIntent;

/**
 * Class ChatIntentTestRequest
 *
 * @property int $id
 * @property int $intent_id
 * @property string $text
 * @property int $external_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property ChatIntent $chat_intent
 *
 * @package App\Models\Base
 */
class ChatIntentTestRequest extends Model
{
	protected $table = 'chat_intent_test_requests';

	protected $casts = [
		'intent_id' => 'int',
		'external_id' => 'int'
	];

	public function chat_intent(): BelongsTo
    {
		return $this->belongsTo(ChatIntent::class, 'intent_id');
	}
}
