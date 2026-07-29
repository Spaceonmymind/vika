<?php

namespace Modules\InformationSystemsWidget\OpenDataHandlers;

use Modules\InformationSystemsWidget\Models\InformationSystem;
use Modules\InformationSystemsWidget\Models\OdDataset;
use Modules\InformationSystemsWidget\Models\Operator;
use Modules\InformationSystemsWidget\Models\Owner;
use Modules\InformationSystemsWidget\Models\Purpose;
use Modules\InformationSystemsWidget\Models\SubSystem;

class SourceHandler extends AbstractSourceHandler
{
    protected static function processData(object $data, OdDataset $dataset): void
    {
        foreach ($data->GetPassportISResult->Passports->Passport as $passport) {
            $infSys = InformationSystem::query()->create([
                'unique_number' => $passport->UniqueNumber,
                'full_name' => $passport->FullName ?? null,
                'short_name' => $passport->ShortName ?? null,
                'targets' => $passport->Targets ?? null,
                'owner_id' => static::getOwnerId($passport->Owner),
                'state_info_sys' => $passport->StateIS ?? null,
                'operator_id' => static::getOperatorId($passport->Operator),
                'url' => $passport->Url ?? null
            ]);

            static::explodePurposeString($passport->Purposes ?? null, $infSys);
            static::explodeSubSystemsString($passport->SubSystems ?? null, $infSys);

            static::$rowNumber++;
        }
    }

    protected static function getOwnerId(?string $ownerName): ?int
    {
        if (empty($ownerName))
            return null;

        $ownerName = trim($ownerName);
        return Owner::query()->firstOrCreate(['name' => $ownerName])->id;
    }

    protected static function getOperatorId(?string $operatorName): ?int
    {
        if (empty($operatorName))
            return null;

        $operatorName = trim($operatorName);
        return Operator::query()->firstOrCreate(['name' => $operatorName])->id;
    }

    protected static function explodePurposeString(?string $purposesString, InformationSystem $infSys): void
    {
        if (empty($purposesString))
            return;
        $listOfPurposes = explode("\n", $purposesString);
        $listOfPurposes = array_map('trim', $listOfPurposes);

        foreach ($listOfPurposes as $purposeName) {
            $purpose = Purpose::query()
                ->firstOrCreate(['name' => $purposeName]);

            $infSys->purposes()->attach($purpose->id);
        }
    }

    protected static function explodeSubSystemsString(?string $subSystemsString, InformationSystem $infSys): void
    {
        if (empty($subSystemsString))
            return;
        $listOfSubSystems = explode("\n", $subSystemsString);
        $listOfSubSystems = array_map(function ($str) {
            // Удаление невидимых символов, включая <0xad> - невидимый дефис
            $str = preg_replace('/[\x00-\x1F\x7F\xA0\xAD]/u', '', $str);
            $str = trim($str);

            // Извлечение URL и Helpdesk email, если они есть
            $pattern = '/(\(https?:\/\/[^\)]+\))?:?Helpdesk:([^\s]+)/';
            $matches = [];
            if (preg_match($pattern, $str, $matches)) {
                $url = !empty($matches[1]) ? trim($matches[1], '()') : null;
                $helpdesk = $matches[2];

                // Удаление найденной информации из названия
                $str = trim(preg_replace($pattern, '', $str));
            } else {
                $url = null;
                $helpdesk = null;
            }

            return [
                'name' => $str,
                'site' => $url,
                'helpdesk' => $helpdesk
            ];
        }, $listOfSubSystems);

        foreach ($listOfSubSystems as $subSystem) {
            $subSystemModel = SubSystem::query()->firstOrCreate(
                [
                    'name' => $subSystem['name'],
                    'site' => $subSystem['site'],
                    'helpdesk' => $subSystem['helpdesk'],
                ]
            );

            $infSys->subsystems()->attach($subSystemModel->id);
        }
    }
}
