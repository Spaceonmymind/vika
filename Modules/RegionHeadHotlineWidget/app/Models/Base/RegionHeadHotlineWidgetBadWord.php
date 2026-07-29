<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\RegionHeadHotlineWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RegionHeadHotlineWidgetBadWord
 *
 * @property int $id
 * @property string $word
 * @property string $pattern
 *
 * @package App\Models\Base
 */
class RegionHeadHotlineWidgetBadWord extends Model
{
	protected $table = 'region_head_hotline_widget_bad_words';
	public $timestamps = false;
}
