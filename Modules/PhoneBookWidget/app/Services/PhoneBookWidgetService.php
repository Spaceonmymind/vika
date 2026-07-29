<?php

namespace Modules\PhoneBookWidget\Services;

use Modules\PhoneBookWidget\Models\PhonebookRecord;

class PhoneBookWidgetService
{
    public function getPeoplesContacts($fioOrCompany)
    {
        $minRelevance = 5;
        $fioOrCompanyForFullTextSearch = str_replace(' ', '*', $fioOrCompany) . '*';

        return PhonebookRecord::query()
            ->select('*')
            ->selectRaw(
                'MATCH(fio) AGAINST(? IN BOOLEAN MODE) AS relevance',
                [$fioOrCompanyForFullTextSearch],
            )
            ->whereRaw(
                'MATCH(fio) AGAINST(? IN BOOLEAN MODE) >= ?',
                [$fioOrCompanyForFullTextSearch, $minRelevance],
            )
            ->orWhere('administration_body_name', 'like', "%$fioOrCompany%")
            ->orderBy('relevance', 'DESC')
            ->limit(50)
            ->get();
    }
}
