<?php

namespace Modules\Chat\Helpers;

use Modules\Chat\Services\TolyaClassifierService;

class IntentQualifier
{
    private static TolyaClassifierService $classifierService;

    /**
     * Выполняет запрос к внешнему сервису определителю интентов и возвращает ответ
     * @param string $message
     * @param string $vikaType
     * @return array
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public static function getIntentWithEntities(string $message, string $vikaType = 'main'): array
    {
        return self::getClassifierService()
            ->getIntentWithEntities($message, $vikaType);
    }

    private static function getClassifierService(): TolyaClassifierService
    {
        if (!isset(self::$classifierService)) {
            self::$classifierService = new TolyaClassifierService();
        }
        return self::$classifierService;
    }

    public static function getResponseMessageFromLLM(string $message, string $intent): array
    {
        return self::getClassifierService()
            ->getResponseMessageFromLLM($message, $intent);
    }

    public static function getResponseMessageFromLLMByDocumentAndPrompt(string $document, string $systemPrompt, string $message): array
    {
        return self::getClassifierService()
            ->getResponseMessageFromLLMByDocumentAndPrompt(
                $document,
                $systemPrompt,
                $message
            );
    }
}
