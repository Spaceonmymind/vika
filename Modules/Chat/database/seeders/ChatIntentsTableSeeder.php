<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;

class ChatIntentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        if(\DB::table('chat_intents')->count() > 0) {
            return;
        }
        $data = [
            0 =>
                [
                    'id' => 1,
                    'code' => 'dep_trud.ugras_employment',
                    'name' => '[ДепТруд] Вызов виджета "Занятость в Югре"',
                    'handler_id' => 1,
                ],
            1 =>
                [
                    'id' => 2,
                    'code' => 'animal_vet_clinics',
                    'name' => '[Животные] Ветеринарные клиники и услуги для животных',
                    'handler_id' => 1,
                ],
            2 =>
                [
                    'id' => 3,
                    'code' => 'animal_capture',
                    'name' => '[Животные] Заявка на отлов животного',
                    'handler_id' => 1,
                ],
            3 =>
                [
                    'id' => 4,
                    'code' => 'animal_dog_walking_area',
                    'name' => '[Животные] Места выгула и дрессировки животных',
                    'handler_id' => 1,
                ],
            4 =>
                [
                    'id' => 5,
                    'code' => 'animal_shelters',
                    'name' => '[Животные] Приюты для животных',
                    'handler_id' => 1,
                ],
            5 =>
                [
                    'id' => 6,
                    'code' => 'animal_lost_or_found_pet',
                    'name' => '[Животные] Доска объявлений о пропаже/находке животных',
                    'handler_id' => 1,
                ],
            6 =>
                [
                    'id' => 7,
                    'code' => 'animal',
                    'name' => '[Животные] Места утилизации биологических отходов (трупов животных)',
                    'handler_id' => 1,
                ],
            7 =>
                [
                    'id' => 8,
                    'code' => 'mfc_cases_status',
                    'name' => '[МФЦ] Узнать статус дела',
                    'handler_id' => 1,
                ],
            8 =>
                [
                    'id' => 9,
                    'code' => 'input.unknown',
                    'name' => 'Default Fallback Intent',
                    'handler_id' => 1,
                ],
            9 =>
                [
                    'id' => 10,
                    'code' => 'welcome',
                    'name' => 'Default Welcome Intent',
                    'handler_id' => 1,
                ],
            10 =>
                [
                    'id' => 11,
                    'code' => 'actirovki',
                    'name' => 'Актировки',
                    'handler_id' => 1,
                ],
            11 =>
                [
                    'id' => 12,
                    'code' => 'archive',
                    'name' => 'Архив',
                    'handler_id' => 1,
                ],
            12 =>
                [
                    'id' => 13,
                    'code' => 'dgz_questions',
                    'name' => 'Вопросы ДГЗ (вызов виджета)',
                    'handler_id' => 1,
                ],
            13 =>
                [
                    'id' => 14,
                    'code' => 'allowance_help',
                    'name' => 'Ежемесячное пособие на ребенка',
                    'handler_id' => 1,
                ],
            14 =>
                [
                    'id' => 15,
                    'code' => 'zags',
                    'name' => 'ЗАГС',
                    'handler_id' => 1,
                ],
            15 =>
                [
                    'id' => 16,
                    'code' => 'kindergarten',
                    'name' => 'Запись в детский сад',
                    'handler_id' => 1,
                ],
            16 =>
                [
                    'id' => 17,
                    'code' => 'school',
                    'name' => 'Запись в школу',
                    'handler_id' => 1,
                ],
            17 =>
                [
                    'id' => 18,
                    'code' => 'doctor',
                    'name' => 'Запись к врачу',
                    'handler_id' => 1,
                ],
            18 =>
                [
                    'id' => 19,
                    'code' => 'eis_support',
                    'name' => 'Запрос в техподдержку (ЕИС)',
                    'handler_id' => 1,
                ],
            19 =>
                [
                    'id' => 20,
                    'code' => 'IOGV',
                    'name' => 'ИОГВ',
                    'handler_id' => 1,
                ],
            20 =>
                [
                    'id' => 21,
                    'code' => 'preferent_pharmacy',
                    'name' => 'Льготные аптеки',
                    'handler_id' => 1,
                ],
            21 =>
                [
                    'id' => 22,
                    'code' => 'prescription_relief',
                    'name' => 'Льготные рецепты',
                    'handler_id' => 1,
                ],
            22 =>
                [
                    'id' => 23,
                    'code' => 'med_area',
                    'name' => 'Медицинские участки',
                    'handler_id' => 1,
                ],
            23 =>
                [
                    'id' => 24,
                    'code' => 'bus_routes',
                    'name' => 'Междугородние автобусы',
                    'handler_id' => 1,
                ],
            24 =>
                [
                    'id' => 25,
                    'code' => 'it_help',
                    'name' => 'Меры поддержки IT-компаний',
                    'handler_id' => 1,
                ],
            25 =>
                [
                    'id' => 26,
                    'code' => 'KMNS',
                    'name' => 'Меры поддержки КМНС',
                    'handler_id' => 1,
                ],
            26 =>
                [
                    'id' => 27,
                    'code' => 'business_help',
                    'name' => 'Меры поддержки предпринимателей',
                    'handler_id' => 1,
                ],
            27 =>
                [
                    'id' => 28,
                    'code' => 'social_help',
                    'name' => 'Меры социальной поддержки',
                    'handler_id' => 1,
                ],
            28 =>
                [
                    'id' => 29,
                    'code' => 'migrant',
                    'name' => 'Мигрант',
                    'handler_id' => 1,
                ],
            29 =>
                [
                    'id' => 30,
                    'code' => 'milk_kitchen',
                    'name' => 'Молочная кухня',
                    'handler_id' => 1,
                ],
            30 =>
                [
                    'id' => 31,
                    'code' => 'mfc_appointment',
                    'name' => 'Обращение в МФЦ',
                    'handler_id' => 1,
                ],
            31 =>
                [
                    'id' => 32,
                    'code' => 'open_lines',
                    'name' => 'Открытая линия',
                    'handler_id' => 1,
                ],
            32 =>
                [
                    'id' => 33,
                    'code' => 'epgu_ol',
                    'name' => 'Открытая линия ЕПГУ',
                    'handler_id' => 1,
                ],
            33 =>
                [
                    'id' => 34,
                    'code' => 'open_lines_miac',
                    'name' => 'Открытая линия миац',
                    'handler_id' => 1,
                ],
            34 =>
                [
                    'id' => 35,
                    'code' => 'detsad',
                    'name' => 'Очередь в детский сад',
                    'handler_id' => 1,
                ],
            35 =>
                [
                    'id' => 37,
                    'code' => 'pushkins_card',
                    'name' => 'Пушкинская карта',
                    'handler_id' => 1,
                ],
            36 =>
                [
                    'id' => 38,
                    'code' => 'divorce',
                    'name' => 'Развод',
                    'handler_id' => 1,
                ],
            37 =>
                [
                    'id' => 39,
                    'code' => 'building',
                    'name' => 'Разрешение на строительство',
                    'handler_id' => 1,
                ],
            38 =>
                [
                    'id' => 40,
                    'code' => 'residence_permit',
                    'name' => 'Регистрация (прописка)',
                    'handler_id' => 1,
                ],
            39 =>
                [
                    'id' => 41,
                    'code' => 'birth',
                    'name' => 'Рождение ребенка',
                    'handler_id' => 1,
                ],
            40 =>
                [
                    'id' => 42,
                    'code' => 'sport',
                    'name' => 'Спортивные секции',
                    'handler_id' => 1,
                ],
            41 =>
                [
                    'id' => 43,
                    'code' => 'eis_upload_time',
                    'name' => 'Сроки загрузки информации из ЕИС',
                    'handler_id' => 1,
                ],
            42 =>
                [
                    'id' => 44,
                    'code' => 'phonebook',
                    'name' => 'Телефонный справочник',
                    'handler_id' => 1,
                ],
            43 =>
                [
                    'id' => 45,
                    'code' => 'control_company',
                    'name' => 'Управляющие компании',
                    'handler_id' => 1,
                ],
            44 =>
                [
                    'id' => 46,
                    'code' => 'persons_death',
                    'name' => 'Утрата близкого человека',
                    'handler_id' => 1,
                ],
            45 =>
                [
                    'id' => 47,
                    'code' => 'benz',
                    'name' => 'Цены на топливо',
                    'handler_id' => 1,
                ],
            46 =>
                [
                    'id' => 49,
                    'code' => 'dnevnik',
                    'name' => 'Электронный дневник',
                    'handler_id' => 1,
                ],
            47 =>
                [
                    'id' => 50,
                    'code' => 'goszakupki',
                    'name' => 'Госзакупки',
                    'handler_id' => 1,
                ],
        ];

        foreach ($data as $row) {
            if (\DB::table('chat_intents')->where('id', $row['id'])->doesntExist()) {

                \DB::table('chat_intents')->insert($row);
            }
        }

    }
}
