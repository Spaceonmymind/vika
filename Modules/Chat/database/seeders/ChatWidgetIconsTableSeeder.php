<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ChatWidgetIconsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();

        \DB::table('chat_widget_icons')->delete();

        \DB::table('chat_widget_icons')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'code' => 'cat-support',
                    'name' => 'Вопрос',
                ),
            1 =>
                array (
                    'id' => 2,
                    'code' => 'cat-education',
                    'name' => 'Образование',
                ),
            2 =>
                array (
                    'id' => 3,
                    'code' => 'vi-socialHelp',
                    'name' => 'Меры поддержки',
                ),
            3 =>
                array (
                    'id' => 4,
                    'code' => 'vi-gas',
                    'name' => 'Бензин',
                ),
            4 =>
                array (
                    'id' => 5,
                    'code' => 'vi-book',
                    'name' => 'Книга',
                ),
            5 =>
                array (
                    'id' => 6,
                    'code' => 'vi-calendar',
                    'name' => 'Календарь',
                ),
            6 =>
                array (
                    'id' => 7,
                    'code' => 'vi-social',
                    'name' => 'Деньги',
                ),
            7 =>
                array (
                    'id' => 8,
                    'code' => 'vi-aktir',
                    'name' => 'Снежинка',
                ),
            8 =>
                array (
                    'id' => 9,
                    'code' => 'vi-migrant',
                    'name' => 'Паспорт',
                ),
            9 =>
                array (
                    'id' => 10,
                    'code' => 'vi-med',
                    'name' => 'Крест с маркером',
                ),
            10 =>
                array (
                    'id' => 11,
                    'code' => 'vi-sport',
                    'name' => 'Мяч',
                ),
            11 =>
                array (
                    'id' => 12,
                    'code' => 'vi-mfc',
                    'name' => 'Список',
                ),
            12 =>
                array (
                    'id' => 13,
                    'code' => 'vi-pfr',
                    'name' => 'ПФР',
                ),
            13 =>
                array (
                    'id' => 14,
                    'code' => 'vi-culture',
                    'name' => 'Маски',
                ),
            14 =>
                array (
                    'id' => 15,
                    'code' => 'vi-team-yugra',
                    'name' => 'ЮграТим',
                ),
            15 =>
                array (
                    'id' => 16,
                    'code' => 'archive',
                    'name' => 'Архив',
                ),
            16 =>
                array (
                    'id' => 17,
                    'code' => 'vi-goskey',
                    'name' => 'Ключ',
                ),
            17 =>
                array (
                    'id' => 18,
                    'code' => 'vi-vetclinic',
                    'name' => 'Лапа',
                ),
            18 =>
                array (
                    'id' => 19,
                    'code' => 'vi-dgz',
                    'name' => 'Герб',
                ),
            19 =>
                array (
                    'id' => 20,
                    'code' => 'vi-abbreviation',
                    'name' => 'Книга с буквой А',
                ),
            20 =>
                array (
                    'id' => 21,
                    'code' => 'vi-location',
                    'name' => 'Локация',
                ),
            21 =>
                array (
                    'id' => 22,
                    'code' => 'vi-social-services',
                    'name' => 'Книга с буквой I',
                ),
            22 =>
                array (
                    'id' => 23,
                    'code' => 'cat-healthcare',
                    'name' => 'Крест',
                ),
            23 =>
                array (
                    'id' => 24,
                    'code' => 'cat-other',
                    'name' => 'Три точки',
                ),
            24 =>
                array (
                    'id' => 25,
                    'code' => 'vi-jkh',
                    'name' => 'Кран',
                ),
        ));

        Schema::enableForeignKeyConstraints();

    }
}
