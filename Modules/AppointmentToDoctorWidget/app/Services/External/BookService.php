<?php

namespace Modules\AppointmentToDoctorWidget\Services\External;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BookService
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.booking.base_url');
    }

    /**
     * Бронирование слота
     * @param string $patientId
     * @param string $slotId
     * @param string $departOid
     * @param string $moOid
     * @return array|null
     */
    public function bookSlot(string $patientId, string $slotId, string $departOid,string $moOid): array|null
    {
        $response = $this->post('/MIS/booking/book', [
            'slot_id' => mb_strtolower($slotId),
            'patient_id' => mb_strtolower($patientId),
            'depart_oid' => mb_strtolower($departOid),
            'mo_oid' => mb_strtolower($moOid),
            'booking_type' => 'APPOINTMENT',
            'preliminary_reservation' => true,
        ]);
        if ($response === null) {
            return null;
        }


        return $response->json();
    }

    /**
     * Отправка POST запроса в API
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

    /**
     * Отправка запроса в API
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


        try {
            /**
             * @var Response|null $response
             */
            $response = Http::withoutVerifying()
                ->withQueryParameters($queryParams)
                ->withUrlParameters($urlParams)
                ->$method(
                    $this->baseUrl . $uri,
                    $data,
                );
        } catch (\Throwable $e) {
            Log::channel('appointment_to_doctor')->error('Не удалось отправить запрос в api фэр', [
                'api' => 'booking',
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
                'api' => 'booking',
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
        if ($response->json('type') === 'BookResponseError') {
            Log::channel('appointment_to_doctor')->error('Ошибка при бронировании слота в api фэр', [
                'api' => 'booking',
                'method' => $method,
                'url' => $uri,
                'params' => json_encode($urlParams, JSON_UNESCAPED_UNICODE),
                'body' => json_encode($data, JSON_UNESCAPED_UNICODE),
                'query_params' => json_encode($queryParams, JSON_UNESCAPED_UNICODE),
                'status_code' => $response->status(),
                'response_body' => $response->body(),
            ]);
        }
        return $response;
    }

    public function cancelBooking(string $slotId, string $patientId, string $departOid, string $moOid, string $bookExtId): array|null
    {
        $response = $this->post('/MIS/booking/cancel', [
            'slot_id' => mb_strtolower($slotId),
            'patient_id' => mb_strtolower($patientId),
            'depart_oid' => mb_strtolower($departOid),
            'mo_oid' => mb_strtolower($moOid),
            'book_ext_id' => mb_strtolower($bookExtId),
        ]);

        if ($response === null) {
            return null;
        }

        return $response->json();
    }

    /**
     * Отправка GET запроса в API
     * @param string $uri
     * @param array $data
     * @param array $urlParams
     * @return Response|null
     */
    private function get(string $uri, array $data = [], array $urlParams = []): Response|null
    {
        return $this->sendRequest('get', $uri, $data, $urlParams, []);

    }
}
