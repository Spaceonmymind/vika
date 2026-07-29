<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\EmploymentUgraWidget\Models\Base;

use Modules\EmploymentUgraWidget\Models\EmploymentUgraWidgetCategory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmploymentUgraWidgetQuestion
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property int $category_id
 *
 * @property EmploymentUgraWidgetCategory $employment_ugra_widget_category
 *
 * @package App\Models\Base
 */
class EmploymentUgraWidgetQuestion extends Model
{
	protected $table = 'employment_ugra_widget_questions';
	public $timestamps = false;

	protected $casts = [
		'category_id' => 'int'
	];

	public function category()
	{
		return $this->belongsTo(EmploymentUgraWidgetCategory::class, 'category_id');
	}
}
