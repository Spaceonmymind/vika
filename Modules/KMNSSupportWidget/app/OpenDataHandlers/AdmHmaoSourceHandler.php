<?php

namespace Modules\KMNSSupportWidget\OpenDataHandlers;

use Modules\ITSupportWidget\Models\ItSupportWidgetMeasure;
use Modules\ITSupportWidget\Models\ItSupportWidgetOdDataset;
use Modules\KMNSSupportWidget\Models\KmnsSupportWidgetLifeActivityType;
use Modules\KMNSSupportWidget\Models\KmnsSupportWidgetMeasure;
use Modules\KMNSSupportWidget\Models\KmnsSupportWidgetOdDataset;

class AdmHmaoSourceHandler extends AbstractSourceHandler
{

    protected const array FIELDS = [
        'N',
        'SFERA_ZHIZNEDEYATELNOSTI',
        'NAIMENOVANIE_USLUGI',
        'ORGAN_OKAZYVAYUSHCHIY_USLUGU',
        'POLUCHATEL_USLUGI',
        'SROKI_OKAZANIYA_USLUGI',
        'SPOSOBY_PODACHI',
        'SPOSOBY_POLUCHENIYA_REZULTATA',
        'REZULTAT_OKAZANIYA_USLUGI',
        'DOKUMENTY_NEOBKHODIMYE_DLYA_POLUCHENIYA_',
        'SSYLKA'
    ];

    public static function processData(array $data, KmnsSupportWidgetOdDataset $dataset): void
    {

        $rows = $data['rows'];
        $lifeActivityTypes=KmnsSupportWidgetLifeActivityType::query()->get();
        foreach ($rows as $row) {
            $lifeActivityType= static::getReferenceId($lifeActivityTypes,$row['cols']['SFERA_ZHIZNEDEYATELNOSTI'],KmnsSupportWidgetLifeActivityType::query());
            KmnsSupportWidgetMeasure::query()->create([
                'name' => trim($row['cols']['NAIMENOVANIE_USLUGI']),
                'support_organisation' => self::prepareString($row['cols']['ORGAN_OKAZYVAYUSHCHIY_USLUGU']),
                'subject' => self::prepareString($row['cols']['POLUCHATEL_USLUGI']),
                'terms' => self::prepareString($row['cols']['SROKI_OKAZANIYA_USLUGI']),
                'apply_types' => self::prepareString($row['cols']['SPOSOBY_PODACHI']),
                'get_result_types' => self::prepareString($row['cols']['SPOSOBY_POLUCHENIYA_REZULTATA']),
                'measure_result' => self::prepareString($row['cols']['REZULTAT_OKAZANIYA_USLUGI']),
                'documents' => self::prepareString($row['cols']['DOKUMENTY_NEOBKHODIMYE_DLYA_POLUCHENIYA_']),
                'link' => self::prepareString($row['cols']['SSYLKA']),
                'activity_type_id'=>$lifeActivityType
            ]);

            self::$rowNumber++;
        }
    }
}
