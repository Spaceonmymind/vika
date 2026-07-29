<?php

namespace Modules\DoctorTmkWidget\Services;

use Illuminate\Support\Facades\Log;
use Modules\AppointmentToDoctorWidget\Models\AppointmentToDoctorMaxContact;
use Modules\Chat\Models\ChatMaxMessage;
use Modules\Chat\Models\ChatMaxWebAppUrl;
use Modules\Chat\Models\ChatWidget;
use Modules\Chat\Services\Max\MaxMessageBuilder;
use Modules\Chat\Services\Max\MaxService;

class DoctorTmkWidgetService
{

    public function sendTmkNotification(string $phone, string $resultText)
    {

        $contact = AppointmentToDoctorMaxContact::query()->where('phone', '7' . $phone)->first();

        if (!isset($contact)) {
            Log::warning('Не удалось отправить уведомление о консультации', [
                'phone' => $phone,
            ]);
            return ['success' => false, 'error' => 'Не найдено обращение или контакт'];
        }

        $max = new MaxService();
        $message=new MaxMessageBuilder();

        $message->setText($resultText);

        $widget = ChatWidget::query()->where('code_name', 'vi-doctor-tmk')->first();

        $webAppUrl = ChatMaxWebAppUrl::query()
            ->create([
                'widget_id' => $widget->id,
                'params' => [
                    'chat_id' => ChatMaxMessage::query()->where('user_id', $contact->user_id)->latest('id')->first()->chat_id,
                    'from_max' => true,
                ],
            ]);

        $message->addWebAppButton('Посмотреть активные записи на ТМК',$webAppUrl->guid);

        $max->sendMessage(null, $message->get(), (int)$contact->user_id);

        return ['success' => true];
    }

}
