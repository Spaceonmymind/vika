<?php

namespace Modules\AppointmentToDoctorWidget\Services\External;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache as Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FerService
{
    private $baseUrl;
    private $login;
    private $password;
    private $authTokenCacheKey;


    public function __construct()
    {
        $this->baseUrl = config('services.fer.base_url');
        $this->login = config('services.fer.login');
        $this->password = config('services.fer.password');
        $this->authTokenCacheKey = config('services.fer.auth_token_cache_key');
    }

    /**
     * Получить медорганизации для пациента
     * @param $patientId
     * @param $medOrganisations
     * @return array|null
     */
    public function getMedOrganisationsForPatient($patientId, $medOrganisations = [])
    {
        $patientId = mb_strtolower($patientId);
        $response = $this->post('/api/mo/data', $medOrganisations, queryParams: ['patientId' => $patientId]);
        if ($response === null) {
            return null;
        }
        return $response->collect('result')
            ->whereIn('enabled', ['ATTACHED_MO','ALL'])
            ->sortByDesc('enabled')
            ->select([
                'id',
                'parent_id',
                'name',
                'parent_name',
                'branch_oid',
                'address'
            ])->values()->toArray();
    }

    /**
     * Отправка POST запроса
     * @param string $uri
     * @param array $data
     * @param array $urlParams
     * @param array $queryParams
     * @return Response|null
     */
    private function post(string $uri, array $data = [], array $urlParams = [], array $queryParams = [])
    {
        return $this->sendRequest('post', $uri, $data, $urlParams, $queryParams);
    }

    /**
     * Отправка запроса
     * @param string $method
     * @param string $uri
     * @param array $data
     * @param array $urlParams
     * @param array $queryParams
     * @return Response|null
     */
    private function sendRequest(string $method, string $uri, array $data, array $urlParams, array $queryParams = []): Response|null
    {
        $response = null;
        $authToken = $this->getAuthToken();

        if ($authToken === null) {
            return null;
        }

        try {
            /**
             * @var Response|null $response
             */
            $response = Http::withoutVerifying()
                ->withToken($authToken)
                ->withQueryParameters($queryParams)
                ->withUrlParameters($urlParams)
                ->$method(
                    $this->baseUrl . $uri,
                    $data,
                );

        } catch (\Throwable $e) {
            Log::channel('appointment_to_doctor')->error('Не удалось отправить запрос в api фэр', [
                'api' => 'fer',
                'method' => $method,
                'url' => $uri,
                'params' => json_encode($urlParams, JSON_UNESCAPED_UNICODE),
                'body' => json_encode($data, JSON_UNESCAPED_UNICODE),
                'query_params' => json_encode($queryParams, JSON_UNESCAPED_UNICODE),
                'error' => $e->getMessage(),
            ]);

            return null;
        }


        if ($response->failed()) {
            Log::channel('appointment_to_doctor')->error('Не удалось отправить запрос в api фэр', [
                'api' => 'fer',
                'method' => $method,
                'url' => $uri,
                'params' => json_encode($urlParams, JSON_UNESCAPED_UNICODE),
                'body' => json_encode($data, JSON_UNESCAPED_UNICODE),
                'query_params' => json_encode($queryParams, JSON_UNESCAPED_UNICODE),
                'status_code' => $response->status(),
                'response_body' => $response->body(),
            ]);

            return null;
        }

        return $response;
    }

    /**
     * Получение токена авторизации
     * @return string|null
     */
    private function getAuthToken(): string|null
    {
        $authToken = Cache::get($this->authTokenCacheKey, false);

        if ($authToken !== false) {
            return $authToken;
        }

        try {
            $response = Http::withoutVerifying()->post($this->baseUrl . '/auth.svc', [
                'username' => $this->login,
                'password' => $this->password,
            ]);
        } catch (\Throwable $e) {
            Log::channel('appointment_to_doctor')->error('Не удалось получить токен авторизации', [
                'api' => 'fer',
                'error' => $e->getMessage(),
            ]);
            return null;
        }

        if ($response->failed()) {
            Log::channel('appointment_to_doctor')->error('Не удалось получить токен авторизации', [
                'api' => 'fer',
                'status_code' => $response->status(),
                'response_body' => $response->body(),
            ]);
            return null;
        }

        Cache::put(
            $this->authTokenCacheKey,
            $response->json('result.value'),
            Carbon::parse($response->json('result.validTo'))
                ->setTimezone(config('app.timezone'))
                ->subMinutes(10),
        );

        return $response->json('result.value');
    }

