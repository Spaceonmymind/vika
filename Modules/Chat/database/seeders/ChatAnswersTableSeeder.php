<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;

class ChatAnswersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        if (\DB::table('chat_answers')->exists()) {
            return;
        }

        \DB::table('chat_answers')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Ответ с кнопкой вызова виджета "топливо"',
                    'intent_id' => 47,
                    'is_active' => 1,
                    'created_at' => '2025-03-11 16:54:18',
                    'updated_at' => '2025-03-11 16:54:18',
                    'vika_type_id' => 1,
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'Приветственное сообщение основная вика',
                    'intent_id' => 10,
                    'is_active' => 1,
                    'created_at' => '2025-04-03 15:01:45',
                    'updated_at' => '2025-04-03 15:01:45',
                    'vika_type_id' => 1,
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'Ответ, когда нейронка не смогла распознать намеренья',
                    'intent_id' => 9,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:30:23',
                    'updated_at' => '2025-04-11 10:30:23',
                    'vika_type_id' => 1,
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'Ответ на интент [ДепТруд] Вызов виджета "Занятость в Югре"',
                    'intent_id' => 1,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 12:14:04',
                    'vika_type_id' => 1,
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'Ответ на интент [Животные] Ветеринарные клиники и услуги для животных',
                    'intent_id' => 2,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 11:40:20',
                    'vika_type_id' => 1,
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'Ответ на интент [Животные] Заявка на отлов животного',
                    'intent_id' => 3,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 11:32:39',
                    'vika_type_id' => 1,
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => 'Ответ на интент [Животные] Места выгула и дрессировки животных',
                    'intent_id' => 4,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 11:36:56',
                    'vika_type_id' => 1,
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => 'Ответ на интент [Животные] Приюты для животных',
                    'intent_id' => 5,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 11:38:10',
                    'vika_type_id' => 1,
                ),
            8 =>
                array(
                    'id' => 9,
                    'name' => 'Ответ на интент [Животные] Доска объявлений о пропаже/находке животных',
                    'intent_id' => 6,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 11:35:14',
                    'vika_type_id' => 1,
                ),
            9 =>
                array(
                    'id' => 10,
                    'name' => '(заглушка)Ответ на интент [Животные] Места утилизации биологических отходов (трупов животных)',
                    'intent_id' => 7,
                    'is_active' => 0,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 11:57:34',
                    'vika_type_id' => 1,
                ),
            10 =>
                array(
                    'id' => 11,
                    'name' => 'Ответ на интент [МФЦ] Узнать статус дела',
                    'intent_id' => 8,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 12:16:12',
                    'vika_type_id' => 1,
                ),
            11 =>
                array(
                    'id' => 12,
                    'name' => '(заглушка)Ответ на интент Актировки',
                    'intent_id' => 11,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-04-11 10:37:23',
                    'vika_type_id' => 1,
                ),
            12 =>
                array(
                    'id' => 13,
                    'name' => 'Ответ на интент Архив',
                    'intent_id' => 12,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 12:21:09',
                    'vika_type_id' => 1,
                ),
            13 =>
                array(
                    'id' => 14,
                    'name' => '(заглушка)Ответ на интент Вопросы ДГЗ (вызов виджета)',
                    'intent_id' => 13,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-04-11 10:37:23',
                    'vika_type_id' => 1,
                ),
            14 =>
                array(
                    'id' => 15,
                    'name' => 'Ответ на интент Ежемесячное пособие на ребенка',
                    'intent_id' => 14,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 12:23:45',
                    'vika_type_id' => 1,
                ),
            15 =>
                array(
                    'id' => 16,
                    'name' => 'Ответ на интент ЗАГС',
                    'intent_id' => 15,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 12:25:25',
                    'vika_type_id' => 1,
                ),
            16 =>
                array(
                    'id' => 17,
                    'name' => 'Ответ на интент Запись в детский сад',
                    'intent_id' => 16,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 12:11:48',
                    'vika_type_id' => 1,
                ),
            17 =>
                array(
                    'id' => 18,
                    'name' => '(заглушка)Ответ на интент Запись в школу',
                    'intent_id' => 17,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-04-11 10:37:23',
                    'vika_type_id' => 1,
                ),
            18 =>
                array(
                    'id' => 19,
                    'name' => 'Ответ на интент Запись к врачу',
                    'intent_id' => 18,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 12:53:50',
                    'vika_type_id' => 1,
                ),
            19 =>
                array(
                    'id' => 20,
                    'name' => 'Ответ на интент Запрос в техподдержку (ЕИС)',
                    'intent_id' => 19,
                    'is_active' => 0,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:19:40',
                    'vika_type_id' => 1,
                ),
            20 =>
                array(
                    'id' => 21,
                    'name' => '(заглушка)Ответ на интент ИОГВ',
                    'intent_id' => 20,
                    'is_active' => 0,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 13:08:01',
                    'vika_type_id' => 1,
                ),
            21 =>
                array(
                    'id' => 22,
                    'name' => '(заглушка)Ответ на интент Льготные аптеки',
                    'intent_id' => 21,
                    'is_active' => 0,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 14:28:43',
                    'vika_type_id' => 1,
                ),
            22 =>
                array(
                    'id' => 23,
                    'name' => '(заглушка)Ответ на интент Льготные рецепты',
                    'intent_id' => 22,
                    'is_active' => 0,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 14:29:12',
                    'vika_type_id' => 1,
                ),
            23 =>
                array(
                    'id' => 24,
                    'name' => 'Ответ на интент Медицинские участки',
                    'intent_id' => 23,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 14:30:26',
                    'vika_type_id' => 1,
                ),
            24 =>
                array(
                    'id' => 25,
                    'name' => '(заглушка)Ответ на интент Междугородние автобусы',
                    'intent_id' => 24,
                    'is_active' => 0,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 14:30:35',
                    'vika_type_id' => 1,
                ),
            25 =>
                array(
                    'id' => 26,
                    'name' => 'Ответ на интент Меры поддержки IT-компаний',
                    'intent_id' => 25,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 14:32:14',
                    'vika_type_id' => 1,
                ),
            26 =>
                array(
                    'id' => 27,
                    'name' => 'Ответ на интент Меры поддержки КМНС',
                    'intent_id' => 26,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 14:39:20',
                    'vika_type_id' => 1,
                ),
            27 =>
                array(
                    'id' => 28,
                    'name' => 'Ответ на интент Меры поддержки предпринимателей',
                    'intent_id' => 27,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 14:43:06',
                    'vika_type_id' => 1,
                ),
            28 =>
                array(
                    'id' => 29,
                    'name' => 'Ответ на интент Меры социальной поддержки',
                    'intent_id' => 28,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 14:44:41',
                    'vika_type_id' => 1,
                ),
            29 =>
                array(
                    'id' => 30,
                    'name' => 'Ответ на интент Мигрант',
                    'intent_id' => 29,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:00:15',
                    'vika_type_id' => 1,
                ),
            30 =>
                array(
                    'id' => 31,
                    'name' => 'Ответ на интент Молочная кухня',
                    'intent_id' => 30,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:01:47',
                    'vika_type_id' => 1,
                ),
            31 =>
                array(
                    'id' => 32,
                    'name' => 'Ответ на интент Обращение в МФЦ',
                    'intent_id' => 31,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:03:40',
                    'vika_type_id' => 1,
                ),
            32 =>
                array(
                    'id' => 33,
                    'name' => '(заглушка)Ответ на интент Открытая линия',
                    'intent_id' => 32,
                    'is_active' => 0,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:03:48',
                    'vika_type_id' => 1,
                ),
            33 =>
                array(
                    'id' => 34,
                    'name' => '(заглушка)Ответ на интент Открытая линия ЕПГУ',
                    'intent_id' => 33,
                    'is_active' => 0,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:03:55',
                    'vika_type_id' => 1,
                ),
            34 =>
                array(
                    'id' => 35,
                    'name' => '(заглушка)Ответ на интент Открытая линия миац',
                    'intent_id' => 34,
                    'is_active' => 0,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:04:02',
                    'vika_type_id' => 1,
                ),
            35 =>
                array(
                    'id' => 36,
                    'name' => '(заглушка)Ответ на интент Очередь в детский сад',
                    'intent_id' => 35,
                    'is_active' => 0,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 12:09:26',
                    'vika_type_id' => 1,
                ),
            36 =>
                array(
                    'id' => 37,
                    'name' => 'Ответ на интент Пушкинская карта',
                    'intent_id' => 37,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:04:41',
                    'vika_type_id' => 1,
                ),
            37 =>
                array(
                    'id' => 38,
                    'name' => 'Ответ на интент Развод',
                    'intent_id' => 38,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:05:15',
                    'vika_type_id' => 1,
                ),
            38 =>
                array(
                    'id' => 39,
                    'name' => 'Ответ на интент Разрешение на строительство',
                    'intent_id' => 39,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:06:12',
                    'vika_type_id' => 1,
                ),
            39 =>
                array(
                    'id' => 40,
                    'name' => '(заглушка)Ответ на интент Регистрация (прописка)',
                    'intent_id' => 40,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-04-11 10:37:23',
                    'vika_type_id' => 1,
                ),
            40 =>
                array(
                    'id' => 41,
                    'name' => '(заглушка)Ответ на интент Рождение ребенка',
                    'intent_id' => 41,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-04-11 10:37:23',
                    'vika_type_id' => 1,
                ),
            41 =>
                array(
                    'id' => 42,
                    'name' => 'Ответ на интент Спортивные секции',
                    'intent_id' => 42,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:18:20',
                    'vika_type_id' => 1,
                ),
            42 =>
                array(
                    'id' => 43,
                    'name' => 'Ответ на интент Сроки загрузки информации из ЕИС',
                    'intent_id' => 43,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:19:50',
                    'vika_type_id' => 1,
                ),
            43 =>
                array(
                    'id' => 44,
                    'name' => 'Ответ на интент Телефонный справочник',
                    'intent_id' => 44,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:21:06',
                    'vika_type_id' => 1,
                ),
            44 =>
                array(
                    'id' => 45,
                    'name' => '(заглушка)Ответ на интент Управляющие компании',
                    'intent_id' => 45,
                    'is_active' => 0,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:22:03',
                    'vika_type_id' => 1,
                ),
            45 =>
                array(
                    'id' => 46,
                    'name' => 'Ответ на интент Утрата близкого человека',
                    'intent_id' => 46,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:22:49',
                    'vika_type_id' => 1,
                ),
            46 =>
                array(
                    'id' => 47,
                    'name' => 'Ответ на интент Электронный дневник',
                    'intent_id' => 49,
                    'is_active' => 1,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:25:25',
                    'vika_type_id' => 1,
                ),
            47 =>
                array(
                    'id' => 48,
                    'name' => '(заглушка)Ответ на интент Госзакупки',
                    'intent_id' => 50,
                    'is_active' => 0,
                    'created_at' => '2025-04-11 10:37:23',
                    'updated_at' => '2025-05-05 15:25:54',
                    'vika_type_id' => 1,
                ),
        ));

    }
}
