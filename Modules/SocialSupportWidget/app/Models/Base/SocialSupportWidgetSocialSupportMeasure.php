<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\SocialSupportWidget\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\SocialSupportWidget\Models\SocialSupportWidgetPreferentialCategory as SocialSupportWidgetPreferentialCategoryAlias;
use Modules\SocialSupportWidget\Models\SocialSupportWidgetSituation as SocialSupportWidgetSituationAlias;

/**
 * Class SocialSupportWidgetSocialSupportMeasure
 *
 * @property int $id
 * @property int|null $situation_id
 * @property string $name
 * @property string $conditions
 * @property string|null $amount_and_deadlines
 * @property string|null $law
 * @property string|null $min_amount
 * @property string|null $max_amount
 * @property int|null $max_family_income
 * @property int|null $min_child_age
 * @property int|null $max_child_age
 * @property Carbon $create_date
 * @property Carbon $update_date
 *
 * @property SocialSupportWidgetPreferentialCategory $preferential_categories
 *
 * @package App\Models\Base
 */
class SocialSupportWidgetSocialSupportMeasure extends Model
{
    public $timestamps = false;
    protected $table = 'social_support_widget_social_support_measures';
    protected $casts = [
        'situation_id' => 'int',
        'max_family_income' => 'int',
        'min_child_age' => 'int',
        'max_child_age' => 'int',
        'live_in_ugra_years' => 'int',
        'create_date' => 'date:d.m.Y',
        'update_date' => 'date:d.m.Y',
    ];

    public function preferential_categories(): BelongsToMany
    {
        return $this->belongsToMany(SocialSupportWidgetPreferentialCategoryAlias::class, 'social_support_widget_preferential_category_measure', 'measure_id', 'category_id');
    }

    public function situation(): BelongsTo
    {
        return $this->belongsTo(SocialSupportWidgetSituationAlias::class, 'situation_id');
    }
}
