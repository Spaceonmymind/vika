<?php

namespace Modules\AbbreviationHelpWidget\Models;

use Modules\AbbreviationHelpWidget\Models\Base\AbbreviationHelpWidgetAbbreviation as BaseAbbreviationHelpWidgetAbbreviation;

class AbbreviationHelpWidgetAbbreviation extends BaseAbbreviationHelpWidgetAbbreviation
{
	protected $fillable = [
		'abbreviation',
		'decoding',
		'description'
	];
}
