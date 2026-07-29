<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;

class ChatAnswerButtonsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        if (\DB::table('chat_answer_buttons')->exists()) {
            return;
        }

        \DB::table('chat_answer_buttons')->insert(array(
            0 =>
                array(
                    'id' => 19,
                    'button_type_id' => 2,
                    'name' => 'Кнопка посмотреть цены газпром',
                    'answer_id' => 1,
                    'button_message_text' => 'Посмотреть цены на топливо на заправках "Газпром"',
                    'url' => 'https://www.gazprom.ru/',
                    'chat_widget_id' => NULL,
                    'created_at' => '2025-05-05 11:07:35',
                    'updated_at' => '2025-05-05 11:07:35',
                ),
            1 =>
                array(
                    'id' => 20,
                    'button_type_id' => 1,
                    'name' => 'Открыть виджет "Цены на топливо"',
                    'answer_id' => 1,
                    'button_message_text' => 'Открыть виджет "Цены на топливо"',
                    'url' => NULL,
                    'chat_widget_id' => 1,
                    'created_at' => '2025-05-05 11:07:35',
                    'updated_at' => '2025-05-05 11:07:35',
                ),
            2 =>
                array(
                    'id' => 24,
                    'button_type_id' => 2,
                    'name' => 'Оставить заявку на отлов животных',
                    'answer_id' => 6,
                    'button_message_text' => 'Оставить заявку на отлов животных',
                    'url' => 'https://animals.admhmao.ru/animals/catch-request-public',
                    'chat_widget_id' => NULL,
                    'created_at' => '2025-05-05 11:32:39',
                    'updated_at' => '2025-05-05 11:32:39',
                ),
            3 =>
                array(
                    'id' => 25,
                    'button_type_id' => 2,
                    'name' => 'Оставить объявление о пропаже\\находке животных',
                    'answer_id' => 9,
                    'button_message_text' => 'Оставить объявление о пропаже\\находке животных',
                    'url' => 'https://animals.admhmao.ru/animals/advertisement-public',
                    'chat_widget_id' => NULL,
                    'created_at' => '2025-05-05 11:35:14',
                    'updated_at' => '2025-05-05 11:35:14',
                ),
            4 =>
                array(
                    'id' => 26,
                    'button_type_id' => 2,
                    'name' => 'Карта безопасности',
                    'answer_id' => 7,
                    'button_message_text' => 'Карта безопасности',
                    'url' => 'https://animals.admhmao.ru/animals/map-safety',
                    'chat_widget_id' => NULL,
                    'created_at' => '2025-05-05 11:36:56',
                    'updated_at' => '2025-05-05 11:36:56',
                ),
            5 =>
                array(
                    'id' => 27,
                    'button_type_id' => 2,
                    'name' => 'Мы ищем дом',
                    'answer_id' => 8,
                    'button_message_text' => 'Мы ищем дом',
                    'url' => 'https://animals.admhmao.ru/animals/find-home',
                    'chat_widget_id' => NULL,
                    'created_at' => '2025-05-05 11:38:10',
                    'updated_at' => '2025-05-05 11:38:10',
                ),
            6 =>
                array(
                    'id' => 31,
                    'button_type_id' => 2,
                    'name' => 'Товары и услуги для животных',
                    'answer_id' => 5,
                    'button_message_text' => 'Товары и услуги для животных',
                    'url' => 'https://animals.admhmao.ru/animals/product-public',
                    'chat_widget_id' => NULL,
                    'created_at' => '2025-05-05 11:52:47',
                    'updated_at' => '2025-05-05 11:52:47',
                ),
            7 =>
                array(
                    'id' => 32,
                    'button_type_id' => 1,
                    'name' => 'Список ветеринарных клиник',
                    'answer_id' => 5,
                    'button_message_text' => 'Список ветеринарных клиник',
                    'url' => NULL,
                    'chat_widget_id' => 22,
                    'created_at' => '2025-05-05 11:52:47',
                    'updated_at' => '2025-05-05 11:52:47',
                ),
            8 =>
                array(
                    'id' => 36,
                    'button_type_id' => 1,
                    'name' => 'Цены на топливо',
                    'answer_id' => 2,
                    'button_message_text' => 'Цены на топливо',
                    'url' => NULL,
                    'chat_widget_id' => 1,
                    'created_at' => '2025-05-05 12:07:05',
                    'updated_at' => '2025-05-05 12:07:05',
                ),
            9 =>
                array(
                    'id' => 37,
                    'button_type_id' => 2,
                    'name' => 'Запись в детский сад',
                    'answer_id' => 2,
                    'button_message_text' => 'Запись в детский сад',
                    'url' => 'https://www.gosuslugi.ru/help/faq/popular/21',
                    'chat_widget_id' => NULL,
                    'created_at' => '2025-05-05 12:07:05',
                    'updated_at' => '2025-05-05 12:07:05',
                ),
            10 =>
                array(
                    'id' => 38,
                    'button_type_id' => 1,
                    'name' => 'Подбор мер соц. поддержки',
                    'answer_id' => 2,
                    'button_message_text' => 'Подбор мер соц. поддержки',
                    'url' => NULL,
                    'chat_widget_id' => 10,
                    'created_at' => '2025-05-05 12:07:05',
                    'updated_at' => '2025-05-05 12:07:05',
                ),
            11 =>
                array(
                    'id' => 42,
                    'button_type_id' => 1,
                    'name' => 'Трудоустройство в Югре',
                    'answer_id' => 4,
                    'button_message_text' => 'Трудоустройство в Югре',
                    'url' => NULL,
                    'chat_widget_id' => 12,
                    'created_at' => '2025-05-05 12:14:04',
                    'updated_at' => '2025-05-05 12:14:04',
                ),
            12 =>
                array(
                    'id' => 43,
                    'button_type_id' => 1,
                    'name' => 'Узнать статус дела',
                    'answer_id' => 11,
                    'button_message_text' => 'Узнать статус дела',
                    'url' => NULL,
                    'chat_widget_id' => 13,
                    'created_at' => '2025-05-05 12:16:12',
                    'updated_at' => '2025-05-05 12:16:12',
                ),
            13 =>
                array(
                    'id' => 44,
                    'button_type_id' => 2,
                    'name' => 'Запись в детский сад',
                    'answer_id' => 17,
                    'button_message_text' => 'Запись в детский сад',
                    'url' => 'https://www.gosuslugi.ru/help/faq/popular/21',
                    'chat_widget_id' => NULL,
                    'created_at' => '2025-05-05 12:18:10',
                    'updated_at' => '2025-05-05 12:18:10',
                ),
            14 =>
                array(
                    'id' => 45,
                    'button_type_id' => 1,
                    'name' => 'Актировки',
                    'answer_id' => 12,
                    'button_message_text' => 'Актировки',
                    'url' => NULL,
                    'chat_widget_id' => 5,
                    'created_at' => '2025-05-05 12:19:18',
                    'updated_at' => '2025-05-05 12:19:18',
                ),
            15 =>
                array(
                    'id' => 46,
                    'button_type_id' => 1,
                    'name' => 'Архив Югры',
                    'answer_id' => 13,
                    'button_message_text' => 'Архив Югры',
                    'url' => NULL,
                    'chat_widget_id' => 19,
                    'created_at' => '2025-05-05 12:21:09',
                    'updated_at' => '2025-05-05 12:21:09',
                ),
            16 =>
                array(
                    'id' => 47,
                    'button_type_id' => 1,
                    'name' => 'Меры государственной поддержки родителей',
                    'answer_id' => 15,
                    'button_message_text' => 'Меры государственной поддержки родителей',
                    'url' => NULL,
                    'chat_widget_id' => 14,
                    'created_at' => '2025-05-05 12:23:45',
                    'updated_at' => '2025-05-05 12:23:45',
                ),
            17 =>
                array(
                    'id' => 48,
                    'button_type_id' => 2,
                    'name' => 'Полная инструкция',
                    'answer_id' => 16,
                    'button_message_text' => 'Полная инструкция',
                    'url' => 'https://vi.admhmao.ru/services/family/gosudarstvennaya-registratsiya-braka/',
                    'chat_widget_id' => NULL,
                    'created_at' => '2025-05-05 12:25:25',
                    'updated_at' => '2025-05-05 12:25:25',
                ),
            18 =>
                array(
                    'id' => 49,
                    'button_type_id' => 1,
                    'name' => 'Определить свой участок',
                    'answer_id' => 19,
                    'button_message_text' => 'Определить свой участок',
                    'url' => NULL,
                    'chat_widget_id' => 8,
                    'created_at' => '2025-05-05 12:53:50',
                    'updated_at' => '2025-05-05 12:53:50',
                ),
            19 =>
                array(
                    'id' => 50,
                    'button_type_id' => 2,
                    'name' => 'Полная инструкция',
                    'answer_id' => 19,
                    'button_message_text' => 'Полная инструкция',
                    'url' => 'https://vi.admhmao.ru/services/health/zapis-na-priem-k-vrachu/',
                    'chat_widget_id' => NULL,
                    'created_at' => '2025-05-05 12:53:50',
                    'updated_at' => '2025-05-05 12:53:50',
                ),
            20 =>
                array(
                    'id' => 51,
                    'button_type_id' => 1,
                    'name' => 'Медицинские участки',
                    'answer_id' => 24,
                    'button_message_text' => 'Медицинские участки',
                    'url' => NULL,
                    'chat_widget_id' => 8,
                    'created_at' => '2025-05-05 14:30:26',
                    'updated_at' => '2025-05-05 14:30:26',
                ),
            21 =>
                array(
                    'id' => 52,
                    'button_type_id' => 1,
                    'name' => 'Меры поддержки IT',
                    'answer_id' => 26,
                    'button_message_text' => 'Меры поддержки IT',
                    'url' => NULL,
                    'chat_widget_id' => 25,
                    'created_at' => '2025-05-05 14:32:14',
                    'updated_at' => '2025-05-05 14:32:14',
                ),
            22 =>
                array(
                    'id' => 54,
                    'button_type_id' => 1,
                    'name' => 'Навигатор по услугам для КМНС',
                    'answer_id' => 27,
                    'button_message_text' => 'Навигатор по услугам для КМНС',
                    'url' => NULL,
                    'chat_widget_id' => 30,
                    'created_at' => '2025-05-05 14:39:20',
                    'updated_at' => '2025-05-05 14:39:20',
                ),
            23 =>
                array(
                    'id' => 55,
                    'button_type_id' => 1,
                    'name' => 'Поддержка предпринимателей',
                    'answer_id' => 28,
                    'button_message_text' => 'Поддержка предпринимателей',
                    'url' => NULL,
                    'chat_widget_id' => 4,
                    'created_at' => '2025-05-05 14:43:06',
                    'updated_at' => '2025-05-05 14:43:06',
                ),
            24 =>
                array(
                    'id' => 56,
                    'button_type_id' => 1,
                    'name' => 'Меры социальной поддержки',
                    'answer_id' => 29,
                    'button_message_text' => 'Меры социальной поддержки',
                    'url' => NULL,
                    'chat_widget_id' => 10,
                    'created_at' => '2025-05-05 14:44:41',
                    'updated_at' => '2025-05-05 14:44:41',
                ),
            25 =>
                array(
                    'id' => 57,
                    'button_type_id' => 2,
                    'name' => 'Помощь мигранту',
                    'answer_id' => 30,
                    'button_message_text' => 'Помощь мигранту',
                    'url' => 'https://tisugra.admhmao.ru/migrant/information',
                    'chat_widget_id' => NULL,
                    'created_at' => '2025-05-05 15:00:15',
                    'updated_at' => '2025-05-05 15:00:15',
                ),
/*            26 =>
                array(
                    'id' => 58,
                    'button_type_id' => 1,
                    'name' => 'Выдача молочных смесей',
                    'answer_id' => 31,
                    'button_message_text' => 'Выдача молочных смесей',
                    'url' => NULL,
                    'chat_widget_id' => 9,
                    'created_at' => '2025-05-05 15:01:47',
                    'updated_at' => '2025-05-05 15:01:47',
                ),*/
            27 =>
                array(
                    'id' => 59,
                    'button_type_id' => 2,
                    'name' => 'Электронная запись на приём в МФЦ',
                    'answer_id' => 32,
                    'button_message_text' => 'Электронная запись на приём в МФЦ',
                    'url' => 'https://mfc.admhmao.ru/reception/',
                    'chat_widget_id' => NULL,
                    'created_at' => '2025-05-05 15:03:40',
                    'updated_at' => '2025-05-05 15:03:40',
                ),
            28 =>
                array(
                    'id' => 61,
                    'button_type_id' => 1,
                    'name' => 'Пушкинская карта',
                    'answer_id' => 37,
                    'button_message_text' => 'Пушкинская карта',
                    'url' => NULL,
                    'chat_widget_id' => 17,
                    'created_at' => '2025-05-05 15:04:41',
                    'updated_at' => '2025-05-05 15:04:41',
                ),
            29 =>
                array(
                    'id' => 62,
                    'button_type_id' => 2,
                    'name' => 'Разрешение на строительство',
                    'answer_id' => 39,
                    'button_message_text' => 'Разрешение на строительство',
                    'url' => 'https://www.gosuslugi.ru/group/building_permit',
                    'chat_widget_id' => NULL,
                    'created_at' => '2025-05-05 15:06:12',
                    'updated_at' => '2025-05-05 15:06:12',
                ),
            30 =>
                array(
                    'id' => 63,
                    'button_type_id' => 1,
                    'name' => 'Спортивные секции',
                    'answer_id' => 42,
                    'button_message_text' => 'Спортивные секции',
                    'url' => NULL,
                    'chat_widget_id' => 11,
                    'created_at' => '2025-05-05 15:18:20',
                    'updated_at' => '2025-05-05 15:18:20',
                ),
            31 =>
                array(
                    'id' => 64,
                    'button_type_id' => 1,
                    'name' => 'Телефонный справочник',
                    'answer_id' => 44,
                    'button_message_text' => 'Телефонный справочник',
                    'url' => NULL,
                    'chat_widget_id' => 2,
                    'created_at' => '2025-05-05 15:21:06',
                    'updated_at' => '2025-05-05 15:21:06',
                ),
            32 =>
                array(
                    'id' => 65,
                    'button_type_id' => 1,
                    'name' => 'Действия при утрате близкого человека',
                    'answer_id' => 46,
                    'button_message_text' => 'Действия при утрате близкого человека',
                    'url' => NULL,
                    'chat_widget_id' => 20,
                    'created_at' => '2025-05-05 15:22:49',
                    'updated_at' => '2025-05-05 15:22:49',
                ),
            33 =>
                array(
                    'id' => 66,
                    'button_type_id' => 2,
                    'name' => 'Электронный дневник',
                    'answer_id' => 47,
                    'button_message_text' => 'Электронный дневник',
                    'url' => 'https://vi.admhmao.ru/services/learning/elektronnyy-dnevnik/',
                    'chat_widget_id' => NULL,
                    'created_at' => '2025-05-05 15:25:25',
                    'updated_at' => '2025-05-05 15:25:25',
                ),
        ));

    }
}
