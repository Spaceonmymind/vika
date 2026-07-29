<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\AbbreviationHelpWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AbbreviationHelpWidgetAbbreviation
 *
 * @property int $id
 * @property string $abbreviation
 * @property string $decoding
 * @property string|null $description
 *
 * @package App\Models\Base
 */
class AbbreviationHelpWidgetAbbreviation extends Model
{
	protected $table = 'abbreviation_help_widget_abbreviations';
	public $timestamps = false;
}
