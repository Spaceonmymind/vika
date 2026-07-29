<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatMaxMessage
 *
 * @property int $id
 * @property int $chat_id
 * @property int $user_id
 * @property string|null $message
 * @property string|null $username
 * @property string|null $last_name
 * @property string|null $first_name
 * @property string|null $answer
 * @property Carbon $created_at
 *
 * @package App\Models\Base
 */
class ChatMaxMessage extends Model
{
    const ?string UPDATED_AT = null;
	protected $table = 'chat_max_messages';

	protected $casts = [
		'chat_id' => 'int',
		'user_id' => 'int',
        'answer' => 'json:unicode'
	];
}
