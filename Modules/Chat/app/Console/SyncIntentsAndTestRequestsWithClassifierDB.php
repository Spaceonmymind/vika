<?php

namespace Modules\Chat\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Context;
use Modules\Chat\Models\ChatIntent;
use Modules\Chat\Models\ChatIntentTestRequest;
use Modules\Chat\Models\ChatVikaType;
use Modules\Chat\Services\TolyaClassifierService;
use Symfony\Component\Console\Helper\ProgressBar;

class SyncIntentsAndTestRequestsWithClassifierDB extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'chat-intents:sync-with-classifier-db {mode?}';

    /**
     * The console command description.
     */
    protected $description = 'Выполняет синхронизацию интентов и тестовых запросов с базой данных классификатора.
     Внутренние типы Вики всегда имеют больший приоритет. Внешние тестовые запросы всегда имеют больший приоритет.
     Интенты зависят от режима. ';

    private TolyaClassifierService $classifierService;
    private ProgressBar $vikaProgressBar;
    private ProgressBar $intentsProgressBar;
    private ProgressBar $testRequestsProgressBar;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->classifierService = new TolyaClassifierService();

    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Context::add('module', 'Admin');
        $data = $this->classifierService->getAllIntentsData();

        if (!isset($data)) {
            $this->error('Не удалось подключиться к api классификатора');
            return self::FAILURE;
        }
        $mode = $this->argument('mode');
        if (!in_array($mode, ['import', 'export', 'sync'])) {
            $mode = $this->choice(
                'Введите режим работы (import|export|sync)',
                [
                    'import' => 'Интенты будут импортированы из классификатора, если интента нет в классификаторе, он будет удален из базы приложения',
                    'export' => 'Интенты будут синхронизированы с классификатором: Интенты, которые есть в классификаторе будут импортиврованы в базу приложения. Интенты, которые есть в базе приложения, но нет в классификаторе будут добавлены в классификатор.',
                    'sync' => 'Интенты будут синхронизированы с классификатором(default)',
                ],
                'sync',
            );
        }


        switch ($mode) {
            case 'import':
                $this->import($data);
                break;
            case 'export':
                $this->export($data);
                break;
            case 'sync':
                $this->sync($data);
                break;
            default:
                return self::FAILURE;
        }
        return self::SUCCESS;
    }

    /**
     *
     * Выполняет импорт интентов из классификатора.
     * Интенты будут импортированы из классификатора, если интента нет в классификаторе, он будет удален из базы приложения
     * @param Collection $data
     * @return void
     */
    private function import(Collection $data)
    {
        $this->exportVikaTypes(collect($data['categories']));

        $this->info('Прогресс синхронизации интентов:');
        $this->intentsProgressBar = $this->output->createProgressBar(count($data['intents']));

        $intentsByCode = ChatIntent::query()->with(['active_vika_types'])->get()->keyBy('code');
        $notInsertedIntents = ChatIntent::query()->whereNull('external_id')->get()->keyBy('code');
        foreach ($data['intents'] as $intent) {

            if (isset($notInsertedIntents[$intent['code']])) {

                $intentsByCode[$intent['code']]->update([
                    'external_id' => $intent['id'],
                ]);

                unset($notInsertedIntents[$intent['code']]);
            }

            if (!isset($intentsByCode[$intent['code']])) {
                $intentsByCode[$intent['code']] = ChatIntent::query()->create([
                    'name' => $intent['name'],
                    'code' => $intent['code'],
                    'active' => $intent['is_active'],
                    'external_id' => $intent['id'],
                ]);
                $this->intentsProgressBar->advance();
                continue;
            }

            $this->syncExternalIntentWithInternal($intentsByCode[$intent['code']]);

            $this->intentsProgressBar->advance();
        }

        $this->intentsProgressBar->finish();
        $this->newLine();

        if ($notInsertedIntents->isNotEmpty()) {
            ChatIntent::query()->whereIn('id', $notInsertedIntents->pluck('id'))->delete();
        }

        $intentsByExternalId = ChatIntent::query()->get()->keyBy('external_id');
        $this->syncTestRequests($data['test_requests'], $intentsByExternalId);

    }

    /**
     * Экспортирует типы Вики, которые есть в базе приложения, но отсутствуют в классификаторе
     * @param Collection $externalVikaTypes
     * @return void
     */
    private function exportVikaTypes(Collection $externalVikaTypes)
    {
        $this->info('Прогресс синхронизации типов Вики:');
        $this->vikaProgressBar = $this->output->createProgressBar($externalVikaTypes->count());
        $this->newLine();

        $vikaTypesByCode = [];
        $vikaTypes = ChatVikaType::query()
            ->get();

        foreach ($vikaTypes as $vikaType) {
            $vikaTypesByCode[$vikaType->name] = $vikaType->id;
        }

        $vikaTypesNotAddedToClassifier = ChatVikaType::query()
            ->with([
                'chat_answers' => function (Builder $q) {
                    $q->where('is_active', true);
                },
                'chat_answers.chat_intent',
            ])
            ->whereNotIn('name', $externalVikaTypes->pluck('code'))
            ->get();

        foreach ($vikaTypesNotAddedToClassifier as $vikaType) {

            $this->classifierService->createVikaType($vikaType->description, $vikaType->name);

        }

        foreach ($externalVikaTypes as $vikaType) {
            if (!isset($vikaTypesByCode[$vikaType['code']])) {

               $this->classifierService->deleteVikaType($vikaType['code']);

            }
            $this->vikaProgressBar->advance();

        }
        $this->vikaProgressBar->finish();
        $this->newLine();

    }

    /**
     * Синхронизирует внешний интент с внутренним интентом
     * @param ChatIntent $intent
     * @return void
     */
    private function syncExternalIntentWithInternal(ChatIntent $intent)
    {

        $attributes = $intent->toArray();
        $attributes['vika_types'] = $intent->active_vika_types->pluck('name')->toArray();

        $this->classifierService->updateIntent($intent->external_id, $attributes);
    }

    /**
     * Синхронизирует тестовые запросы
     * @param array $testRequests
     * @param Collection $intentsByExternalId
     * @return void
     */
    private function syncTestRequests(array $testRequests, Collection $intentsByExternalId)
    {
        $this->info('Прогресс синхронизации Тестовых запросов:');
        $this->testRequestsProgressBar = $this->output->createProgressBar(count($testRequests));
        $externalIds = [];
        foreach ($testRequests as $testRequest) {
            $externalIds[] = $testRequest['id'];

            ChatIntentTestRequest::query()
                ->where('external_id', $testRequest['id'])
                ->where('intent_id', '!=', $intentsByExternalId[$testRequest['intent_id']]->id)
                ->delete();

            ChatIntentTestRequest::query()->updateOrCreate([
                'external_id' => $testRequest['id'],
                'intent_id' => $intentsByExternalId[$testRequest['intent_id']]->id,
            ], ['text' => $testRequest['name']]);


            $this->testRequestsProgressBar->advance();
        }

        ChatIntentTestRequest::query()->whereNotIn('external_id', $externalIds)->delete();

        $this->testRequestsProgressBar->finish();
        $this->newLine();

    }

    /**
     *  Выполняет экспорт интентов в классификатор.
     *  Интенты будут экспортированы в классификатор, если интента нет в базе приложения, он будет удален из классификатора
     * @param Collection $data
     * @return void
     */
    private function export(Collection $data)
    {
        $this->exportVikaTypes(collect($data['categories']));
        $this->info('Прогресс синхронизации интентов:');
        $this->intentsProgressBar = $this->output->createProgressBar(count($data['intents']));

        $intentsByCode = ChatIntent::query()->with(['chat_answers.vika_type'])->get()->keyBy('code');
        $notInsertedIntents = ChatIntent::query()->whereNull('external_id')->get()->keyBy('code');
        foreach ($data['intents'] as $intent) {

            if (isset($notInsertedIntents[$intent['code']])) {

                $intentsByCode[$intent['code']]->update([
                    'external_id' => $intent['id'],
                ]);

                unset($notInsertedIntents[$intent['code']]);
            }

            if (!isset($intentsByCode[$intent['code']])) {
                $this->classifierService->deleteIntent($intent['id']);
                $this->intentsProgressBar->advance();
                continue;
            }

            $this->syncExternalIntentWithInternal($intentsByCode[$intent['code']]);

            $this->intentsProgressBar->advance();
        }
        $this->intentsProgressBar->finish();
        $this->newLine();

        if ($notInsertedIntents->isNotEmpty()) {
            $this->exportNotInsertedIntents($notInsertedIntents);
        } else {
            $this->info('Не отправленных в api интентов не найдено');
        }

        $intentsByExternalId = ChatIntent::query()->get()->keyBy('external_id');
        $this->syncTestRequests($data['test_requests'], $intentsByExternalId);

    }

    /**
     * Экспортирует интенты, которые не были ранее отправлены в api классификатора
     * @param Collection $notInsertedIntents
     * @return void
     */
    private function exportNotInsertedIntents(Collection $notInsertedIntents): void
    {
        $this->info('Прогресс синхронизации интентов, которые не были отправлены в api классификатора:');
        $notInsertedIntentsProgressBar = $this->output->createProgressBar($notInsertedIntents->count());
        foreach ($notInsertedIntents as $intent) {
            $attributes = $intent->toArray();
            $attributes['vika_types'] = $intent->active_vika_types->pluck('name');
            $externalIntent = $this->classifierService->createIntent($attributes);
            $intent->update([
                'external_id' => $externalIntent['id'],
            ]);
            $notInsertedIntentsProgressBar->advance();
        }
        $notInsertedIntentsProgressBar->finish();
    }

    /**
     * Выполняет синхронизацию интентов с классификатором.
     * Интенты будут синхронизированы с классификатором: Интенты, которые есть в классификаторе будут импортиврованы в базу приложения. Интенты, которые есть в базе приложения, но нет в классификаторе будут добавлены в классификатор.
     * @param Collection $data
     * @return void
     */
    private function sync(Collection $data)
    {
        $this->exportVikaTypes(collect($data['categories']));

        $this->info('Прогресс синхронизации интентов:');
        $this->intentsProgressBar = $this->output->createProgressBar(count($data['intents']));

        $intentsByCode = ChatIntent::query()->with(['chat_answers.vika_type'])->get()->keyBy('code');
        $notInsertedIntents = ChatIntent::query()->whereNull('external_id')->get()->keyBy('code');

        foreach ($data['intents'] as $intent) {

            if (isset($notInsertedIntents[$intent['code']])) {

                $intentsByCode[$intent['code']]->update([
                    'external_id' => $intent['id'],
                ]);

                unset($notInsertedIntents[$intent['code']]);
            }

            if (!isset($intentsByCode[$intent['code']])) {
                $intentsByCode[$intent['code']] = ChatIntent::query()->create([
                    'name' => $intent['name'],
                    'code' => $intent['code'],
                    'active' => $intent['is_active'],
                    'external_id' => $intent['id'],
                ]);
                continue;
            }

            $this->syncExternalIntentWithInternal($intentsByCode[$intent['code']]);

            $this->intentsProgressBar->advance();
        }
        $this->intentsProgressBar->finish();
        $this->newLine();

        if ($notInsertedIntents->isNotEmpty()) {
            $this->exportNotInsertedIntents($notInsertedIntents);
        } else {
            $this->info('Не отправленных в api интентов не найдено');
        }

        $intentsByExternalId = ChatIntent::query()->get()->keyBy('external_id');
        $this->syncTestRequests($data['test_requests'], $intentsByExternalId);

    }
}
