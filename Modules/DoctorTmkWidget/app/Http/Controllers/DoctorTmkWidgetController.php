<?php

namespace Modules\DoctorTmkWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Integrations\Telemost\Contracts\TelemostClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\DoctorTmkWidget\Services\DoctorTmkWidgetService;
use Modules\DoctorTmkWidget\Swagger\Docs\Attributes\GetTmkConsultations;
use OpenApi\Attributes as OA;
use Throwable;

#[OA\Tag(name: 'DoctorTmkWidget', description: 'Виджет ТМК')]
class DoctorTmkWidgetController extends Controller
{
    private DoctorTmkWidgetService $doctorTmkWidgetService;

    /**
     * @param DoctorTmkWidgetService $doctorTmkWidgetService
     */
    public function __construct(DoctorTmkWidgetService $doctorTmkWidgetService)
    {
        $this->doctorTmkWidgetService = $doctorTmkWidgetService;
    }

    #[GetTmkConsultations]
    public function telemedicineConsultations(Request $request): JsonResponse
    {

        $snils = $request->session()->get('snils');

        if (!$snils) {
            return response()->json([
                'has_auth' => false,
                'success' => false,
                'consultations' => [],
                'error' => 'Требуется аутентификация в ЕСИА',
            ]);
        }

        try {
            $response = Http::baseUrl(config('services.vilar.base_url'))
                ->withHeader('X-VI-Access-Token', config('services.vilar.token'))
                ->acceptJson()
                ->timeout(10)
                ->get('/api/external/tmk/get_directions_for_patient', [
                    'snils' => $snils,
                ]);
        } catch (Throwable $exception) {
            Log::channel('vilar')->error('Ошибка запроса телемедицинских консультаций', [
                'error' => $exception->getMessage(),
            ]);

            return response()->json([
                'has_auth' => true,
                'success' => false,
                'consultations' => [],
                'error' => 'Не удалось получить данные о телемедицинских консультациях',
            ],);
        }

        if (!$response->successful()) {
            Log::channel('vilar')->error('Некорректный ответ от vilar при запросе телемедицинских консультаций', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'has_auth' => true,
                'success' => false,
                'consultations' => [],
                'error' => 'Сервис телемедицинских консультаций временно недоступен',
            ],);
        }

        $payload = $response->json();

        return response()->json([
            'has_auth' => true,
            'success' => true,
            'consultations' => $payload,
        ]);
    }

    public function createTelemostMeeting(TelemostClient $telemostClient): JsonResponse
    {
        $data = $telemostClient->createMeeting(waitingRoomLevel: 'PUBLIC')->json();

        return response()->json([
            'success' => true,
            'meeting' => [
                'id' => $data['id'] ?? null,
                'join_url' => $data['join_url'] ?? null,
            ],
        ]);
    }

    public function sendTmkNotification(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        return $this->doctorTmkWidgetService->sendTmkNotification(
            $validated['phone'],
            $validated['message'],
        );
    }


}
