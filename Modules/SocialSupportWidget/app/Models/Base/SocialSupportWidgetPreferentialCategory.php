<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\SocialSupportWidget\Models\Base;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Modules\SocialSupportWidget\Models\SocialSupportWidgetSocialSupportMeasure as SocialSupportWidgetSocialSupportMeasureAlias;

/**
 * Class SocialSupportWidgetPreferentialCategory
 *
 * @property int $id
 * @property string $name
 *
 * @property SocialSupportWidgetSocialSupportMeasureAlias $support_measures
 *
 * @package App\Models\Base
 */
class SocialSupportWidgetPreferentialCategory extends Model
{
	protected $table = 'social_support_widget_preferential_categories';
	public $timestamps = false;

    public function support_measures():BelongsToMany
    {
        return $this->belongsToMany(SocialSupportWidgetSocialSupportMeasureAlias::class,'social_support_widget_preferential_category_measure','category_id','measure_id');
    }
}
