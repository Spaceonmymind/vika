<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\PfrHelpWidget\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\PfrHelpWidget\Models\PfrHelpWidgetQuestionCategory;

/**
 * Class PfrHelpWidgetService
 *
 * @property int $id
 * @property string $name
 *
 * @property Collection|\Modules\PfrHelpWidget\Models\Base\PfrHelpWidgetQuestionCategory[] $pfr_help_widget_question_categories
 *
 * @package App\Models\Base
 */
class PfrHelpWidgetService extends Model
{
	protected $table = 'pfr_help_widget_services';
	public $timestamps = false;

	public function question_categories()
	{
		return $this->hasMany(PfrHelpWidgetQuestionCategory::class, 'service_id');
	}
}
