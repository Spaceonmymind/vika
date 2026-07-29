<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;

class ChatWidgetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $isWidgetsTableEmpty = \DB::table('chat_widgets')->doesntExist();
        $data = [
            0 =>
                [
                    'id' => 1,
                    'code_name' => 'vi-gas',
                    'name' => 'Цены на топливо',
                    'description' => 'Узнать где самый дешевый бензин',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 4,
                    'url' => null,
                    'bg_colour' => '#8091CA',
                ],
            1 =>
                [
                    'id' => 2,
                    'code_name' => 'vi-book',
                    'name' => 'Поиск контактов',
                    'description' => 'Найти необходимый телефонный номер',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 5,
                    'url' => null,
                    'bg_colour' => '#D88484',
                ],
            2 =>
                [
                    'id' => 3,
                    'code_name' => 'vi-tabel',
                    'name' => 'Статус сотрудника ИО',
                    'description' => 'Проверка статуса присутствия на рабочем месте сотрудников ИО',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 6,
                    'url' => null,
                    'bg_colour' => '#EA0303',
                ],
            3 =>
                [
                    'id' => 4,
                    'code_name' => 'vi-business-help',
                    'name' => 'Меры поддержки предпринимателей',
                    'description' => 'Узнать чем может помочь государство предпринимателю',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 7,
                    'url' => null,
                    'bg_colour' => '#236BD8',
                ],
            4 =>
                [
                    'id' => 5,
                    'code_name' => 'vi-actirovki',
                    'name' => 'Актировки',
                    'description' => 'Узнать есть ли сегодня актировка',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 8,
                    'url' => null,
                    'bg_colour' => '#D27EB1',
                ],
            5 =>
                [
                    'id' => 7,
                    'code_name' => 'vi-migrant',
                    'name' => 'Жизненные ситуации',
                    'description' => null,
                    'is_active' => 1,
                    'type_id' => 2,
                    'icon_id' => 9,
                    'url' => 'https://tisugra.admhmao.ru/migrant/information',
                    'bg_colour' => '#511C7B',
                ],
            6 =>
                [
                    'id' => 8,
                    'code_name' => 'vi-med',
                    'name' => 'Поиск медицинского участка',
                    'description' => 'Найти свой участок',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 10,
                    'url' => null,
                    'bg_colour' => '#59C18F',
                ],
            7 =>
                [
                    'id' => 10,
                    'code_name' => 'vi-social-help',
                    'name' => 'Меры социальной поддержки',
                    'description' => 'Узнать чем может помочь государство',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 7,
                    'url' => null,
                    'bg_colour' => '#236BD8',
                ],
            8 =>
                [
                    'id' => 11,
                    'code_name' => 'vi-sport',
                    'name' => 'Спортивные секции',
                    'description' => 'Заняться спортом',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 11,
                    'url' => null,
                    'bg_colour' => '#D27EB1',
                ],
            9 =>
                [
                    'id' => 12,
                    'code_name' => 'vi-employment-ugra',
                    'name' => 'Занятость в Югре',
                    'description' => null,
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 7,
                    'url' => null,
                    'bg_colour' => '#236BD8',
                ],
            10 =>
                [
                    'id' => 13,
                    'code_name' => 'vi-application-status-mfc',
                    'name' => 'Статус заявления',
                    'description' => 'Просмотр статуса заявления МФЦ',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 12,
                    'url' => null,
                    'bg_colour' => '#D27EB1',
                ],
            11 =>
                [
                    'id' => 14,
                    'code_name' => 'vi-pfr-help',
                    'name' => 'Меры государственной поддержки родителей',
                    'description' => 'Социальные льготы ПФР',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 13,
                    'url' => null,
                    'bg_colour' => '#236BD8',
                ],
            12 =>
                [
                    'id' => 15,
                    'code_name' => 'vi-culture-ugra',
                    'name' => 'Культура Югры',
                    'description' => null,
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 14,
                    'url' => null,
                    'bg_colour' => '#6FC9E5',
                ],
            13 =>
                [
                    'id' => 16,
                    'code_name' => 'vi-ugra-team',
                    'name' => 'Команда Югры',
                    'description' => null,
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 15,
                    'url' => null,
                    'bg_colour' => '#779FC1',
                ],
            14 =>
                [
                    'id' => 17,
                    'code_name' => 'vi-pushkin-card',
                    'name' => 'Пушкинская карта',
                    'description' => null,
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 14,
                    'url' => null,
                    'bg_colour' => '#6FC9E5',
                ],
            15 =>
                [
                    'id' => 19,
                    'code_name' => 'vi-archive-ugra',
                    'name' => 'Архив Югры',
                    'description' => null,
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 16,
                    'url' => null,
                    'bg_colour' => '#53B56D',
                ],
            16 =>
                [
                    'id' => 20,
                    'code_name' => 'vi-loss-person',
                    'name' => 'Алгоритм действий при утрате близкого человека',
                    'description' => null,
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => null,
                    'url' => null,
                    'bg_colour' => '#000000',
                ],
            17 =>
                [
                    'id' => 21,
                    'code_name' => 'vi-state-key',
                    'name' => 'Госключ',
                    'description' => null,
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 17,
                    'url' => null,
                    'bg_colour' => '#0A2996',
                ],
            18 =>
                [
                    'id' => 22,
                    'code_name' => 'vi-vet-clinic',
                    'name' => 'Список ветеринарных клиник',
                    'description' => 'Список ветеринарных клиник',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 18,
                    'url' => null,
                    'bg_colour' => '#6FA837',
                ],
            19 =>
                [
                    'id' => 23,
                    'code_name' => 'vi-walking-areas',
                    'name' => 'Места выгула и дрессировки',
                    'description' => 'Места выгула и дрессировки, куда граждане могут выйти погулять и позаниматься с животными',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 18,
                    'url' => null,
                    'bg_colour' => '#6FA837',
                ],
            20 =>
                [
                    'id' => 24,
                    'code_name' => 'vi-animals-shelters',
                    'name' => 'Перечень приютов для животных',
                    'description' => 'Перечень приютов для животных, где граждане могут оставить или приобрести животных',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 18,
                    'url' => null,
                    'bg_colour' => '#6FA837',
                ],
            21 =>
                [
                    'id' => 25,
                    'code_name' => 'vi-it-help',
                    'name' => 'Меры поддержки ИТ-компаний',
                    'description' => 'Узнать чем может помочь государство IT',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 7,
                    'url' => null,
                    'bg_colour' => '#236BD8',
                ],
            22 =>
                [
                    'id' => 26,
                    'code_name' => 'vi-dgz-help',
                    'name' => 'Госзакупки',
                    'description' => 'Справочная информация по вопросам эксплуатации ГИС "Государственный заказ" и организации закупочных процедур в ХМАО-Югре',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 19,
                    'url' => null,
                    'bg_colour' => '#236BD8',
                ],
            23 =>
                [
                    'id' => 27,
                    'code_name' => 'vi-abbreviation',
                    'name' => 'Аббревиатура',
                    'description' => 'Поиск аббревиатур',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 20,
                    'url' => null,
                    'bg_colour' => '#4B9772',
                ],
            24 =>
                [
                    'id' => 28,
                    'code_name' => 'vi-humanitarian-points',
                    'name' => 'Гуманитарные пункты приёма',
                    'description' => 'Информация об адресах гуманитарных организаций округа',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 21,
                    'url' => null,
                    'bg_colour' => '#70ACCD',
                ],
            25 =>
                [
                    'id' => 29,
                    'code_name' => 'vi-system-help',
                    'name' => 'Справка по ИС',
                    'description' => 'Справочная и обучающая информация по информационным системам',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 22,
                    'url' => null,
                    'bg_colour' => '#8091CA',
                ],
            26 =>
                [
                    'id' => 30,
                    'code_name' => 'vi-social-services',
                    'name' => 'Социальные услуги в Югре',
                    'description' => 'Перечень услуг, которые оказываются в округе',
                    'is_active' => 1,
                    'type_id' => 2,
                    'icon_id' => 7,
                    'url' => 'https://socportal.admhmao.ru/navigator/services',
                    'bg_colour' => '#236BD8',
                ],
            27 =>
                [
                    'id' => 31,
                    'code_name' => 'vi-lost-pet',
                    'name' => 'Объявление о пропаже/находке животных',
                    'description' => 'Вы можете оставить объявление о пропаже/находке животных ',
                    'is_active' => 1,
                    'type_id' => 2,
                    'icon_id' => 18,
                    'url' => 'https://animals.admhmao.ru/animals/advertisement-public',
                    'bg_colour' => '#6FA837',
                ],
            28 =>
                [
                    'id' => 32,
                    'code_name' => 'vi-catch-request-pet',
                    'name' => 'Заявка на отлов животных',
                    'description' => 'Вы можете оставить заявку на отлов животных',
                    'is_active' => 1,
                    'type_id' => 2,
                    'icon_id' => 18,
                    'url' => 'https://animals.admhmao.ru/animals/catch-request-public',
                    'bg_colour' => '#6FA837',
                ],
            29 =>
                [
                    'id' => 33,
                    'code_name' => 'vi-migrant-organisations',
                    'name' => 'Путеводитель мигранта',
                    'description' => null,
                    'is_active' => 1,
                    'type_id' => 2,
                    'icon_id' => 9,
                    'url' => 'https://tisugra.admhmao.ru/migrant/organizations',
                    'bg_colour' => '#511C7B',
                ],
            30 =>
                [
                    'id' => 34,
                    'code_name' => 'vi-migrant-doc-check',
                    'name' => 'Проверка документов',
                    'description' => null,
                    'is_active' => 1,
                    'type_id' => 2,
                    'icon_id' => 9,
                    'url' => 'https://tisugra.admhmao.ru/migrant/verification',
                    'bg_colour' => '#511C7B',
                ],
            31 =>
                [
                    'id' => 35,
                    'code_name' => 'vi-migrant-news',
                    'name' => 'Новости',
                    'description' => null,
                    'is_active' => 1,
                    'type_id' => 2,
                    'icon_id' => 9,
                    'url' => 'https://tisugra.admhmao.ru/migrant/news',
                    'bg_colour' => '#511C7B',
                ],
            32 =>
                [
                    'id' => 36,
                    'code_name' => 'vi-migrant-mobile-app',
                    'name' => 'Мобильное приложение',
                    'description' => null,
                    'is_active' => 1,
                    'type_id' => 2,
                    'icon_id' => 9,
                    'url' => 'https://tisugra.admhmao.ru/migrant/mobile-app',
                    'bg_colour' => '#511C7B',
                ],
            33 =>
                [
                    'id' => 42,
                    'code_name' => 'vi-jkh',
                    'name' => 'Поиск управляющей компании',
                    'description' => 'Найти информацию о своей управляющей компании',
                    'is_active' => 1,
                    'type_id' => 2,
                    'icon_id' => 25,
                    'url' => 'https://dom.gosuslugi.ru/#!/houses',
                    'bg_colour' => '#48CECF',
                ],
            34 =>
                [
                    'id' => 43,
                    'code_name' => 'vi-kmns-help',
                    'name' => 'Навигатор по услугам для КМНС',
                    'description' => 'Узнать чем может помочь государство КМНС',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 7,
                    'url' => null,
                    'bg_colour' => '#236BD8',
                ],
            35 =>
                [
                    'id' => 50,
                    'code_name' => 'vi-doctor-appointment',
                    'name' => 'Запись на приём к врачу',
                    'description' => 'Записаться на приём к врачу',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 23,
                    'url' => null,
                    'bg_colour' => '#236BD8',
                ],
            36 =>
                [
                    'id' => 51,
                    'code_name' => 'vi-doctor-tmk',
                    'name' => 'Телемедицина',
                    'description' => 'Провести удалённую консультацию с врачом',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 23,
                    'url' => null,
                    'bg_colour' => '#236BD8',
                ],
            37 =>
                [
                    'id' => 52,
                    'code_name' => 'vi-region-head-hotline',
                    'name' => 'Горячая линия губернатора',
                    'description' => 'Обратиться с вопросом или жалобой к губернатору',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 1,
                    'url' => null,
                    'bg_colour' => '#236BD8',
                ],
            38 =>
                [
                    'id' => 53,
                    'code_name' => 'vi-doctor-home-visit',
                    'name' => 'Вызов врача на дом',
                    'description' => 'Вызвать врача на дом',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 23,
                    'url' => null,
                    'bg_colour' => '#236BD8',
                ],
            39 =>
                [
                    'id' => 54,
                    'code_name' => 'vi-med-org-search',
                    'name' => 'Поиск медицинских организаций',
                    'description' => 'Найти медицинскую организацию',
                    'is_active' => 1,
                    'type_id' => 1,
                    'icon_id' => 23,
                    'url' => null,
                    'bg_colour' => '#236BD8',
                ],

        ];

        foreach ($data as $row) {
            if ($isWidgetsTableEmpty) {
                \DB::table('chat_widgets')->insert($row);
            } else {
                if ($row['type_id'] == 1 && \DB::table('chat_widgets')->where('code_name', $row['code_name'])->doesntExist()) {
                    unset($row['id']);
                    \DB::table('chat_widgets')->insert($row);
                }
            }

        }
    }
}
