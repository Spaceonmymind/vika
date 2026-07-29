<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\CultureUgraWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\CultureUgraWidget\Models\CultureUgraWidgetLocality;

/**
 * Class CultureUgraWidgetEvent
 *
 * @property int $id
 * @property string $name
 * @property int $locality_id
 * @property string|null $description
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $organization_name
 * @property string|null $address
 * @property string|null $buy_link
 * @property string|null $buy_text
 *
 * @property \Modules\CultureUgraWidget\Models\Base\CultureUgraWidgetLocality $locality
 *
 * @package App\Models\Base
 */
class CultureUgraWidgetEvent extends Model
{
    public $timestamps = false;
    protected $table = 'culture_ugra_widget_events';
    protected $casts = [
        'locality_id' => 'int',
    ];

    public function locality(): BelongsTo
    {
        return $this->belongsTo(CultureUgraWidgetLocality::class, 'locality_id');
    }
}
