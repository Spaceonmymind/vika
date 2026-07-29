<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Modules\Chat\Models\ChatVikaType;

/**
 * Class ChatHint
 *
 * @property int $id
 * @property string $value
 *
 * @property Collection<ChatVikaType> $vika_types
 *
 * @package App\Models\Base
 */
class ChatHint extends Model
{
	protected $table = 'chat_hints';
	public $timestamps = false;

    public function vika_types(): BelongsToMany
    {
        return $this->belongsToMany(ChatVikaType::class, 'chat_hint_vika_type', 'hint_id', 'vika_type_id');
    }
}
