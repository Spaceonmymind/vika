<?php

namespace Modules\MFCApplicationStatusCheckWidget\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MFCApplicationStatusCheckWidgetService
{

    /**
     * Возвращает статус дела по номеру или СНИЛСу
     * @param $snilsOrNumber
     * @return array
     */
    public function getApplicationStatusByNumberOrSnils($snilsOrNumber):array
    {
        return $this->isValidSnils($snilsOrNumber) ?
            $this->getApplicationStatusBySnils($snilsOrNumber) :
            $this->getApplicationStatusByCaseNumber($snilsOrNumber);
    }

    /**
     * Проверяет является ли строка СНИЛСом
     * @param $snils
     * @return bool
     */
    private function isValidSnils($snils): bool
    {
        $pattern = '/^\d{3}-\d{3}-\d{3} \d{2}$/';
        return preg_match($pattern, $snils) === 1;
    }

    /**
     * Возвращает статус дела по СНИЛСу
     * @param string $snils
     * @return array
     */
    private function getApplicationStatusBySnils(string $snils)
    {
        $failed = false;
        $response = null;

        try {
            $response = Http::withoutVerifying()
                ->acceptJson()
                ->asJson()
                ->post(config('services.mfc_case_status.url_case_status_by_snils'), [
                    'page' => '1',
                    'size' => '5',
                    'snils' => $snils,
                ]);


            $failed = $response->failed() || $response->json('result', 1);

        } catch (\Throwable $e) {

            Log::channel('mfc_application_status')->error(
                'Не удалось получить статус дела по СНИЛСу', [
                'snils' => $snils,
                'exception' => $e->getMessage(),
            ],
            );
            return [
                'found_applications' => [],
                'is_snils' => true,
            ];

        }

        if ($failed) {

            Log::channel('mfc_application_status')->error(
                'Не удалось получить статус дела по СНИЛСу', [
                'snils' => $snils,
                'response_status' => $response->status(),
                'response_body' => $response->body(),
            ],
            );

            return [
                'found_applications' => [],
                'is_snils' => true,
            ];

        }

        return [
            'found_applications' => $response->collect('resultMessage')->map(function ($item) {
                return [
                    'created_date' => $item['insDate'] ?? null,
                    'status_text' => $item['statusText'] ?? null,
                    'mfc_address' => $item['servicesCenterAddress'] ?? null,
                    'service_name' => $item['srvServiceTitle'] ?? null,
                    'reg_num' => $item['regNum'] ?? null,
                ];
            }),
            'is_snils' => true,
        ];
    }

    /**
     * Возвращает статус дела по номеру
     * @param string $caseNumber
     * @return array
     */
    private function getApplicationStatusByCaseNumber(string $caseNumber)
    {

        $failed = false;
        $response = null;

        try {
            $response = Http::withoutVerifying()
                ->acceptJson()
                ->asJson()
                ->post(config('services.mfc_case_status.url_case_status_by_case_number'), [
                    'page' => '1',
                    'size' => '2',
                    'claimNum' => $caseNumber,
                ]);


            $failed = $response->failed() || $response->json('result', 1);

        } catch (\Throwable $e) {

            Log::channel('mfc_application_status')->error(
                'Не удалось получить статус дела по номеру дела', [
                'snils' => $caseNumber,
                'exception' => $e->getMessage(),
            ],

            );
            return [
                'found_applications' => [],
                'is_snils' => false,
            ];

        }

        if ($failed) {

            Log::channel('mfc_application_status')->error(
                'Не удалось получить статус дела по номеру дела', [
                'case_number' => $caseNumber,
                'response_status' => $response->status(),
                'response_body' => $response->body(),
            ],
            );

            return [
                'found_applications' => [],
                'is_snils' => false,
            ];

        }

        return [
            'found_applications' => [
                [
                    'mfc_address' => $response->json()['resultMessage']['returnPlaceAddr'] ?? null,
                    'reg_num' => $response->json()['resultMessage']['regNum'] ?? null,
                    'status_text' => $response->json()['resultMessage']['statusText'] ?? null,
                    'result_text' => $response->json()['resultMessage']['result'] ?? null,
                    'service_name' => $response->json()['resultMessage']['serviceName'] ?? null,
                ],
            ],
            'is_snils' => false,
        ];
    }
}
