<?php

namespace Modules\BusinessSupportWidget\OpenDataHandlers;

use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetMeasure;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetOdDataset;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetRegistrationPlace;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSituation;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSubject;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSupportOrganisation;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSupportType;

class RadujniySourceHandler extends AbstractSourceHandler
{

    protected const array FIELDS = [
        'ORGANIZATSIYA_PREDOSTAVLYAYUSHCHAYA_MERU',
        'VID_MERY_PODDERZHKI',
        'NAIMENOVANIE_MERY_PODDERZHKI',
        'ZHIZNENNAYA_SITUATSIYA',
        'POLUCHATELI_PODDERZHKI_',
        'OPISANIE_OBRAZOVATELNOY_PROGRAMMY',
        'MESTO_REGISTRATSII_ZAYAVITELYA',
        'NALICHIE_REGISTRATSII_ZAYAVITELYA_V_EDIN',
        'OTSUTSTVIE_PROSROCHENNOY_ZADOLZHENNOSTI_',
        'OTSUTSTVIE_ZADOLZHENNOSTI_SOGLASNO_OFITS',
        'OTSUTSTVIE_ZA_3_TRI_MESYATSA_PREDSHESTVU',
        'SUBEKT_NE_NAKHODITSYA_V_STADII_LIKVIDATS',
        'USLOVIYA_POLUCHENIYA_PODDERZHKI',
        'VIDY_DEYATELNOSTI',
        'RAZMER_FINANSOVOY_PODDERZHKI_',
        'PERECHEN_DOKUMENTOV_PREDOSTAVLYAEMYKH_ZA',
        'SROKI_POLUCHENIYA_PODDERZHKI_',
        'PRAVOVYE_OSNOVANIYA',
        'VYRUCHKA_NA_KONETS_GODA',
        'VOZRAST_KOMPANII',
        'DRUGIE_REESTRY_YUR__LITS',
        'KOLICHESTVO_SOTRUDNIKOV'
    ];

    public static function processData(array $data, BusinessSupportWidgetOdDataset $dataset): void
    {
        $registrationPlaces = BusinessSupportWidgetRegistrationPlace::query()->get()->keyBy(fn($item) => mb_strtolower($item->name));
        $situations = BusinessSupportWidgetSituation::query()->get()->keyBy(fn($item) => mb_strtolower($item->name));
        $subjects = BusinessSupportWidgetSubject::query()->get()->keyBy(fn($item) => mb_strtolower($item->name));
        $organisations = BusinessSupportWidgetSupportOrganisation::query()->get()->keyBy(fn($item) => mb_strtolower($item->name));
        $supportTypes = BusinessSupportWidgetSupportType::query()->get()->keyBy(fn($item) => mb_strtolower($item->name));

        $rows = $data['rows'];

        foreach ($rows as $row) {

            $registrationPlaceId = self::getReferenceId($registrationPlaces, static::prepareString($row['cols']['MESTO_REGISTRATSII_ZAYAVITELYA']), BusinessSupportWidgetRegistrationPlace::query());
            $situationId = self::getReferenceId($situations, static::prepareString($row['cols']['ZHIZNENNAYA_SITUATSIYA']), BusinessSupportWidgetSituation::query());
            $subjectId = self::getReferenceId($subjects, static::prepareString($row['cols']['POLUCHATELI_PODDERZHKI_']), BusinessSupportWidgetSubject::query());
            $organisationId = self::getReferenceId($organisations, static::prepareString($row['cols']['ORGANIZATSIYA_PREDOSTAVLYAYUSHCHAYA_MERU']), BusinessSupportWidgetSupportOrganisation::query());
            $supportTypeId = self::getReferenceId($supportTypes, static::prepareString($row['cols']['VID_MERY_PODDERZHKI']), BusinessSupportWidgetSupportType::query());

            BusinessSupportWidgetMeasure::query()->create([
                'name' => trim($row['cols']['NAIMENOVANIE_MERY_PODDERZHKI']),
                'description' => static::prepareString($row['cols']['OPISANIE_OBRAZOVATELNOY_PROGRAMMY']),
                'conditions' => static::prepareString($row['cols']['USLOVIYA_POLUCHENIYA_PODDERZHKI']),
                'activities' => static::prepareString($row['cols']['VIDY_DEYATELNOSTI']),
                'financial_support' => static::prepareString($row['cols']['RAZMER_FINANSOVOY_PODDERZHKI_']),
                'documents' => static::prepareString($row['cols']['PERECHEN_DOKUMENTOV_PREDOSTAVLYAEMYKH_ZA']),
                'terms' => static::prepareString($row['cols']['SROKI_POLUCHENIYA_PODDERZHKI_']),
                'law' => static::prepareString($row['cols']['PRAVOVYE_OSNOVANIYA']),
                'revenue_year'=>static::prepareString($row['cols']['VYRUCHKA_NA_KONETS_GODA']),
                //'date_receipt_documents' => static::prepareString($row['cols']['DATA_PRIEMA_DOKUMENTOV']),
                //'contacts' => static::prepareString($row['cols']['KONTAKTY_DLYA_DOPOLNITELNOY_INFORMATSII']),
                'company_age' => static::prepareString($row['cols']['VOZRAST_KOMPANII']),
                'employees' => static::prepareString($row['cols']['VOZRAST_KOMPANII']),
                'registration_place_id' => $registrationPlaceId,
                'situation_id' => $situationId,
                'subject_id' => $subjectId,
                'support_organisation_id' => $organisationId,
                'support_type_id' => $supportTypeId,
                'municipality_id' => $dataset->municipality_id,
            ]);
            self::$rowNumber++;
        }
    }
}
