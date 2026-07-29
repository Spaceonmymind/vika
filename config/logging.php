<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that is utilized to write
    | messages to your logs. The value provided here should match one of
    | the channels present in the list of "channels" configured below.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the log channel that should be used to log warnings
    | regarding deprecated PHP and library features. This allows you to get
    | your application ready for upcoming major versions of dependencies.
    |
    */

    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace' => env('LOG_DEPRECATIONS_TRACE', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Laravel
    | utilizes the Monolog PHP logging library, which includes a variety
    | of powerful log handlers and formatters that you're free to use.
    |
    | Available drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog", "custom", "stack"
    |
    */

    'channels' => [

        'stack' => [
            'driver' => 'stack',
            'channels' => explode(',', env('LOG_STACK', 'single')),
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => env('LOG_DAILY_DAYS', 14),
            'replace_placeholders' => true,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => env('LOG_SLACK_USERNAME', 'Laravel Log'),
            'emoji' => env('LOG_SLACK_EMOJI', ':boom:'),
            'level' => env('LOG_LEVEL', 'critical'),
            'replace_placeholders' => true,
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => env('LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
                'connectionString' => 'tls://' . env('PAPERTRAIL_URL') . ':' . env('PAPERTRAIL_PORT'),
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'stderr',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
            'facility' => env('LOG_SYSLOG_FACILITY', LOG_USER),
            'replace_placeholders' => true,
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],

        'phonebook_open_data' => [
            'driver' => 'daily',
            'path' => storage_path('logs/phonebook_widget/open_data.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 7,
        ],

        'telegram_phonebook' => [
            'driver' => 'monolog',
            'handler' => Monolog\Handler\TelegramBotHandler::class,
            'formatter' => \App\Logging\CustomizeTelegramFormatter::class,
            'level' => env('LOG_LEVEL', 'debug'),
            'with' => [
                'apiKey' => env('TELEGRAM_OPEN_DATA_BOT_TOKEN'),
                'channel' => env('TELEGRAM_OPEN_DATA_BOT_CHANNEL'),
                'topic' => env('TELEGRAM_PHONEBOOK_TOPIC', 4),
                'parseMode' => 'HTML'
            ]
        ],

        'fuel_price_open_data' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'fuel_price_open_data',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'telegram_fuel' => [
            'driver' => 'monolog',
            'handler' => Monolog\Handler\TelegramBotHandler::class,
            'formatter' => \App\Logging\CustomizeTelegramFormatter::class,
            'level' => env('LOG_LEVEL', 'debug'),
            'with' => [
                'apiKey' => env('TELEGRAM_OPEN_DATA_BOT_TOKEN'),
                'channel' => env('TELEGRAM_OPEN_DATA_BOT_CHANNEL'),
                'topic' => env('TELEGRAM_FUEL_TOPIC', 2),
                'parseMode' => 'HTML'
            ]
        ],

        'timetable_good_people' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'timetable_good_people',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'telegram_timetable' => [
            'driver' => 'monolog',
            'handler' => Monolog\Handler\TelegramBotHandler::class,
            'formatter' => \App\Logging\CustomizeTelegramFormatter::class,
            'level' => env('LOG_LEVEL', 'debug'),
            'with' => [
                'apiKey' => env('TELEGRAM_OPEN_DATA_BOT_TOKEN'),
                'channel' => env('TELEGRAM_OPEN_DATA_BOT_CHANNEL'),
                'topic' => env('TELEGRAM_TIMETABLE_TOPIC', 6),
                'parseMode' => 'HTML'
            ]
        ],
        'telegram_districts' => [
            'driver' => 'monolog',
            'handler' => Monolog\Handler\TelegramBotHandler::class,
            'formatter' => \App\Logging\CustomizeTelegramFormatter::class,
            'level' => env('LOG_LEVEL', 'debug'),
            'with' => [
                'apiKey' => env('TELEGRAM_OPEN_DATA_BOT_TOKEN'),
                'channel' => env('TELEGRAM_OPEN_DATA_BOT_CHANNEL'),
                'topic' => env('TELEGRAM_DISTRICTS_TOPIC', 177),
                'parseMode' => 'HTML'
            ]
        ],
        'districts_open_data' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'districts_open_data',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],
        'telegram_social_help_measures' => [
            'driver' => 'monolog',
            'handler' => Monolog\Handler\TelegramBotHandler::class,
            'formatter' => \App\Logging\CustomizeTelegramFormatter::class,
            'level' => env('LOG_LEVEL', 'debug'),
            'with' => [
                'apiKey' => env('TELEGRAM_OPEN_DATA_BOT_TOKEN'),
                'channel' => env('TELEGRAM_OPEN_DATA_BOT_CHANNEL'),
                'topic' => env('TELEGRAM_SOCIAL_HELP_MEASURES_TOPIC', 244),
                'parseMode' => 'HTML'
            ]
        ],
        'social_help_measures_open_data' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'social_help_measures_open_data',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],
        'telegram_business_help_measures' => [
            'driver' => 'monolog',
            'name' => 'telegram_business_help_measures',
            'handler' => Monolog\Handler\TelegramBotHandler::class,
            'formatter' => \App\Logging\CustomizeTelegramFormatter::class,
            'level' => env('LOG_LEVEL', 'debug'),
            'with' => [
                'apiKey' => env('TELEGRAM_OPEN_DATA_BOT_TOKEN'),
                'channel' => env('TELEGRAM_OPEN_DATA_BOT_CHANNEL'),
                'topic' => env('TELEGRAM_BUSINESS_HELP_MEASURES_TOPIC', 255),
                'parseMode' => 'HTML'
            ]
        ],
        'business_help_measures_open_data' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'business_help_measures_open_data',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [
                PsrLogMessageProcessor::class
            ],
        ],
        'mfc_application_status' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'mfc_application_status',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'chat' => [
            'driver' => 'monolog',
            'level' => 'debug',
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'chat',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],
        'tolya_classifier_api' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'tolya_classifier_api',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],
        'appointment_to_doctor' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'appointment_to_doctor',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'vilar' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'vilar',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],
        'sport_sections_open_data' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'sport_sections_open_data',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'telegram_sport_sections' => [
            'driver' => 'monolog',
            'handler' => Monolog\Handler\TelegramBotHandler::class,
            'formatter' => \App\Logging\CustomizeTelegramFormatter::class,
            'level' => env('LOG_LEVEL', 'debug'),
            'with' => [
                'apiKey' => env('TELEGRAM_OPEN_DATA_BOT_TOKEN'),
                'channel' => env('TELEGRAM_OPEN_DATA_BOT_CHANNEL'),
                'topic' => env('TELEGRAM_SPORT_SECTIONS_TOPIC', 249),
                'parseMode' => 'HTML'
            ]
        ],
        'it_support_open_data' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'it_support_open_data',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'telegram_it_support' => [
            'driver' => 'monolog',
            'handler' => Monolog\Handler\TelegramBotHandler::class,
            'formatter' => \App\Logging\CustomizeTelegramFormatter::class,
            'level' => env('LOG_LEVEL', 'debug'),
            'with' => [
                'apiKey' => env('TELEGRAM_OPEN_DATA_BOT_TOKEN'),
                'channel' => env('TELEGRAM_OPEN_DATA_BOT_CHANNEL'),
                'topic' => env('TELEGRAM_IT_SUPPORT_TOPIC', 332),
                'parseMode' => 'HTML'
            ]
        ],
        'kmns_support_open_data' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'kmns_support_open_data',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'telegram_kmns_support' => [
            'driver' => 'monolog',
            'handler' => Monolog\Handler\TelegramBotHandler::class,
            'formatter' => \App\Logging\CustomizeTelegramFormatter::class,
            'level' => env('LOG_LEVEL', 'debug'),
            'with' => [
                'apiKey' => env('TELEGRAM_OPEN_DATA_BOT_TOKEN'),
                'channel' => env('TELEGRAM_OPEN_DATA_BOT_CHANNEL'),
                'topic' => env('TELEGRAM_KMNS_SUPPORT_TOPIC', 417),
                'parseMode' => 'HTML'
            ]
        ],

        'culture_ugra' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'culture_ugra',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'humanitarian_points' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'humanitarian_points',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'otlp' => [
            'driver' => 'monolog',
            'handler' => \Keepsuit\LaravelOpenTelemetry\Support\OpenTelemetryMonologHandler::class,
            'level' => 'debug',
        ],

        'info_systems_open_data' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'info_systems_open_data',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'telegram_info_systems' => [
            'driver' => 'monolog',
            'handler' => Monolog\Handler\TelegramBotHandler::class,
            'formatter' => \App\Logging\CustomizeTelegramFormatter::class,
            'level' => env('LOG_LEVEL', 'debug'),
            'with' => [
                'apiKey' => env('TELEGRAM_OPEN_DATA_BOT_TOKEN'),
                'channel' => env('TELEGRAM_OPEN_DATA_BOT_CHANNEL'),
                'topic' => env('TELEGRAM_INFO_SYSTEMS_TOPIC', 963),
                'parseMode' => 'HTML'
            ]
        ],
        'telegram_actirovki' => [
            'driver' => 'monolog',
            'handler' => Monolog\Handler\TelegramBotHandler::class,
            'formatter' => \App\Logging\CustomizeTelegramFormatter::class,
            'level' => env('LOG_LEVEL', 'debug'),
            'with' => [
                'apiKey' => env('TELEGRAM_OPEN_DATA_BOT_TOKEN'),
                'channel' => env('TELEGRAM_OPEN_DATA_BOT_CHANNEL'),
                'topic' => env('TELEGRAM_ACTIROVKI_TOPIC', 3247),
                'parseMode' => 'HTML'
            ]
        ],
        'actirovki' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'name' => 'actirovki',
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],
    ],

];
