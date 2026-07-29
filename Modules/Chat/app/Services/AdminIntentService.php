<?php

namespace Modules\Chat\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Chat\Models\ChatIntent;
use Modules\Chat\Models\ChatIntentTestRequest;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\TestMessage;

class AdminIntentService
{
    private TolyaClassifierService $tolyaClassifierService;

    public function __construct(TolyaClassifierService $tolyaClassifierService)
    {
        $this->tolyaClassifierService = $tolyaClassifierService;
    }

    /**
     * Список интентов
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator|Collection
     */
    public function getIntents(array $filters = [])
    {
        $query = ChatIntent::query()
            ->select([
                'id',
                'code',
                'name',
                'active',
                'handler_id',
            ])
            ->with([
                'handler:id,code,name',
            ])
            ->when(isset($filters['active']), function (Builder $q) use ($filters) {
                $q->where('active', $filters['active']);
            })
            ->when(isset($filters['name']), function (Builder $q) use ($filters) {
                $q->where(function (Builder $q) use ($filters) {
                    $q
                        ->where('name', 'like', '%' . $filters['name'] . '%')
                        ->orWhere('code', 'like', '%' . $filters['name'] . '%');
                });
            })
            ->when(isset($filters['exclude_vika_type_id']), function (Builder $q) use ($filters) {
                $q->whereDoesntHave('chat_answers', function (Builder $q) use ($filters) {
                    $q->where('vika_type_id', $filters['exclude_vika_type_id']);
                });
            });

        if ($filters['need_pagination'] ?? false) {
            return $query->paginate($filters['per_page'] ?? 15);
        }

        return $query->get();

    }

    /**
     * Создание интента
     * @param array $intentAttributes
     * @return array
     */
    public function createIntent(array $intentAttributes)
    {
        $externalIntent = $this->tolyaClassifierService->createIntent($intentAttributes);
        if (!isset($externalIntent['id'])) {
            return [
                'success' => false,
                'error' => 'Не удалось установить соединение с нейросетью',
            ];
        }

        $intentAttributes['external_id'] = $externalIntent['id'];
        ChatIntent::query()->create($intentAttributes);


        return ['success' => true];
    }

    /**
     * Изменение интента
     * @param ChatIntent $chatIntent
     * @param array $intentAttributes
     * @return array
     */
    public function updateIntent(ChatIntent $chatIntent, array $intentAttributes)
    {
        if (in_array($chatIntent->code, ['input.unknown', 'welcome'])) {
            return [
                'success' => false,
                'error' => 'Нельзя изменять Default Fallback Intent и Default Welcome Intent',
            ];
        }

        $successSendInformationToAI = $this->tolyaClassifierService->updateIntent($chatIntent->external_id, $intentAttributes);

        if (!$successSendInformationToAI) {
            return [
                'success' => false,
                'error' => 'Не удалось отправить информацию в ИИ. Интент остался неизменным',
            ];
        }
        $chatIntent->update($intentAttributes);
        return ['success' => true];
    }

    /**
     * Удаление интента
     * @param ChatIntent $chatIntent
     * @return array
     */
    public function deleteIntent(ChatIntent $chatIntent)
    {
        if (in_array($chatIntent->code, ['input.unknown', 'welcome'])) {
            return [
                'success' => false,
                'error' => 'Нельзя удалять Default Fallback Intent и Default Welcome Intent',
            ];
        }
        $successSendInformationToAI = $this->tolyaClassifierService->deleteIntent($chatIntent->external_id);
        if (!$successSendInformationToAI) {
            return [
                'success' => false,
                'error' => 'Не удалось отправить информацию в ИИ. Интент остался неизменным',
            ];
        }
        $chatIntent->delete();
        return ['success' => true];
    }

    /**
     * Деталка интента
     * @param ChatIntent $chatIntent
     * @return ChatIntent
     */
    public function getIntent(ChatIntent $chatIntent)
    {
        return $chatIntent->load(['test_requests','handler']);
    }

