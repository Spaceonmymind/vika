<?php

namespace Modules\PhoneBookWidget\OpenDataHandlers;

use Illuminate\Support\Facades\Log;
use Modules\PhoneBookWidget\Models\OdDataset;
use Modules\PhoneBookWidget\Models\PhonebookRecord;

class KhantyMansiyskAdministrationXmlSourceHandler implements OpenDataHandler
{
    public static function handle(array $data, OdDataset $dataset): void
    {
        $rows = $data['DirectoryEntry'];

        foreach ($rows as $row)
            try {
                $internalPhone = !empty($row->InternalPhone) ? (' доб. ' . $row->InternalPhone) : null;
                $fullPhone = ($row->Phone ?? null) . $internalPhone;

                PhonebookRecord::query()
                    ->insert([
                        'fio' => $row->Name ?? null,
                        'post' => $row->Post ?? null,
                        'phone' => $fullPhone,
                        'administration_body_name' => 'Администрация Ханты-Мансийска',
                        'management_department' => $row->Otdel ?? null,
                        'email' => $row->Email ?? null,
                        'od_api_id' => $dataset->id
                    ]);
            } catch (\Throwable $e) {
                Log::channel('phonebook_open_data')->error('od_handler_error Ошибка при обновлении телефонного справочника',
                    [
                        'handler' => __CLASS__,
                        'row' => json_encode($row, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
                        'dataset_url' => $dataset->url,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);
            }
    }
}
