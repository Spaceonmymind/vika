<?php

namespace Modules\Chat\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\Chat\Models\ChatIntentTestRequest;

class TolyaClassifierService
{
    private const CAN_ADD_TEST_REQUEST_MESSAGES = [
        'dublicate_sample' => 'Данный пример уже добавлен в текущий интент',
        'nearest_other_intent_sample' => 'Новый пример близок к примеру из другого интента',
        'nothing_change_intent' => 'Введенный пример не изменяет интент',
        'nearest_other_intent' => 'Введенный пример близок к другому интенту',
    ];

    /**
     * Выполняет запрос к внешнему сервису определителю интентов и возвращает ответ
     * @param string $message
     * @param string $vikaType
     * @return array
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function getIntentWithEntities(string $message, string $vikaType = 'main'): array
    {
        return  $this->post(
            '/api/intent/classify',
            [
                'text' => $message,
                'vika_type' => $vikaType,
            ],
        )?->json() ??
            [
                'intent' => 'input.unknown',
                'entities' => [],
            ];
    }

    /**
     * Отправляет пост запрос к классификатору
     * @param string $uri
     * @param array $data
     * @param array $urlParams
     * @return Response|null
     */
    private function post(string $uri, array $data = [], array $urlParams = []): Response|null
    {

        return $this->sendRequest('post', $uri, $data, $urlParams);
    }

    /**
     * Отправляет запрос к классификатору
     * @param string $method
     * @param string $uri
     * @param array $data
     * @param array $urlParams
     * @return Response|null
     */
    private function sendRequest(string $method, string $uri, array $data, array $urlParams): Response|null
    {
        $response = null;
        try {
            /**
             * @var Response|null $response
             */
            $response = Http::withoutVerifying()
                ->withUrlParameters($urlParams)
                ->$method(
                    config('services.intent_qualifiers.tolya.base_url') . $uri,
                    $data,
                );
        } catch (\Throwable $e) {
            Log::channel('tolya_classifier_api')->error('Не удалось отправить запрос в api определителя интентов', [
                'method' => $method,
                'url' => $uri,
                'params' => json_encode($urlParams, JSON_UNESCAPED_UNICODE),
                'body' => json_encode($data, JSON_UNESCAPED_UNICODE),
                'error' => $e->getMessage(),
            ]);

            return null;
        }


        if ($response->failed()) {
            Log::channel('tolya_classifier_api')->error('Не удалось отправить запрос в api определителя интентов', [
                'method' => $method,
                'url' => $uri,
                'params' => json_encode($urlParams, JSON_UNESCAPED_UNICODE),
                'body' => json_encode($data, JSON_UNESCAPED_UNICODE),
                'status_code' => $response->status(),
                'response_body' => $response->body(),
            ]);

            return null;
        }

        return $response;
    }

    /**
     * Привязывает тип Вики к интенту
     * @param int $intentExternalId
     * @param string $vikaTypeCode
     * @return bool
     */
    public function addVikaTypeToIntent(int $intentExternalId, string $vikaTypeCode): bool
    {
        $response = $this->post('/api/assign', ['intent_id' => $intentExternalId, 'category_code' => $vikaTypeCode], []);

        return isset($response);
    }

    /**
     * Отвязывает интент от типа Вики
     * @param int|null $intentExternalId
     * @param string $vikaTypeCode
     * @return bool
     */
    public function removeVikaTypeFromIntent(?int $intentExternalId, string $vikaTypeCode): bool
    {
        $response = $this->delete('/api/assign', ['intent_id' => $intentExternalId, 'category_code' => $vikaTypeCode], []);

        return isset($response);
    }

    /**
     * Отправляет delete запрос к классификатору
     * @param string $uri
     * @param array $data
     * @param array $urlParams
     * @return Response|null
     */
    private function delete(string $uri, array $data = [], array $urlParams = []): Response|null
    {
        return $this->sendRequest('delete', $uri, $data, $urlParams);
    }

