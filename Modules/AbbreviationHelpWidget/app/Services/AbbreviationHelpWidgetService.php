<?php

namespace Modules\AbbreviationHelpWidget\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\AbbreviationHelpWidget\Models\AbbreviationHelpWidgetAbbreviation;

class AbbreviationHelpWidgetService {

    /**
     * Возвращает список аббревиатур
     * @param $name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAbbreviations($name = null) {
        return AbbreviationHelpWidgetAbbreviation::query()
            ->when(isset($name), function (Builder $q) use ($name) {
                $q->where('abbreviation', 'like', '%' . $name . '%');
            })
            ->get();
    }
}
