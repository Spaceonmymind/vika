<?php

namespace App\Integrations\Telemost;

use App\Integrations\Telemost\Contracts\TelemostClient;
use App\Services\ExternalApi\Contracts\ExternalApiClient;
use Illuminate\Http\Client\Response;

final readonly class TelemostApiClient implements TelemostClient
{
    public function __construct(
        private ExternalApiClient $client,
    )
    {
    }

    /**
     * Создать видеовстречу. Live-трансляция не передаётся, если параметр null.
     *
     * @param string|null $waitingRoomLevel Уровень ожидания (PUBLIC, ORGANIZATION, ADMINS). Null — использовать настройку по умолчанию.
     * @param array<int, array{email: string}> $cohosts Список соведущих (email).
     * @param array{access_level?: string, title?: string, description?: string}|null $liveStream Данные live-трансляции или null.
     * @return Response Ответ API в формате ConferenceShort.
     */
    public function createMeeting(
        ?string $waitingRoomLevel = null,
        array   $cohosts = [],
        ?array  $liveStream = null,
    ): Response
    {
        $payload = array_filter([
            'waiting_room_level' => $waitingRoomLevel,
            'cohosts' => $cohosts ?: null,
            'live_stream' => $liveStream,
        ], static fn($value) => $value !== null);

        $response = $this->client->request('POST', '/conferences', [
            'json' => $payload,
        ]);

        return $response->throw();
    }
}
