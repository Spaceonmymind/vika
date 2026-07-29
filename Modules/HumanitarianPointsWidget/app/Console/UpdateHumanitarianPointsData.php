<?php

namespace Modules\HumanitarianPointsWidget\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\HumanitarianPointsWidget\Models\HumanitarianPointsWidgetHumanitarianPoint;
use Modules\HumanitarianPointsWidget\Models\HumanitarianPointsWidgetMunicipality;
use Modules\HumanitarianPointsWidget\Models\HumanitarianPointsWidgetToken;

class UpdateHumanitarianPointsData extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'humanitarian-points:update-data';

    /**
     * The console command description.
     */
    protected $description = 'Обновляет информацию о пунктах приёма гуманитарной помощи и муниципалитетах';

    protected const string DATASET_LOG_CHANEL = 'humanitarian_points';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Context::add('module', 'HumanitarianPointsWidget');
        DB::beginTransaction();
        try {
            $token = $this->getAuthToken();
            if (!isset($token)) {
                return self::FAILURE;
            }
            HumanitarianPointsWidgetMunicipality::query()->delete();

            if ($this->updateMunicipalities($token)) {

                $this->updatePoints($token);

            }

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::channel(static::DATASET_LOG_CHANEL)->error('Ошибка при обновлении данных.', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
        DB::commit();

        Log::stack([static::DATASET_LOG_CHANEL])
            ->info(
                "Процесс обновления данных в виджете \"О пунктах приёма гуманитарной помощи и муниципалитетах\" завершён."
            );

        return self::SUCCESS;
    }

    public function getAuthToken(): ?string
    {
        $tokenModel = HumanitarianPointsWidgetToken::query()
            ->where('valid_to', '>=', Carbon::now()->addMinutes(5))
            ->first();

        if (!$tokenModel instanceof HumanitarianPointsWidgetToken) {
            $tokenResponse = Http::withoutVerifying()
                ->acceptJson()
                ->post(config('services.humanitarian_points.base_url') . '/api/auth/login', [
                    'login' => config('services.humanitarian_points.login'),
                    'password' => config('services.humanitarian_points.password'),
                    'isPortal' => false,
                ]);

            $token = $tokenResponse->json('token', null);
            if (!isset($token)) {
                Log::channel(static::DATASET_LOG_CHANEL)->error('Не удалось получить токен', [
                    'response_code' => $tokenResponse->getStatusCode(),
                    'response_body' => $tokenResponse->body(),
                ]);
                return null;
            }
            $tokenModel = HumanitarianPointsWidgetToken::query()->create([
                'token' => $token,
                'valid_to' => Carbon::now()->addHours(4),
            ]);
        }

        return $tokenModel->token;
    }

    public function updateMunicipalities(string $token): bool
    {
        $response = Http::withoutVerifying()
            ->withToken($token)
            ->acceptJson()
            ->get(config('services.humanitarian_points.base_url') . '/api/catalogs/municipal',
                [
                    'sortBy' => 'id',
                    'descending' => false,
                ]);
        $municipalities = $response->collect('values');

        if ($response->failed() || ($municipalities->isEmpty())) {
            Log::channel(static::DATASET_LOG_CHANEL)->error('Не удалось получить список муниципалитетов', [
                'response_code' => $response->getStatusCode(),
                'response_body' => $response->body(),
            ]);
            return false;
        }
        $municipalities = $municipalities->map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
            ];
        });

        foreach ($municipalities as $municipality) {
            HumanitarianPointsWidgetMunicipality::query()->create($municipality);
        }
        return true;
    }

    public function updatePoints(string $token): bool
    {
        $page = 1;
        while (true) {
            $response = Http::withoutVerifying()
                ->withToken($token)
                ->acceptJson()
                ->get(config('services.humanitarian_points.base_url') . '/api/stock', [
                    'page' => $page,
                ]);
            $humanitarianPoints = $response->collect('data');

            if ($response->failed() || ($humanitarianPoints->isEmpty() && $page == 1)) {
                Log::channel(static::DATASET_LOG_CHANEL)->error('Не удалось получить список пунктов приёма', [
                    'response_code' => $response->getStatusCode(),
                    'response_body' => $response->body(),
                ]);
                return false;
            }

            if ($humanitarianPoints->isEmpty()) {
                break;
            }

            $humanitarianPoints = $humanitarianPoints->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'address' => !empty($item['address']) ? trim($item['address']) : null,
                    'contact_person_fio' => !empty($item['contactPersonFio']) ? trim($item['contactPersonFio']) : null,
                    'contact_person_email' => !empty($item['contactPersonEmail']) ? trim($item['contactPersonEmail']) : null,
                    'contact_person_phone' => !empty($item['contactPersonPhone']) ? trim($item['contactPersonPhone']) : null,
                    'municipality_id' => $item['municipalAreaId'],
                ];
            });

            foreach ($humanitarianPoints as $humanitarianPoint) {
                HumanitarianPointsWidgetHumanitarianPoint::query()->create($humanitarianPoint);
            }
            $page++;
        }
        return true;
    }


}
