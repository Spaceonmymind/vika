<?php

namespace Modules\BusinessSupportWidget\OpenDataHandlers;

use Illuminate\Support\Facades\Http;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetMeasure;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetOdDataset;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetRegistrationPlace;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSituation;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSubject;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSupportOrganisation;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSupportType;

class NizhnevartovskSourceHandler extends AbstractSourceHandler
{
    protected const array FIELDS =  [
        'ORGANIZATSIYA_PREDOSTAVLYAYUSHCHAYA_MERU',
        'VID_MERY_PODDERZHKI',
        'NAIMENOVANIE_MERY_PODDERZHKI',
        'ZHIZNENNAYA_SITUATSIYA',
        'POLUCHATELI_PODDERZHKI',
        'OPISANIE_PROGRAMMY',
        'MESTO_REGISTRATSII_ZAYAVITELYA',
        'USLOVIYA_POLUCHENIYA_PODDERZHKI',
        'VIDY_DEYATELNOSTI',
        'RAZMER_FINANSOVOY_PODDERZHKI_I_VOZNAGRAZ',
        'PERECHEN_DOKUMENTOV_PREDOSTAVLYAEMYKH_Z',
        'SROKI_POLUCHENIYA_PODDERZHKI',
        'DATA_PRIEMA_DOKUMENTOV',
        'KONTAKTY_DLYA_DOPOLNITELNOY_INFORMATSII',
        'VOZRAST_KOMPANII',
        'NAIMENOVANIE_PARAMETRA_1',
        'ZNACHENIE_PARAMETRA_1_MIN',
    ];

    public static function processData(array $data, BusinessSupportWidgetOdDataset $dataset): void
    {
        $rows = $data['RESULT']['ROWS'];

        $registrationPlaces = BusinessSupportWidgetRegistrationPlace::query()->get()->keyBy(fn($item) => mb_strtolower($item->name));
        $situations = BusinessSupportWidgetSituation::query()->get()->keyBy(fn($item) => mb_strtolower($item->name));
        $subjects = BusinessSupportWidgetSubject::query()->get()->keyBy(fn($item) => mb_strtolower($item->name));
        $organisations = BusinessSupportWidgetSupportOrganisation::query()->get()->keyBy(fn($item) => mb_strtolower($item->name));
        $supportTypes = BusinessSupportWidgetSupportType::query()->get()->keyBy(fn($item) => mb_strtolower($item->name));


        foreach ($rows as $row) {

            $registrationPlaceId = self::getReferenceId($registrationPlaces, static::prepareString($row['MESTO_REGISTRATSII_ZAYAVITELYA']), BusinessSupportWidgetRegistrationPlace::query());
            $situationId = self::getReferenceId($situations, static::prepareString($row['ZHIZNENNAYA_SITUATSIYA']), BusinessSupportWidgetSituation::query());
            $subjectId = self::getReferenceId($subjects, static::prepareString($row['POLUCHATELI_PODDERZHKI']), BusinessSupportWidgetSubject::query());
            $organisationId = self::getReferenceId($organisations, static::prepareString($row['ORGANIZATSIYA_PREDOSTAVLYAYUSHCHAYA_MERU']), BusinessSupportWidgetSupportOrganisation::query());
            $supportTypeId = self::getReferenceId($supportTypes, static::prepareString($row['VID_MERY_PODDERZHKI']), BusinessSupportWidgetSupportType::query());

            BusinessSupportWidgetMeasure::query()->create([
                'name' => trim($row['NAIMENOVANIE_MERY_PODDERZHKI']),
                'description' => static::prepareString($row['OPISANIE_PROGRAMMY']),
                'conditions' => static::prepareString($row['USLOVIYA_POLUCHENIYA_PODDERZHKI']),
                'activities' => static::prepareString($row['VIDY_DEYATELNOSTI']),
                'financial_support' => static::prepareString($row['RAZMER_FINANSOVOY_PODDERZHKI_I_VOZNAGRAZ']),
                'documents' => static::prepareString($row['PERECHEN_DOKUMENTOV_PREDOSTAVLYAEMYKH_Z']),
                'terms' => static::prepareString($row['SROKI_POLUCHENIYA_PODDERZHKI']),
                'date_receipt_documents' => static::prepareString($row['DATA_PRIEMA_DOKUMENTOV']),
                'contacts' => static::prepareString($row['KONTAKTY_DLYA_DOPOLNITELNOY_INFORMATSII']),
                'company_age' => static::prepareString($row['VOZRAST_KOMPANII']),
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

    protected static function getColsArray(array $data): array
    {
        return $data['RESULT']['ROWS'][0] ?? [];
    }

    protected static function getValidateRules(): array
    {
        $rules = [
            'RESULT' => 'required|array',
            'RESULT.ROWS' => 'required|array',
        ];

        foreach (static::FIELDS as $field) {
            $rules['RESULT.ROWS.*.' . $field] = 'present|nullable';
        }

        return $rules;
    }
}
