<?php

namespace App\Integrations\Telemost\Contracts;

use Illuminate\Http\Client\Response;

interface TelemostClient
{
    /**
     * Создать видеовстречу. Live-трансляция не передаётся (null), если не нужна.
     *
     * @param string|null $waitingRoomLevel Уровень ожидания (PUBLIC, ORGANIZATION, ADMINS). Null — использовать настройку по умолчанию.
     * @param array<int, array{email: string}> $cohosts Список соведущих (email).
     * @param array{access_level?: string, title?: string, description?: string}|null $liveStream Данные live-трансляции или null.
     * @return Response Ответ API в формате ConferenceShort.
     */
    public function createMeeting(
        ?string $waitingRoomLevel = 'PUBLIC',
        array   $cohosts = [],
        ?array  $liveStream = null,
    ): Response;
}
