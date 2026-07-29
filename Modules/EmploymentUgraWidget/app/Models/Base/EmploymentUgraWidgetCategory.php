<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\EmploymentUgraWidget\Models\Base;

use Modules\EmploymentUgraWidget\Models\EmploymentUgraWidgetQuestion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmploymentUgraWidgetCategory
 *
 * @property int $id
 * @property string $name
 *
 * @property Collection|EmploymentUgraWidgetQuestion[] $employment_ugra_widget_questions
 *
 * @package App\Models\Base
 */
class EmploymentUgraWidgetCategory extends Model
{
	protected $table = 'employment_ugra_widget_categories';
	public $timestamps = false;

	public function questions()
	{
		return $this->hasMany(EmploymentUgraWidgetQuestion::class, 'category_id');
	}
}