    /**
     * Отправка GET запроса
     * @param string $uri
     * @param array $data
     * @param array $urlParams
     * @return Response|null
     */
    private function get(string $uri, array $data = [], array $urlParams = []): Response|null
    {
        return $this->sendRequest('get', $uri, $data, $urlParams, []);

    }

    /**
     * Получение специальностей врачей с доступными слотами для записи
     * @param string $medOrganisationGuid
     * @param string $patientId
     * @return array|null
     */
    public function getDoctorSpecialitiesWithSlotsForPatient(string $medOrganisationGuid, string $patientId): array|null
    {
        $response = $this->get('/api/mo/{medOrganisationGuid}/available-posts', [
            //'tag-types' => 'EPGU',
            'patient-id' => mb_strtolower($patientId),
        ], [
            'medOrganisationGuid' => mb_strtolower($medOrganisationGuid),
        ],
        );
        if ($response === null) {
            return null;
        }
        return $response->json('result');
    }

    /**
     * Получение свободных слотов для записи к врачам по id должности
     * @param string $medOrganisationGuid
     * @param string $postId
     * @return array|null
     */
    public function getDoctorsFreeSlots(string $medOrganisationGuid, string $postId)
    {
        $response = $this->get('/api/mo/{medOrganisationGuid}/resources/slots', [
            'resources-post-id' => $postId,
            'tag-types' => ['EPGU','ORDINARY'],
            'slot-status' => 'AVAILABLE'
        ],
            [
                'medOrganisationGuid' => mb_strtolower($medOrganisationGuid)
            ]);
        if ($response === null) {
            return null;
        }
        return $response->json('result');
    }

    public function getBooksByPatientId(string $patientId): array|null
    {
        $response = $this->get('/api/books', [
            'patient_id' => mb_strtolower($patientId)
        ]);
        $books = $response?->json('result');

        if ($books === null) {
            return null;
        }

        $activeBooks = [];
        foreach ($books as $book) {
            if (Carbon::parse($book['visit_time'])->isPast()) {
                continue;
            }
            if ($book['status_code'] !== 5000) {
                continue;
            }
            $book['visit_time'] = Carbon::parse($book['visit_time'])->format('d.m.Y H:i');
            $activeBooks[] = $book;
        }

        return $activeBooks;
    }

    public function getDataForCancelBooking(string $slotId, string $resourceId, string $patientId)
    {
        $bookExtId = $this->getBookExtIdBySlotId($slotId);
        if ($bookExtId === null) {
            return null;
        }

        $moId = $this->getMoIdByResourceId($resourceId);
        if ($moId === null) {
            return null;
        }

        [$moOid, $departOid] = $this->getMoOidAndDepartOid($moId);
        if ($departOid === null || $moOid === null) {
            return null;
        }

        return [
            'slot_id' => $slotId,
            'depart_oid' => $departOid,
            'mo_oid' => $moOid,
            'book_ext_id' => $bookExtId,
            'patient_id' => $patientId,
        ];
    }

    private function getBookExtIdBySlotId(string $slotId)
    {
        $slotId = mb_strtolower($slotId);
        $slotInfo = $this->get(uri: "/api/slot/{slotId}/books", urlParams: ['slotId' => $slotId]);
        $slotInfo = $slotInfo?->json('result');

        if ($slotInfo === null) {
            return null;
        }

        foreach ($slotInfo as $book) {
            if ($book['status_code'] === 5000) {
                return $book['id'];
            }
        }
        return null;
    }

    private function getMoIdByResourceId(string $resourceId)
    {
        $resourceId = mb_strtolower($resourceId);
        $resourceData = $this->get('/api/resource/{resourceId}', urlParams: ['resourceId' => $resourceId]);
        $resourceData = $resourceData?->json('result');

        if ($resourceData === null) {
            return null;
        }

        if (count($resourceData) > 1) {
            Log::channel('appointment_to_doctor')->error('Вернулось больше одной больницы для сотрудника', [
                'resource_id' => $resourceId,
            ]);
        }

        return $resourceData[0]['mo_id'] ?? null;
    }

    private function getMoOidAndDepartOid($moId): ?array
    {
        $moId = mb_strtolower($moId);
        $moInfo = $this->get('/api/mo/{moId}', urlParams: ['moId' => $moId]);
        $moInfo = $moInfo?->json('result');

        if ($moInfo === null) {
            return null;
        }

        if (count($moInfo) > 1) {
            Log::channel('appointment_to_doctor')->error('Вернулось больше одного depart для больницы', [
                'mo_id' => $moId,
            ]);
        }

        $departOid = $moInfo[0]['branch_oid'] ?? null;
        $moOid = $moInfo[0]['parent_id'] ?? null;

        return [$moOid, $departOid];
    }
}