    /**
     * Создает интент в классификаторе
     * @param array $intentAttributes
     * @return array|null
     */
    public function createIntent(array $intentAttributes): ?array
    {
        $response = $this->post('/api/intent', [
            'name' => $intentAttributes['name'],
            'code' => $intentAttributes['code'],
            'is_active' => $intentAttributes['active'],
            'categories' => [],
        ], []);

        return $response?->json();
    }

    /**
     * Обновляет интент в классификаторе
     * @param int $intentExternalId
     * @param array $intentAttributes
     * @return bool
     */
    public function updateIntent(int $intentExternalId, array $intentAttributes): bool
    {
        $classifierAttributes = [
            'name' => $intentAttributes['name'],
            //'code' => $intentAttributes['code'],
            'is_active' => $intentAttributes['active'],
        ];
        if (isset($intentAttributes['vika_types'])) {
            $classifierAttributes['categories'] = $intentAttributes['vika_types'];
        }
        $response = $this->post('/api/intent/{intentId}', $classifierAttributes, [
            'intentId' => $intentExternalId,
        ]);

        return isset($response);
    }

    /**
     * Удаляет интент в классификаторе
     * @param int $intentExternalId
     * @return bool
     */
    public function deleteIntent(int $intentExternalId): bool
    {
        $response = $this->delete('/api/intent/{intentId}', urlParams: [
            'intentId' => $intentExternalId,
        ]);

        return isset($response);
    }

    /**
     * Запрашивает метрики по тестовому запросу у классификатора
     * @param int $intentExternalId
     * @param string $text
     * @return array
     */
    public function canAddTestRequest(int $intentExternalId, string $text): array
    {
        $response = $this->get('/api/metrics/metric_by_sample', [
            'text' => $text,
            'intent_id' => $intentExternalId,
        ]);
        if (!isset($response)) {
            return [
                'can_add' => null,
                'error' => 'Не удалось отправить запрос к api',
                'description' => 'Не удалось отправить запрос к api',
                'metrics' => [
                    'similarity' => 0.0,
                    'similar_test_request' => null,
                    'intent_density_prev' => 0.0,
                    'intent_density_new' => 0.0,
                    'distant_to_nearest_intent_prev' => 0.0,
                    'distant_to_nearest_intent_new' => 0.0,
                    'nearest_intent_sample' => null,
                ],
            ];
        }
        $description = [];
        $canAdd = true;
        foreach ($response->json('attentions') as $attentionType => $isFound) {

            if ($isFound && isset(self::CAN_ADD_TEST_REQUEST_MESSAGES[$attentionType])) {

                $description[] = self::CAN_ADD_TEST_REQUEST_MESSAGES[$attentionType];
                $canAdd = false;
            }

        }

        return [
            'can_add' => $canAdd,
            'description' => implode("\n", $description),
            'metrics' => [
                'similarity' => $response->json('similarity'),
                'similar_test_request' => ChatIntentTestRequest::query()
                    ->select(['id', 'text'])
                    ->where('external_id', $response->json('similarity_sample_id'))
                    ->first(),
                'intent_density_prev' => $response->json('intent_density_prev'),
                'intent_density_new' => $response->json('intent_density_new'),
                'distant_to_nearest_intent_prev' => $response->json('distant_to_nearest_intent_prev'),
                'distant_to_nearest_intent_new' => $response->json('distant_to_nearest_intent_new'),
                'nearest_intent_sample' => ChatIntentTestRequest::query()
                    ->select([
                        'id',
                        'text',
                        'intent_id',
                    ])
                    ->with(['chat_intent:id,name,code'])
                    ->where('external_id', $response->json('nearest_intent_sample_id'))
                    ->first(),
            ],
        ];
    }

    /**
     * Отправляет get запрос в классификатор
     * @param string $uri
     * @param array $data
     * @param array $urlParams
     * @return Response|null
     */
    private function get(string $uri, array $data = [], array $urlParams = []): Response|null
    {

        return $this->sendRequest('get', $uri, $data, $urlParams);
    }