    /**
     * Можно ли добавить тестовый запрос
     * @param ChatIntent $chatIntent
     * @param string $text
     * @return array
     */
    public function canAddTestRequest(ChatIntent $chatIntent, string $text)
    {
        return $this->tolyaClassifierService->canAddTestRequest($chatIntent->external_id, $text);
    }


    /**
     * Добавить тестовый запрос к интенту
     * @param ChatIntent $chatIntent
     * @param string $text
     * @return array
     */
    public function addTestRequest(ChatIntent $chatIntent, string $text)
    {
        $externalTestRequest = $this->tolyaClassifierService->createTestRequest($chatIntent->external_id, $text);

        if (!isset($externalTestRequest['id'])) {
            return [
                'success' => false,
                'error' => 'Не удалось отправить информацию в ИИ. Пример ответа не был создан',
            ];
        }

        $chatIntent->test_requests()->create([
            'text' => $text,
            'external_id' => $externalTestRequest['id'],

        ]);

        return ['success' => true];
    }

    /**
     * Удалить тестовый запрос
     * @param ChatIntentTestRequest $chatIntentTestRequest
     * @return array
     */
    public function deleteTestRequest(ChatIntentTestRequest $chatIntentTestRequest)
    {
        $successSendInformationToAI = $this->tolyaClassifierService->deleteTestRequest($chatIntentTestRequest->external_id);

        if (!$successSendInformationToAI) {
            return [
                'success' => false,
                'error' => 'Не удалось отправить информацию в ИИ. Пример ответа не удалось удалить',
            ];
        }

        $chatIntentTestRequest->delete();


        return ['success' => true];

    }

    public function getRecommendedTestRequests(ChatIntent $chatIntent)
    {
        return $this->tolyaClassifierService->getRecommendedTestRequests($chatIntent->external_id);
    }

    public function getPlot(bool $forceUpdate = false)
    {
        $fallbackResponse = [
            'success' => false,
            'error' => 'Не удалось получить график, пожалуйста, попробуйте позже',
            'plot' => '<div>Не удалось получить график, пожалуйста, попробуйте позже</div>',
            'last_updated_at' => now()->format('d.m.Y H:i:s'),
        ];

        if ($forceUpdate) {
            $plot = $this->tolyaClassifierService->getPlotHtml();
            if ($plot === '') {
                return $fallbackResponse;
            }

            Cache::put('chat_admin:intent_plot', $result = ['last_updated_at' => now()->format('d.m.Y H:i:s'), 'plot' => $plot], 2 * 60 * 60);

            //Данный ключ нужен, чтобы корректно отрабатывал гибкий(Stale While Revalidate) кеш
            Cache::put('illuminate:cache:flexible:created:chat_admin:intent_plot', time(), 2 * 60 * 60);

            $result['success'] = true;
            return $result;
        }

        $result = Cache::flexible('chat_admin:intent_plot', [60 * 60, 2 * 60 * 60], function () {
            return [
                'last_updated_at' => now()->format('d.m.Y H:i:s'),
                'plot' => $this->tolyaClassifierService->getPlotHtml(),
            ];

        });

        if ($result['plot'] === '') {
            Cache::forget('chat_admin:intent_plot');

            return $fallbackResponse;
        }
        $result['success'] = true;
        return $result;
    }

    public function testMessage(string $message, $vikaTypeCode = 'main')
    {
        $response = $this->tolyaClassifierService->testMessage($message, $vikaTypeCode);
        if($response === []) {
            return [
                'success' => false,
                'error' => 'Не удалось получить ответ от ИИ',
                'response'=>[]
            ];
        }

        $response['chat_intent'] = ChatIntent::query()->where('code', $response['intent']??null)
            ->select(['id', 'code', 'name'])
            ->first();

        return [
            'success' => true,
            'response' => $response,
        ];
    }
    public function testLLMPrompt(string $message,string $systemPrompt,string $document): array
    {
        return $this->tolyaClassifierService->getResponseMessageFromLLMByDocumentAndPrompt($document, $systemPrompt, $message);
    }
}
