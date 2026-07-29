<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\HumanitarianPointsWidget\Models\Base;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\HumanitarianPointsWidget\Models\HumanitarianPointsWidgetHumanitarianPoint;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HumanitarianPointsWidgetMunicipality
 *
 * @property int $id
 * @property string $name
 *
 * @property Collection|HumanitarianPointsWidgetHumanitarianPoint[] $humanitarian_points
 *
 * @package Modules\HumanitarianPointsWidget\Models\Base
 */
class HumanitarianPointsWidgetMunicipality extends Model
{
    protected $table = 'humanitarian_points_widget_municipalities';
    public $timestamps = false;

    public function humanitarian_points():HasMany
    {
        return $this->hasMany(HumanitarianPointsWidgetHumanitarianPoint::class, 'municipality_id');
    }
}
