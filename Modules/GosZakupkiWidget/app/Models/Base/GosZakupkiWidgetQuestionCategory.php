<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\GosZakupkiWidget\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\GosZakupkiWidget\Models\GosZakupkiWidgetQuestion;

/**
 * Class GosZakupkiWidgetQuestionCategory
 *
 * @property int $id
 * @property string $name
 *
 * @property Collection|GosZakupkiWidgetQuestion[] $gos_zakupki_widget_questions
 *
 * @package App\Models\Base
 */
class GosZakupkiWidgetQuestionCategory extends Model
{
	protected $table = 'gos_zakupki_widget_question_categories';
	public $timestamps = false;

	public function gos_zakupki_widget_questions()
	{
		return $this->hasMany(GosZakupkiWidgetQuestion::class, 'category_id');
	}
}
