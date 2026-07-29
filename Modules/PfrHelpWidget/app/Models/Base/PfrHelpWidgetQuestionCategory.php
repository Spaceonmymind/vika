<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\PfrHelpWidget\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\PfrHelpWidget\Models\PfrHelpWidgetQuestion;
use Modules\PfrHelpWidget\Models\PfrHelpWidgetService;

/**
 * Class PfrHelpWidgetQuestionCategory
 *
 * @property int $id
 * @property string $name
 * @property int $service_id
 *
 * @property \Modules\PfrHelpWidget\Models\Base\PfrHelpWidgetService $pfr_help_widget_service
 * @property Collection|\Modules\PfrHelpWidget\Models\Base\PfrHelpWidgetQuestion[] $pfr_help_widget_questions
 *
 * @package App\Models\Base
 */
class PfrHelpWidgetQuestionCategory extends Model
{
	protected $table = 'pfr_help_widget_question_categories';
	public $timestamps = false;

	protected $casts = [
		'service_id' => 'int'
	];

	public function service()
	{
		return $this->belongsTo(PfrHelpWidgetService::class, 'service_id');
	}

	public function questions()
	{
		return $this->hasMany(PfrHelpWidgetQuestion::class, 'category_id');
	}
}