    /**
     * Возвращает всю информацию об интентах, содержащуюся в классификаторе
     * @return Collection|null
     */
    public function getAllIntentsData(): ?Collection
    {
        return $this->get('/api/admin/get-db')?->collect();
    }

    /**
     * Добавляет пример вопроса в классификатор
     * @param int|null $intentExternalId
     * @param string $text
     * @return array|null
     */
    public function createTestRequest(?int $intentExternalId, string $text): ?array
    {
        $response = $this->post('/api/samples', [
            'name' => $text,
            'intent_id' => $intentExternalId,
        ]);

        return $response?->json();
    }

    /**
     * Удаляет пример вопроса из классификатора
     * @param int|null $testRequestExternalId
     * @return bool
     */
    public function deleteTestRequest(?int $testRequestExternalId): bool
    {
        $response = $this->delete('/api/samples/{sample_id}', urlParams: [
            'sample_id' => $testRequestExternalId,
        ]);
        return isset($response);
    }

    /**
     * Создаёт новый тип Вики в классификаторе
     * @param $name
     * @param $code
     * @return bool
     */
    public function createVikaType($name, $code)
    {
        $response = $this->post('/api/category', ['name' => $name, 'code' => $code]);

        return isset($response);
    }

    /**
     * Обновляет название типа Вики в классификаторе
     * @param $name
     * @param $vikaTypeCode
     * @return bool
     */
    public function updateVikaType($name, $vikaTypeCode)
    {
        $response = $this->post('/api/category/{code_name}', ['name' => $name], ['code_name' => $vikaTypeCode]);
        return isset($response);
    }

    /**
     * Удаляет тип Вики из классификатора
     * @param $vikaTypeCode
     * @return bool
     */
    public function deleteVikaType($vikaTypeCode)
    {
        $response = $this->delete('/api/category/{code_name}', urlParams: ['code_name' => $vikaTypeCode]);

        return isset($response);
    }

    /**
     * Возвращает список рекомендуемых примеров вопросов для конкретного интента
     * @param int $intentExternalId
     * @return array
     */
    public function getRecommendedTestRequests(int $intentExternalId): array
    {
        $response = $this->post('/api/helpers/generate_samples', ['intent_id' => $intentExternalId]);
        return $response?->json() ?? [];
    }

    /**
     * Возвращает html графика
     * @return string|null
     */
    public function getPlotHtml(): ?string
    {
        $response = $this->get('/api/metrics/plot-intents');

        return $response?->body() ?? '';
    }

    public function testMessage(string $message, string $vikaTypeCode): array
    {
        $response = $this->post('/api/intent/classify-debug', [
            'text' => $message,
            'vika_type' => $vikaTypeCode,
        ]);
        return $response?->json() ?? [];
    }

    public function getResponseMessageFromLLM(string $message, string $intent): array
    {

        $response = $this->post('/api/quickanswers/intent/{intent_code}', [
            'question_text' => $message,
        ], [
            'intent_code' => $intent,
        ])?->json();

        if (!isset($response['answer'])) {
            return [
                'answer' => 'Извините, кажется я вас не поняла...',
                'filters' => [],
            ];
        }
        return $response;
    }
    public function getResponseMessageFromLLMByDocumentAndPrompt(string $document, string $systemPrompt,string $message): array
    {

        $response = $this->post('/api/quickanswers/general-answer', [
            'context' => $document,
            'question' => $message,
            'system_prompt' => $systemPrompt,
        ])?->json();

        if (!isset($response['answer'])) {
            return [
                'answer' => 'Извините, кажется я вас не поняла...',
            ];
        }
        return $response;
    }

    /**
     * Отправляет put запрос к классификатору
     * @param string $uri
     * @param array $data
     * @param array $urlParams
     * @return Response|null
     */
    private function put(string $uri, array $data = [], array $urlParams = []): Response|null
    {

        return $this->sendRequest('put', $uri, $data, $urlParams);
    }
}
