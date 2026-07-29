<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\PfrHelpWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PfrHelpWidget\Models\PfrHelpWidgetQuestionCategory;

/**
 * Class PfrHelpWidgetQuestion
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property int $category_id
 *
 * @property \Modules\PfrHelpWidget\Models\Base\PfrHelpWidgetQuestionCategory $pfr_help_widget_question_category
 *
 * @package App\Models\Base
 */
class PfrHelpWidgetQuestion extends Model
{
	protected $table = 'pfr_help_widget_questions';
	public $timestamps = false;

	protected $casts = [
		'category_id' => 'int'
	];

	public function category():BelongsTo
	{
		return $this->belongsTo(PfrHelpWidgetQuestionCategory::class, 'category_id');
	}
}
