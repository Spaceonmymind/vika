<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Chat\Models\ChatWidget;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatMaxWebAppUrl
 *
 * @property int $id
 * @property int $widget_id
 * @property string $params
 *
 * @property ChatWidget $chat_widget
 *
 * @package App\Models\Base
 */
class ChatMaxWebAppUrl extends Model
{
    use HasUuids;
	protected $table = 'chat_max_web_app_urls';
	public $timestamps = false;

	protected $casts = [
		'widget_id' => 'int',
        'params' => 'json:unicode'
	];

	public function chat_widget():BelongsTo
	{
		return $this->belongsTo(ChatWidget::class, 'widget_id');
	}
    public function uniqueIds(): array

    {

        return ['guid'];

    }

}

