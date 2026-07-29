<?php

namespace Modules\RegionHeadHotlineWidget\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Chat\Services\Max\MaxService;
use Modules\RegionHeadHotlineWidget\Models\RegionHeadHotlineWidgetAppeal;
use Modules\RegionHeadHotlineWidget\Models\RegionHeadHotlineWidgetBadWord;
use Modules\RegionHeadHotlineWidget\Models\RegionHeadHotlineWidgetMaxContact;

class RegionHeadHotlineService
{

    /**
     * Сохранение контакта пользователя из Max
     * @param $webAppData
     * @param $phone
     * @return array
     */
    public function saveMaxContact($webAppData, $phone)
    {
        $phone = $this->validatePhone($phone);
        if (
            RegionHeadHotlineWidgetMaxContact::query()
                ->where('user_id', $webAppData['user']['id'])
                ->where('active', true)
                ->exists()
        ) {
            return [
                'success' => false,
                'error' => 'Контакт уже сохранён',
            ];
        }
        RegionHeadHotlineWidgetMaxContact::query()->updateOrcreate([
            'user_id' => $webAppData['user']['id'],
        ],[
            'last_name' => $webAppData['user']['last_name'] ?? null,
            'first_name' => $webAppData['user']['first_name'] ?? null,
            'phone' => $phone,
            'active' => true,
        ]);

        return ['success' => true];
    }

    /**
     * Валидация номера телефона
     * @param $phone
     * @return string|string[]|null
     */
    private function validatePhone($phone)
    {
        $phone = Str::replaceMatches('/\D/', '', $phone);
        if (Str::startsWith($phone, '8')) {
            $phone = Str::replaceFirst('8', '7', $phone);
        }
        if (strlen($phone) === 10) {
            $phone = '7' . $phone;
        }
        return $phone;
    }

    /**
     * Проверка, сохранён ли контакт пользователя из Max
     * @param array $webAppData
     * @return array
     */
    public function isUserSavedContact(array $webAppData)
    {
        return [
            'has_contact' => RegionHeadHotlineWidgetMaxContact::query()
                ->where('user_id', $webAppData['user']['id'])
                ->where('active', true)
                ->exists(),
        ];
    }

    /**
     * Создание обращения
     * @param array $appealData
     * @param array $webAppData
     * @return array|mixed|true[]
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function createAppeal(array $appealData, array $webAppData)
    {
        $personPhone = $this->findPeopleByMax($webAppData['user']['id'])['phone'] ?? null;

        if (!isset($personPhone)) {
            return [
                'success' => false,
                'error' => 'Контакт не найден, пожалуйста, сохраните контакт',
            ];
        }

        $appealData['phone'] = $personPhone;

        $badWords = $this->getAppealBadWords($appealData['complaint'] ?? '');
        if (count($badWords) > 0) {
            return [
                'success' => false,
                'error' => 'В обращении обнаружены нецензурные выражения: ' . implode(', ', $badWords),
            ];
        }
        $vilarResponse = $this->sendComplaintToVilar($appealData);
        if (!$vilarResponse['success']) {
            return $vilarResponse;
        }
        $appealNumber=RegionHeadHotlineWidgetAppeal::query()->where('max_user_id',$webAppData['user']['id'])->count()+1;

        $appeal = RegionHeadHotlineWidgetAppeal::query()->create([
            'max_user_id' => $webAppData['user']['id'],
            'external_id' => $vilarResponse['record_id'],
            'appeal_number' => $appealNumber
        ]);

        defer(function () use ($appeal) {
            $max = new MaxService();
            $max->sendMessage(null, [
                'text' => "Ваше обращение принято.\nНомер обращения: <b>$appeal->appeal_number</b>\nПожалуйста, не отключайте бота, <u>ответ поступит в этот чат во время или после Прямой линии Губернатора Югры.</u>",
                'format' => 'html',
            ], $appeal->max_user_id);
        });

        return ['success' => true];
    }

    /**
     * Поиск номера телефона пользователя по контакту из макса
     * @param string $maxUserId
     * @return array
     */
    public function findPeopleByMax(string $maxUserId)
    {
        $maxContact = RegionHeadHotlineWidgetMaxContact::query()->where('user_id', $maxUserId)->where('active',true)->first();

        if (!isset($maxContact)) {
            return [
                'success' => false,
                'error' => 'Контакт не найден, пожалуйста, сохраните контакт',
            ];
        }

        return [
            'success' => true,
            'phone' => $maxContact->phone,
        ];
    }

    /**
     * Поиск плохих слов в тексте обращения
     * @param $appealText
     * @return array
     */
    public function getAppealBadWords($appealText)
    {
        // Добавляем пробелы и буквы в начале и конце, чтобы корректно находить слова в начале и конце текста, так как битриксовые паттерны отвратительно работают если мат в начале или конце строки
        $appealText = 'а ' . $appealText . ' а';

        $badWords = RegionHeadHotlineWidgetBadWord::query()->pluck('pattern')->toArray();
        $foundBadWords = [];
        foreach ($badWords as $pattern) {
            if ($badWord = Str::match($pattern, $appealText)) {
                $foundBadWords[] = $badWord;
            }

        }

        return $foundBadWords;
    }

    /**
     * Отправка обращения в Вилар
     * @param array $appealData
     * @return array|mixed
     */
    private function sendComplaintToVilar(array $appealData)
    {
        try {
            $response = Http::withoutVerifying()
                ->acceptJson()
                ->withHeader('X-VI-Access-Token', config('services.vilar.token'))
                ->post(config('services.vilar.base_url') . '/api/external/region_head_hotline/receive', $appealData);
        } catch (\Throwable $e) {

            Log::channel('vilar')->error('Ошибка отправки обращения в вилар', ['error' => $e->getMessage(), 'appealData' => $appealData]);

            return [
                'success' => false,
                'error' => 'Сервер временно недоступен, попробуйте позже',
            ];
        }
        if ($response->failed()) {
            Log::channel('vilar')->error('Ошибка отправки обращения в вилар', [
                'status' => $response->status(),
                'body' => $response->body(),
                'appealData' => $appealData,
            ]);

            return [
                'success' => false,
                'error' => 'Ошибка при отправке обращения, попробуйте позже',
            ];

        }
        return $response->json();
    }

    /**
     * Отправка результата по обращению пользователю в Макс
     * @param int $appealId
     * @param string $resultText
     * @return array
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function sendAppealResult(int $appealId, string $resultText)
    {
        $appeal = RegionHeadHotlineWidgetAppeal::query()->where('external_id', $appealId)->first();
        $contact = RegionHeadHotlineWidgetMaxContact::query()->where('user_id', $appeal->max_user_id)->where('active',true)->first();

        if (!isset($appeal) || !isset($contact)) {
            Log::warning('Не удалось отправить ответ по обращению, не найдено обращение или контакт', [
                'appeal_id' => $appealId,
            ]);
            return ['success' => false, 'error' => 'Не найдено обращение или контакт'];
        }

        $max = new MaxService();
        $max->sendMessage(null, [
            'text' => "Поступил ответ на обращение № <b>$appeal->appeal_number</b>:\n\n" . $resultText,
            'format' => 'html',
        ], $appeal->max_user_id);

        return ['success' => true];
    }
}
