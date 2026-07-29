<?php

namespace Modules\Chat\IntentHandlers;

interface ChatIntentHandlerInterface {
    public static function getResponseDataByIntent(string $intent,string $vikaType,array $entities,?string $message):array;
}
