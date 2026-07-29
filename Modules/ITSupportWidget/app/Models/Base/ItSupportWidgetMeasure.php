<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\ITSupportWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ItSupportWidgetMeasure
 *
 * @property int $id
 * @property string $name
 * @property string|null $type
 * @property string $conditions
 * @property string|null $terms
 * @property string|null $responsible
 *
 * @package App\Models\Base
 */
class ItSupportWidgetMeasure extends Model
{
	protected $table = 'it_support_widget_measures';
	public $timestamps = false;
}
