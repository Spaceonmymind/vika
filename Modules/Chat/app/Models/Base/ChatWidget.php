<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ChatWidget
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property bool $is_active
 *
 * @package App\Models\Base
 */
class ChatWidget extends Model
{
	protected $table = 'chat_widgets';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'bool',
		'is_favorite' => 'bool',
        'icon_id' => 'int',
        'type_id' => 'int',
        'category_id' => 'int',
        'order' => 'int',
	];
    public function attached_to_vika_type_widgets():HasMany
    {
        return $this->hasMany(ChatAttachedToVikaTypeWidget::class, 'chat_widget_id');
    }
    public function icon():BelongsTo
    {
        return  $this->belongsTo(ChatWidgetIcon::class, 'icon_id');
    }
}
