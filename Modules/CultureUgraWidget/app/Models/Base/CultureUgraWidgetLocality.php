<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\CultureUgraWidget\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\CultureUgraWidget\Models\CultureUgraWidgetEvent;

/**
 * Class CultureUgraWidgetLocality
 *
 * @property int $id
 * @property string $name
 *
 * @property Collection|CultureUgraWidgetEvent[] $culture_ugra_widget_events
 *
 * @package App\Models\Base
 */
class CultureUgraWidgetLocality extends Model
{
	protected $table = 'culture_ugra_widget_localities';
	public $timestamps = false;

	public function culture_ugra_widget_events():HasMany
	{
		return $this->hasMany(CultureUgraWidgetEvent::class, 'locality_id');
	}
}
