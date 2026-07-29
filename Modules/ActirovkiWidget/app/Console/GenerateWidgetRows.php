<?php

namespace Modules\ActirovkiWidget\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\ActirovkiWidget\Database\Factories\RowFactory;
use Modules\ActirovkiWidget\Database\Factories\WeatherFactory;

class GenerateWidgetRows extends Command
{
    protected $signature = 'generate:fake-actirovki
                            {count=1000000 : Число генерируемых записей}
                            {batch=1000    : Количество записей за один проход}';

    protected $description = 'Генерирует тестовые записи для актировок';

    public function handle(): void
    {
        if (app()->environment('production')) {
            $this->error(' Дурак штоле? В проде это делать не стоит');
            return;
        }

        $total = (int)$this->argument('count');
        $batchSize = (int)$this->argument('batch');

        $this->info("Отключаем foreign keys и индексы…");

        Schema::disableForeignKeyConstraints();
        $dbConn = DB::connection();
        $dbConn->disableQueryLog();
        $dbConn->unsetEventDispatcher();

        if (app()->environment('local') && class_exists(\Laravel\Telescope\Telescope::class)) {
            $this->info("Отключаем Telescope");
            \Laravel\Telescope\Telescope::stopRecording();
        }

        $weatherFactory = WeatherFactory::new();
        $rowFactory = RowFactory::new();

        $bar = $this->output->createProgressBar($total);

        for ($i = 0; $i < $total; $i += $batchSize) {
            $need = min($batchSize, $total - $i);

            // Данные о погоде
            $weatherRows = $weatherFactory
                ->count($need)
                ->raw();

            DB::table('vika.actirovki_widget_weathers')->insert($weatherRows);

            // Парадокс: lastInsertId() вернёт id ПЕРВОЙ вставленной строки,
            // при пакетной вставке lastInsertId() возвращает ID первой вставленной строки, а не последней
            $pdo = DB::getPdo();
            $firstWeatherId = (int)$pdo->lastInsertId();

            $rows = $rowFactory
                ->count($need)
                ->raw();

            foreach ($rows as $k => &$row) {
                $row['weather_id'] = $firstWeatherId + $k;
                $row['city_id'] = $weatherRows[$k]['city_id'];
            }
            unset($row);

            DB::table('vika.actirovki_widget_rows')->insert($rows);

            unset($weatherRows, $rows);
            gc_collect_cycles();

            $bar->advance($need);
        }

        $bar->finish();
        $this->line("\nВосстанавливаем индексы и FK…");
        Schema::enableForeignKeyConstraints();

        $this->info("Генерация {$total} строк завершена");
    }
}
