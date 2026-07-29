<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Modules\Chat\Models\ChatVikaType;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatVikaTypeResource
 *
 * @property int $id
 * @property int $vika_type_id
 * @property string $resource_host
 *
 * @property ChatVikaType $chat_vika_type
 *
 * @package App\Models\Base
 */
class ChatVikaTypeResource extends Model
{
	protected $table = 'chat_vika_type_resources';
	public $timestamps = false;

	protected $casts = [
		'vika_type_id' => 'int'
	];

	public function chat_vika_type()
	{
		return $this->belongsTo(ChatVikaType::class, 'vika_type_id');
	}
}
