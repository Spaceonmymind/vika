<?php

namespace Modules\ActirovkiWidget\Helpers;

use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;

final class ModuleLog
{
    private const string MODULE_LOG_CHANNEL = 'actirovki';
    private const string TELEGRAM_LOG_CHANNEL = 'telegram_actirovki';

    public static function module(): LoggerInterface
    {
        return Log::channel(self::MODULE_LOG_CHANNEL);
    }

    public static function moduleAndTelegram(): LoggerInterface
    {
        return Log::stack([
            self::MODULE_LOG_CHANNEL,
            self::TELEGRAM_LOG_CHANNEL,
        ]);
    }

    public static function telegram(): LoggerInterface
    {
        return Log::channel(self::TELEGRAM_LOG_CHANNEL);
    }
}
