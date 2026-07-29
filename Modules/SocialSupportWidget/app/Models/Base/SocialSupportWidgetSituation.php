<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\SocialSupportWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\SocialSupportWidget\Models\SocialSupportWidgetSocialSupportMeasure as SocialSupportWidgetSocialSupportMeasureAlias;

/**
 * Class SocialSupportWidgetSituation
 *
 * @property int $id
 * @property string $name
 *
 * @package App\Models\Base
 */
class SocialSupportWidgetSituation extends Model
{
	protected $table = 'social_support_widget_situations';
	public $timestamps = false;
    public function support_measures():HasMany
    {
        return $this->hasMany(SocialSupportWidgetSocialSupportMeasureAlias::class,'situation_id');
    }
}
