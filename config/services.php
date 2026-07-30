<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'mfc_case_status' => [
        'url_case_status_by_snils' => 'http://5.141.28.74:5509/mfc/WebUI/corehost/CallCenterApi/GetUnclosedClaimsBySnils',
        'url_case_status_by_case_number' => 'http://5.141.28.74:5509/mfc/WebUI/corehost/CallCenterApi/GetClaimStatus',
    ],
    'humanitarian_points' => [
        'base_url' => env('HUMANITARIAN_POINTS_URL', 'https://gum.admhmao.ru'),
        'login' => env('HUMANITARIAN_POINTS_LOGIN'),
        'password' => env('HUMANITARIAN_POINTS_PASSWORD'),
    ],
    'intent_qualifiers' => [
        'tolya' => [
            'base_url' => env('TOLYA_INTENT_QUALIFIER_BASE_URL'),
            'fail_emulation_enabled' => (bool)env('TOLYA_INTENT_QUALIFIER_API_FAIL_EMULATION_ENABLED', false),
        ],
    ],
    'telegram' => [
        'token' => env('VIKA_TELEGRAM_BOT_TOKEN'),
    ],
    'max' => [
        'token' => env('MAX_API_TOKEN', ''),
        'web_app_base_url' => env('MAX_WEB_APP_BASE_URL', 'https://max.ru/ugra_vika_bot'),
        'bot_api_base_url' => env('MAX_BOT_API_BASE_URL', 'https://platform-api.max.ru'),
        'notification_token' => env('SUBSCRIBER_NOTIFICATIONS_TOKEN', ''),
    ],
    'timetable' => [
        'timesheet_url' => env('TIMETABLE_TIMESHEET_URL', 'http://5.141.28.74:5509/api/timesheet/GetOrganizationsTables?'),
        'organisations_url' => env('TIMETABLE_ORGANISATIONS_URL', 'http://5.141.28.74:5509/api/timesheet/GetOrganizations'),
    ],
    'it_registry' => [
        'base_url' => env('IT_REGISTRY_BASE_URL', 'https://itregistry.admhmao.ru'),
    ],
    'culture_ugra' => [
        'base_url' => env('CULTURE_UGRA_BASE_URL', 'https://culture.admhmao.ru'),
    ],
    'rrp' => [
        'base_url' => env('RRP_BASE_URL', null),
        'login' => env('RRP_LOGIN', null),
        'password' => env('RRP_PASSWORD', null),
        'auth_token_cache_key' => env('RRP_TOKEN_CACHE_KEY', 'rrp_auth_token'),
    ],
    'fer' => [
        'base_url' => env('FER_BASE_URL', null),
        'login' => env('FER_LOGIN', null),
        'password' => env('FER_PASSWORD', null),
        'auth_token_cache_key' => env('FER_TOKEN_CACHE_KEY', 'fer_auth_token'),

    ],
    'booking' => [
        'base_url' => env('BOOKING_BASE_URL', null),
    ],

    'admhmansy' => [
        'weather_api_url' => env('ADMHMANSY_WEATHER_API_URL', null),
        'weather_api_token' => env('ADMHMANSY_WEATHER_API_TOKEN', null),
    ],
    'gosuslugi86' => [
        'weather_mobile_app_api_url' => env('GOSUSLUGI86_WEATHER_MOBILE_APP_API_URL', null)
    ],
    'ugrameteo' => [
        'url' => env('UGRAMETEO_WEATHER_API_URL', null),
        'login' => env('UGRAMETEO_WEATHER_API_LOGIN', null),
        'password' => env('UGRAMETEO_WEATHER_API_PASSWORD', null),
    ],
    'actirovki' => [
        'users_chunk_size' => env('ACTIROVKI_USERS_CHUNK_SIZE_FOR_SENDING_NOTIFICATIONS', 50),
    ],
    'vilar'=>[
        'base_url' => env('VILAR_BASE_URL', 'https://vilar.admhmao.ru'),
        'token' => env('VILAR_API_TOKEN', null),
        'telemedicine_consultations_endpoint' => env('VILAR_TELEMED_CONSULTATIONS_ENDPOINT', '/api/telemedicine/consultations'),
    ],
    'telemost' => [
        'base_url' => env('TELEMOST_BASE_URL', 'https://cloud-api.yandex.net/v1/telemost-api'),
        'token' => env('TELEMOST_TOKEN'),
    ],
    'stop_graffiti' => [
        'integration_token' => env('STOP_GRAFFITI_INTEGRATION_TOKEN'),
        'bot_callback_url' => env('STOP_GRAFFITI_BOT_CALLBACK_URL'),
        'bot_callback_token' => env('STOP_GRAFFITI_BOT_CALLBACK_TOKEN'),
        'media_allowed_hosts' => array_filter(array_map(
            'trim',
            explode(',', (string) env('STOP_GRAFFITI_MEDIA_ALLOWED_HOSTS', 'i.oneme.ru')),
        )),
    ],
];
