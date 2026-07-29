<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\GosZakupkiWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GosZakupkiWidget\Models\GosZakupkiWidgetQuestionCategory;

/**
 * Class GosZakupkiWidgetQuestion
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property string|null $link
 * @property int $category_id
 *
 * @property \Modules\GosZakupkiWidget\Models\Base\GosZakupkiWidgetQuestionCategory $category
 *
 * @package App\Models\Base
 */
class GosZakupkiWidgetQuestion extends Model
{
	protected $table = 'gos_zakupki_widget_questions';
	public $timestamps = false;
	protected $casts = [
		'category_id' => 'int'
	];

	public function category():BelongsTo
	{
		return $this->belongsTo(GosZakupkiWidgetQuestionCategory::class, 'category_id');
	}
}
