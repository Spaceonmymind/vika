<?php

namespace Modules\AppointmentToDoctorWidget\Services\External;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache as Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RrpService
{
    private $baseUrl;
    private $login;
    private $password;
    private $authTokenCacheKey;

    /**
     * @param $baseUrl
     * @param $password
     * @param $login
     * @param $authTokenCacheKey
     */
    public function __construct()
    {
        $this->baseUrl = config('services.rrp.base_url');
        $this->login = config('services.rrp.login');
        $this->password = config('services.rrp.password');
        $this->authTokenCacheKey = config('services.rrp.auth_token_cache_key');
    }

    /**
     * Поиск пациентов по номеру телефона
     * @param $phone
     * @return array|null
     */
    public function findPatient($phone)
    {
        $response = $this->get('/IEMKRegionalService/services/patient/search', ['phone' => $phone]);

        if ($response === null) {
            return null;
        }

        $patients = $response
            ->collect('patients')
            ->whereNull('deathDate')
            ->values()
            ->map(function ($item) {
                return [
                    'guid' => $item['guid'],
                    'last_name' => $item['LastName'],
                    'first_name' => $item['FirstName'],
                    'middle_name' => $item['MiddleName'],
                    'birth_date' => isset($item['BirthDate']) ? Carbon::parse($item['BirthDate'])->format('d.m.Y') : null,
                ];
            });

            //Log::debug('found patients', ['phone' => $phone,'patients' => json_encode($patients->all())]);

        return $patients->all();
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
            Log::channel('appointment_to_doctor')->error('Не удалось отправить запрос в api ррп', [
                'api' => 'rrp',
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

            Log::channel('appointment_to_doctor')->error('Не удалось отправить запрос в api ррп', [
                'api' => 'rrp',
                'method' => $method,
                'url' => $uri,
                'params' => json_encode($urlParams, JSON_UNESCAPED_UNICODE),
                'body' => json_encode($data, JSON_UNESCAPED_UNICODE),
                'query_params' => json_encode($queryParams, JSON_UNESCAPED_UNICODE),
                'status_code' => $response->status(),
                'response_body' => $response->body(),
            ]);

            if($response->status() === 400) {
                if(isset($response->json()['ErrorCode']) && $response->json()['ErrorCode'] === 'R403') {
                    return $response;
                }
            }
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
            $response = Http::withoutVerifying()->post($this->baseUrl . '/auth', [
                'username' => $this->login,
                'password' => $this->password,
            ]);
        } catch (\Throwable $e) {
            Log::channel('appointment_to_doctor')->error('Не удалось получить токен авторизации', [
                'api' => 'rrp',
                'error' => $e->getMessage(),
            ]);
            return null;
        }

        if ($response->failed()) {
            Log::channel('appointment_to_doctor')->error('Не удалось получить токен авторизации', [
                'api' => 'rrp',
                'status_code' => $response->status(),
                'response_body' => $response->body(),
            ]);
            return null;
        }
        Cache::put($this->authTokenCacheKey, $response->json('access_token'), now()->addMilliseconds($response->json('expires_in') - 60000));

        return $response->json('access_token');
    }

    /**
     * Отправка POST запроса
     * @param string $uri
     * @param array $data
     * @param array $urlParams
     * @param array $queryParams
     * @return Response|null
     */
    private function post(string $uri, array $data = [], array $urlParams = [], array $queryParams = []): Response|null
    {
        return $this->sendRequest('post', $uri, $data, $urlParams, $queryParams);
    }
}
