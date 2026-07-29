<?php

namespace Modules\ActirovkiWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class ActirovkiWidgetWeatherRangesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        if (\DB::table('actirovki_widget_weather_ranges')->exists()) {
            return;
        }

        \DB::table('actirovki_widget_weather_ranges')->insert(array (
            0 =>
            array (
                'id' => 1,
                'city_id' => 28,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            1 =>
            array (
                'id' => 2,
                'city_id' => 28,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            2 =>
            array (
                'id' => 3,
                'city_id' => 28,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            3 =>
            array (
                'id' => 4,
                'city_id' => 28,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            4 =>
            array (
                'id' => 5,
                'city_id' => 28,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            5 =>
            array (
                'id' => 6,
                'city_id' => 28,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            6 =>
            array (
                'id' => 7,
                'city_id' => 28,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            7 =>
            array (
                'id' => 8,
                'city_id' => 28,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            8 =>
            array (
                'id' => 9,
                'city_id' => 28,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            9 =>
            array (
                'id' => 10,
                'city_id' => 28,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            10 =>
            array (
                'id' => 11,
                'city_id' => 28,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            11 =>
            array (
                'id' => 12,
                'city_id' => 28,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            12 =>
            array (
                'id' => 13,
                'city_id' => 29,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            13 =>
            array (
                'id' => 14,
                'city_id' => 29,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            14 =>
            array (
                'id' => 15,
                'city_id' => 29,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            15 =>
            array (
                'id' => 16,
                'city_id' => 29,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            16 =>
            array (
                'id' => 17,
                'city_id' => 29,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            17 =>
            array (
                'id' => 18,
                'city_id' => 29,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            18 =>
            array (
                'id' => 19,
                'city_id' => 29,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            19 =>
            array (
                'id' => 20,
                'city_id' => 29,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            20 =>
            array (
                'id' => 21,
                'city_id' => 29,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            21 =>
            array (
                'id' => 22,
                'city_id' => 29,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            22 =>
            array (
                'id' => 23,
                'city_id' => 29,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            23 =>
            array (
                'id' => 24,
                'city_id' => 29,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            24 =>
            array (
                'id' => 25,
                'city_id' => 30,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            25 =>
            array (
                'id' => 26,
                'city_id' => 30,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            26 =>
            array (
                'id' => 27,
                'city_id' => 30,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            27 =>
            array (
                'id' => 28,
                'city_id' => 30,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            28 =>
            array (
                'id' => 29,
                'city_id' => 30,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            29 =>
            array (
                'id' => 30,
                'city_id' => 30,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            30 =>
            array (
                'id' => 31,
                'city_id' => 30,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            31 =>
            array (
                'id' => 32,
                'city_id' => 30,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            32 =>
            array (
                'id' => 33,
                'city_id' => 30,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            33 =>
            array (
                'id' => 34,
                'city_id' => 30,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            34 =>
            array (
                'id' => 35,
                'city_id' => 30,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            35 =>
            array (
                'id' => 36,
                'city_id' => 30,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            36 =>
            array (
                'id' => 37,
                'city_id' => 31,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            37 =>
            array (
                'id' => 38,
                'city_id' => 31,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            38 =>
            array (
                'id' => 39,
                'city_id' => 31,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            39 =>
            array (
                'id' => 40,
                'city_id' => 31,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            40 =>
            array (
                'id' => 41,
                'city_id' => 31,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            41 =>
            array (
                'id' => 42,
                'city_id' => 31,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            42 =>
            array (
                'id' => 43,
                'city_id' => 31,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            43 =>
            array (
                'id' => 44,
                'city_id' => 31,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            44 =>
            array (
                'id' => 45,
                'city_id' => 31,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            45 =>
            array (
                'id' => 46,
                'city_id' => 31,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            46 =>
            array (
                'id' => 47,
                'city_id' => 31,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            47 =>
            array (
                'id' => 48,
                'city_id' => 31,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            48 =>
            array (
                'id' => 49,
                'city_id' => 32,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            49 =>
            array (
                'id' => 50,
                'city_id' => 32,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            50 =>
            array (
                'id' => 51,
                'city_id' => 32,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            51 =>
            array (
                'id' => 52,
                'city_id' => 32,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            52 =>
            array (
                'id' => 53,
                'city_id' => 32,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            53 =>
            array (
                'id' => 54,
                'city_id' => 32,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            54 =>
            array (
                'id' => 55,
                'city_id' => 32,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            55 =>
            array (
                'id' => 56,
                'city_id' => 32,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            56 =>
            array (
                'id' => 57,
                'city_id' => 32,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            57 =>
            array (
                'id' => 58,
                'city_id' => 32,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            58 =>
            array (
                'id' => 59,
                'city_id' => 32,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            59 =>
            array (
                'id' => 60,
                'city_id' => 32,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            60 =>
            array (
                'id' => 61,
                'city_id' => 33,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            61 =>
            array (
                'id' => 62,
                'city_id' => 33,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            62 =>
            array (
                'id' => 63,
                'city_id' => 33,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            63 =>
            array (
                'id' => 64,
                'city_id' => 33,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            64 =>
            array (
                'id' => 65,
                'city_id' => 33,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            65 =>
            array (
                'id' => 66,
                'city_id' => 33,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            66 =>
            array (
                'id' => 67,
                'city_id' => 33,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            67 =>
            array (
                'id' => 68,
                'city_id' => 33,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            68 =>
            array (
                'id' => 69,
                'city_id' => 33,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            69 =>
            array (
                'id' => 70,
                'city_id' => 33,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            70 =>
            array (
                'id' => 71,
                'city_id' => 33,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            71 =>
            array (
                'id' => 72,
                'city_id' => 33,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            72 =>
            array (
                'id' => 73,
                'city_id' => 34,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            73 =>
            array (
                'id' => 74,
                'city_id' => 34,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            74 =>
            array (
                'id' => 75,
                'city_id' => 34,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            75 =>
            array (
                'id' => 76,
                'city_id' => 34,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            76 =>
            array (
                'id' => 77,
                'city_id' => 34,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            77 =>
            array (
                'id' => 78,
                'city_id' => 34,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            78 =>
            array (
                'id' => 79,
                'city_id' => 34,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            79 =>
            array (
                'id' => 80,
                'city_id' => 34,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            80 =>
            array (
                'id' => 81,
                'city_id' => 34,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            81 =>
            array (
                'id' => 82,
                'city_id' => 34,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            82 =>
            array (
                'id' => 83,
                'city_id' => 34,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            83 =>
            array (
                'id' => 84,
                'city_id' => 34,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            84 =>
            array (
                'id' => 85,
                'city_id' => 35,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            85 =>
            array (
                'id' => 86,
                'city_id' => 35,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            86 =>
            array (
                'id' => 87,
                'city_id' => 35,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            87 =>
            array (
                'id' => 88,
                'city_id' => 35,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            88 =>
            array (
                'id' => 89,
                'city_id' => 35,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            89 =>
            array (
                'id' => 90,
                'city_id' => 35,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            90 =>
            array (
                'id' => 91,
                'city_id' => 35,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            91 =>
            array (
                'id' => 92,
                'city_id' => 35,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            92 =>
            array (
                'id' => 93,
                'city_id' => 35,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            93 =>
            array (
                'id' => 94,
                'city_id' => 35,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            94 =>
            array (
                'id' => 95,
                'city_id' => 35,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            95 =>
            array (
                'id' => 96,
                'city_id' => 35,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            96 =>
            array (
                'id' => 97,
                'city_id' => 36,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            97 =>
            array (
                'id' => 98,
                'city_id' => 36,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            98 =>
            array (
                'id' => 99,
                'city_id' => 36,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            99 =>
            array (
                'id' => 100,
                'city_id' => 36,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            100 =>
            array (
                'id' => 101,
                'city_id' => 36,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            101 =>
            array (
                'id' => 102,
                'city_id' => 36,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            102 =>
            array (
                'id' => 103,
                'city_id' => 36,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            103 =>
            array (
                'id' => 104,
                'city_id' => 36,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            104 =>
            array (
                'id' => 105,
                'city_id' => 36,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            105 =>
            array (
                'id' => 106,
                'city_id' => 36,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            106 =>
            array (
                'id' => 107,
                'city_id' => 36,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            107 =>
            array (
                'id' => 108,
                'city_id' => 36,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            108 =>
            array (
                'id' => 109,
                'city_id' => 37,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            109 =>
            array (
                'id' => 110,
                'city_id' => 37,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            110 =>
            array (
                'id' => 111,
                'city_id' => 37,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            111 =>
            array (
                'id' => 112,
                'city_id' => 37,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            112 =>
            array (
                'id' => 113,
                'city_id' => 37,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            113 =>
            array (
                'id' => 114,
                'city_id' => 37,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            114 =>
            array (
                'id' => 115,
                'city_id' => 37,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            115 =>
            array (
                'id' => 116,
                'city_id' => 37,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            116 =>
            array (
                'id' => 117,
                'city_id' => 37,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            117 =>
            array (
                'id' => 118,
                'city_id' => 37,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            118 =>
            array (
                'id' => 119,
                'city_id' => 37,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            119 =>
            array (
                'id' => 120,
                'city_id' => 37,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            120 =>
            array (
                'id' => 121,
                'city_id' => 38,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            121 =>
            array (
                'id' => 122,
                'city_id' => 38,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            122 =>
            array (
                'id' => 123,
                'city_id' => 38,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            123 =>
            array (
                'id' => 124,
                'city_id' => 38,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            124 =>
            array (
                'id' => 125,
                'city_id' => 38,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            125 =>
            array (
                'id' => 126,
                'city_id' => 38,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            126 =>
            array (
                'id' => 127,
                'city_id' => 38,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            127 =>
            array (
                'id' => 128,
                'city_id' => 38,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            128 =>
            array (
                'id' => 129,
                'city_id' => 38,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            129 =>
            array (
                'id' => 130,
                'city_id' => 38,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            130 =>
            array (
                'id' => 131,
                'city_id' => 38,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            131 =>
            array (
                'id' => 132,
                'city_id' => 38,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            132 =>
            array (
                'id' => 133,
                'city_id' => 39,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            133 =>
            array (
                'id' => 134,
                'city_id' => 39,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            134 =>
            array (
                'id' => 135,
                'city_id' => 39,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            135 =>
            array (
                'id' => 136,
                'city_id' => 39,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            136 =>
            array (
                'id' => 137,
                'city_id' => 39,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            137 =>
            array (
                'id' => 138,
                'city_id' => 39,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            138 =>
            array (
                'id' => 139,
                'city_id' => 39,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            139 =>
            array (
                'id' => 140,
                'city_id' => 39,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            140 =>
            array (
                'id' => 141,
                'city_id' => 39,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            141 =>
            array (
                'id' => 142,
                'city_id' => 39,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            142 =>
            array (
                'id' => 143,
                'city_id' => 39,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            143 =>
            array (
                'id' => 144,
                'city_id' => 39,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            144 =>
            array (
                'id' => 145,
                'city_id' => 40,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            145 =>
            array (
                'id' => 146,
                'city_id' => 40,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            146 =>
            array (
                'id' => 147,
                'city_id' => 40,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            147 =>
            array (
                'id' => 148,
                'city_id' => 40,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            148 =>
            array (
                'id' => 149,
                'city_id' => 40,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            149 =>
            array (
                'id' => 150,
                'city_id' => 40,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            150 =>
            array (
                'id' => 151,
                'city_id' => 40,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            151 =>
            array (
                'id' => 152,
                'city_id' => 40,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            152 =>
            array (
                'id' => 153,
                'city_id' => 40,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            153 =>
            array (
                'id' => 154,
                'city_id' => 40,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            154 =>
            array (
                'id' => 155,
                'city_id' => 40,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            155 =>
            array (
                'id' => 156,
                'city_id' => 40,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            156 =>
            array (
                'id' => 157,
                'city_id' => 41,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            157 =>
            array (
                'id' => 158,
                'city_id' => 41,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            158 =>
            array (
                'id' => 159,
                'city_id' => 41,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            159 =>
            array (
                'id' => 160,
                'city_id' => 41,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            160 =>
            array (
                'id' => 161,
                'city_id' => 41,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            161 =>
            array (
                'id' => 162,
                'city_id' => 41,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            162 =>
            array (
                'id' => 163,
                'city_id' => 41,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            163 =>
            array (
                'id' => 164,
                'city_id' => 41,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            164 =>
            array (
                'id' => 165,
                'city_id' => 41,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            165 =>
            array (
                'id' => 166,
                'city_id' => 41,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            166 =>
            array (
                'id' => 167,
                'city_id' => 41,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            167 =>
            array (
                'id' => 168,
                'city_id' => 41,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            168 =>
            array (
                'id' => 169,
                'city_id' => 42,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            169 =>
            array (
                'id' => 170,
                'city_id' => 42,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            170 =>
            array (
                'id' => 171,
                'city_id' => 42,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            171 =>
            array (
                'id' => 172,
                'city_id' => 42,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            172 =>
            array (
                'id' => 173,
                'city_id' => 42,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            173 =>
            array (
                'id' => 174,
                'city_id' => 42,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            174 =>
            array (
                'id' => 175,
                'city_id' => 42,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            175 =>
            array (
                'id' => 176,
                'city_id' => 42,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            176 =>
            array (
                'id' => 177,
                'city_id' => 42,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            177 =>
            array (
                'id' => 178,
                'city_id' => 42,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            178 =>
            array (
                'id' => 179,
                'city_id' => 42,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            179 =>
            array (
                'id' => 180,
                'city_id' => 42,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            180 =>
            array (
                'id' => 181,
                'city_id' => 43,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            181 =>
            array (
                'id' => 182,
                'city_id' => 43,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            182 =>
            array (
                'id' => 183,
                'city_id' => 43,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            183 =>
            array (
                'id' => 184,
                'city_id' => 43,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            184 =>
            array (
                'id' => 185,
                'city_id' => 43,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            185 =>
            array (
                'id' => 186,
                'city_id' => 43,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            186 =>
            array (
                'id' => 187,
                'city_id' => 43,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            187 =>
            array (
                'id' => 188,
                'city_id' => 43,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            188 =>
            array (
                'id' => 189,
                'city_id' => 43,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            189 =>
            array (
                'id' => 190,
                'city_id' => 43,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            190 =>
            array (
                'id' => 191,
                'city_id' => 43,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            191 =>
            array (
                'id' => 192,
                'city_id' => 43,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            192 =>
            array (
                'id' => 193,
                'city_id' => 44,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            193 =>
            array (
                'id' => 194,
                'city_id' => 44,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            194 =>
            array (
                'id' => 195,
                'city_id' => 44,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            195 =>
            array (
                'id' => 196,
                'city_id' => 44,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            196 =>
            array (
                'id' => 197,
                'city_id' => 44,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            197 =>
            array (
                'id' => 198,
                'city_id' => 44,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            198 =>
            array (
                'id' => 199,
                'city_id' => 44,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            199 =>
            array (
                'id' => 200,
                'city_id' => 44,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            200 =>
            array (
                'id' => 201,
                'city_id' => 44,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            201 =>
            array (
                'id' => 202,
                'city_id' => 44,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            202 =>
            array (
                'id' => 203,
                'city_id' => 44,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            203 =>
            array (
                'id' => 204,
                'city_id' => 44,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            204 =>
            array (
                'id' => 205,
                'city_id' => 45,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            205 =>
            array (
                'id' => 206,
                'city_id' => 45,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            206 =>
            array (
                'id' => 207,
                'city_id' => 45,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            207 =>
            array (
                'id' => 208,
                'city_id' => 45,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            208 =>
            array (
                'id' => 209,
                'city_id' => 45,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            209 =>
            array (
                'id' => 210,
                'city_id' => 45,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            210 =>
            array (
                'id' => 211,
                'city_id' => 45,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            211 =>
            array (
                'id' => 212,
                'city_id' => 45,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            212 =>
            array (
                'id' => 213,
                'city_id' => 45,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            213 =>
            array (
                'id' => 214,
                'city_id' => 45,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            214 =>
            array (
                'id' => 215,
                'city_id' => 45,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            215 =>
            array (
                'id' => 216,
                'city_id' => 45,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            216 =>
            array (
                'id' => 217,
                'city_id' => 46,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            217 =>
            array (
                'id' => 218,
                'city_id' => 46,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            218 =>
            array (
                'id' => 219,
                'city_id' => 46,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            219 =>
            array (
                'id' => 220,
                'city_id' => 46,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            220 =>
            array (
                'id' => 221,
                'city_id' => 46,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            221 =>
            array (
                'id' => 222,
                'city_id' => 46,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            222 =>
            array (
                'id' => 223,
                'city_id' => 46,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            223 =>
            array (
                'id' => 224,
                'city_id' => 46,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            224 =>
            array (
                'id' => 225,
                'city_id' => 46,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            225 =>
            array (
                'id' => 226,
                'city_id' => 46,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            226 =>
            array (
                'id' => 227,
                'city_id' => 46,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            227 =>
            array (
                'id' => 228,
                'city_id' => 46,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            228 =>
            array (
                'id' => 229,
                'city_id' => 47,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            229 =>
            array (
                'id' => 230,
                'city_id' => 47,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            230 =>
            array (
                'id' => 231,
                'city_id' => 47,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            231 =>
            array (
                'id' => 232,
                'city_id' => 47,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            232 =>
            array (
                'id' => 233,
                'city_id' => 47,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            233 =>
            array (
                'id' => 234,
                'city_id' => 47,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            234 =>
            array (
                'id' => 235,
                'city_id' => 47,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            235 =>
            array (
                'id' => 236,
                'city_id' => 47,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            236 =>
            array (
                'id' => 237,
                'city_id' => 47,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            237 =>
            array (
                'id' => 238,
                'city_id' => 47,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            238 =>
            array (
                'id' => 239,
                'city_id' => 47,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            239 =>
            array (
                'id' => 240,
                'city_id' => 47,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            240 =>
            array (
                'id' => 241,
                'city_id' => 48,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            241 =>
            array (
                'id' => 242,
                'city_id' => 48,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            242 =>
            array (
                'id' => 243,
                'city_id' => 48,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            243 =>
            array (
                'id' => 244,
                'city_id' => 48,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            244 =>
            array (
                'id' => 245,
                'city_id' => 48,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            245 =>
            array (
                'id' => 246,
                'city_id' => 48,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            246 =>
            array (
                'id' => 247,
                'city_id' => 48,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            247 =>
            array (
                'id' => 248,
                'city_id' => 48,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            248 =>
            array (
                'id' => 249,
                'city_id' => 48,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            249 =>
            array (
                'id' => 250,
                'city_id' => 48,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            250 =>
            array (
                'id' => 251,
                'city_id' => 48,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            251 =>
            array (
                'id' => 252,
                'city_id' => 48,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            252 =>
            array (
                'id' => 253,
                'city_id' => 49,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            253 =>
            array (
                'id' => 254,
                'city_id' => 49,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            254 =>
            array (
                'id' => 255,
                'city_id' => 49,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            255 =>
            array (
                'id' => 256,
                'city_id' => 49,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            256 =>
            array (
                'id' => 257,
                'city_id' => 49,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            257 =>
            array (
                'id' => 258,
                'city_id' => 49,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            258 =>
            array (
                'id' => 259,
                'city_id' => 49,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            259 =>
            array (
                'id' => 260,
                'city_id' => 49,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            260 =>
            array (
                'id' => 261,
                'city_id' => 49,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            261 =>
            array (
                'id' => 262,
                'city_id' => 49,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            262 =>
            array (
                'id' => 263,
                'city_id' => 49,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            263 =>
            array (
                'id' => 264,
                'city_id' => 49,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            264 =>
            array (
                'id' => 265,
                'city_id' => 50,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            265 =>
            array (
                'id' => 266,
                'city_id' => 50,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            266 =>
            array (
                'id' => 267,
                'city_id' => 50,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            267 =>
            array (
                'id' => 268,
                'city_id' => 50,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            268 =>
            array (
                'id' => 269,
                'city_id' => 50,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            269 =>
            array (
                'id' => 270,
                'city_id' => 50,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            270 =>
            array (
                'id' => 271,
                'city_id' => 50,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            271 =>
            array (
                'id' => 272,
                'city_id' => 50,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            272 =>
            array (
                'id' => 273,
                'city_id' => 50,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            273 =>
            array (
                'id' => 274,
                'city_id' => 50,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            274 =>
            array (
                'id' => 275,
                'city_id' => 50,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            275 =>
            array (
                'id' => 276,
                'city_id' => 50,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            276 =>
            array (
                'id' => 277,
                'city_id' => 51,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            277 =>
            array (
                'id' => 278,
                'city_id' => 51,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            278 =>
            array (
                'id' => 279,
                'city_id' => 51,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            279 =>
            array (
                'id' => 280,
                'city_id' => 51,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            280 =>
            array (
                'id' => 281,
                'city_id' => 51,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            281 =>
            array (
                'id' => 282,
                'city_id' => 51,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            282 =>
            array (
                'id' => 283,
                'city_id' => 51,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            283 =>
            array (
                'id' => 284,
                'city_id' => 51,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            284 =>
            array (
                'id' => 285,
                'city_id' => 51,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            285 =>
            array (
                'id' => 286,
                'city_id' => 51,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            286 =>
            array (
                'id' => 287,
                'city_id' => 51,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            287 =>
            array (
                'id' => 288,
                'city_id' => 51,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            288 =>
            array (
                'id' => 289,
                'city_id' => 52,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            289 =>
            array (
                'id' => 290,
                'city_id' => 52,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            290 =>
            array (
                'id' => 291,
                'city_id' => 52,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            291 =>
            array (
                'id' => 292,
                'city_id' => 52,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            292 =>
            array (
                'id' => 293,
                'city_id' => 52,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            293 =>
            array (
                'id' => 294,
                'city_id' => 52,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            294 =>
            array (
                'id' => 295,
                'city_id' => 52,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            295 =>
            array (
                'id' => 296,
                'city_id' => 52,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            296 =>
            array (
                'id' => 297,
                'city_id' => 52,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            297 =>
            array (
                'id' => 298,
                'city_id' => 52,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            298 =>
            array (
                'id' => 299,
                'city_id' => 52,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            299 =>
            array (
                'id' => 300,
                'city_id' => 52,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            300 =>
            array (
                'id' => 301,
                'city_id' => 53,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            301 =>
            array (
                'id' => 302,
                'city_id' => 53,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            302 =>
            array (
                'id' => 303,
                'city_id' => 53,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            303 =>
            array (
                'id' => 304,
                'city_id' => 53,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            304 =>
            array (
                'id' => 305,
                'city_id' => 53,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            305 =>
            array (
                'id' => 306,
                'city_id' => 53,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            306 =>
            array (
                'id' => 307,
                'city_id' => 53,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            307 =>
            array (
                'id' => 308,
                'city_id' => 53,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            308 =>
            array (
                'id' => 309,
                'city_id' => 53,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            309 =>
            array (
                'id' => 310,
                'city_id' => 53,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            310 =>
            array (
                'id' => 311,
                'city_id' => 53,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            311 =>
            array (
                'id' => 312,
                'city_id' => 53,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            312 =>
            array (
                'id' => 313,
                'city_id' => 54,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            313 =>
            array (
                'id' => 314,
                'city_id' => 54,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            314 =>
            array (
                'id' => 315,
                'city_id' => 54,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            315 =>
            array (
                'id' => 316,
                'city_id' => 54,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            316 =>
            array (
                'id' => 317,
                'city_id' => 54,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            317 =>
            array (
                'id' => 318,
                'city_id' => 54,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            318 =>
            array (
                'id' => 319,
                'city_id' => 54,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            319 =>
            array (
                'id' => 320,
                'city_id' => 54,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            320 =>
            array (
                'id' => 321,
                'city_id' => 54,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            321 =>
            array (
                'id' => 322,
                'city_id' => 54,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            322 =>
            array (
                'id' => 323,
                'city_id' => 54,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            323 =>
            array (
                'id' => 324,
                'city_id' => 54,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            324 =>
            array (
                'id' => 325,
                'city_id' => 55,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            325 =>
            array (
                'id' => 326,
                'city_id' => 55,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            326 =>
            array (
                'id' => 327,
                'city_id' => 55,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            327 =>
            array (
                'id' => 328,
                'city_id' => 55,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            328 =>
            array (
                'id' => 329,
                'city_id' => 55,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            329 =>
            array (
                'id' => 330,
                'city_id' => 55,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            330 =>
            array (
                'id' => 331,
                'city_id' => 55,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            331 =>
            array (
                'id' => 332,
                'city_id' => 55,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            332 =>
            array (
                'id' => 333,
                'city_id' => 55,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            333 =>
            array (
                'id' => 334,
                'city_id' => 55,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            334 =>
            array (
                'id' => 335,
                'city_id' => 55,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            335 =>
            array (
                'id' => 336,
                'city_id' => 55,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            336 =>
            array (
                'id' => 337,
                'city_id' => 56,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            337 =>
            array (
                'id' => 338,
                'city_id' => 56,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            338 =>
            array (
                'id' => 339,
                'city_id' => 56,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            339 =>
            array (
                'id' => 340,
                'city_id' => 56,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            340 =>
            array (
                'id' => 341,
                'city_id' => 56,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            341 =>
            array (
                'id' => 342,
                'city_id' => 56,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            342 =>
            array (
                'id' => 343,
                'city_id' => 56,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            343 =>
            array (
                'id' => 344,
                'city_id' => 56,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            344 =>
            array (
                'id' => 345,
                'city_id' => 56,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            345 =>
            array (
                'id' => 346,
                'city_id' => 56,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            346 =>
            array (
                'id' => 347,
                'city_id' => 56,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            347 =>
            array (
                'id' => 348,
                'city_id' => 56,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            348 =>
            array (
                'id' => 349,
                'city_id' => 57,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            349 =>
            array (
                'id' => 350,
                'city_id' => 57,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            350 =>
            array (
                'id' => 351,
                'city_id' => 57,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            351 =>
            array (
                'id' => 352,
                'city_id' => 57,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            352 =>
            array (
                'id' => 353,
                'city_id' => 57,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            353 =>
            array (
                'id' => 354,
                'city_id' => 57,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            354 =>
            array (
                'id' => 355,
                'city_id' => 57,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            355 =>
            array (
                'id' => 356,
                'city_id' => 57,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            356 =>
            array (
                'id' => 357,
                'city_id' => 57,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            357 =>
            array (
                'id' => 358,
                'city_id' => 57,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            358 =>
            array (
                'id' => 359,
                'city_id' => 57,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            359 =>
            array (
                'id' => 360,
                'city_id' => 57,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            360 =>
            array (
                'id' => 361,
                'city_id' => 58,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            361 =>
            array (
                'id' => 362,
                'city_id' => 58,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            362 =>
            array (
                'id' => 363,
                'city_id' => 58,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            363 =>
            array (
                'id' => 364,
                'city_id' => 58,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            364 =>
            array (
                'id' => 365,
                'city_id' => 58,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            365 =>
            array (
                'id' => 366,
                'city_id' => 58,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            366 =>
            array (
                'id' => 367,
                'city_id' => 58,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            367 =>
            array (
                'id' => 368,
                'city_id' => 58,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            368 =>
            array (
                'id' => 369,
                'city_id' => 58,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            369 =>
            array (
                'id' => 370,
                'city_id' => 58,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            370 =>
            array (
                'id' => 371,
                'city_id' => 58,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            371 =>
            array (
                'id' => 372,
                'city_id' => 58,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            372 =>
            array (
                'id' => 373,
                'city_id' => 59,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            373 =>
            array (
                'id' => 374,
                'city_id' => 59,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            374 =>
            array (
                'id' => 375,
                'city_id' => 59,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            375 =>
            array (
                'id' => 376,
                'city_id' => 59,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            376 =>
            array (
                'id' => 377,
                'city_id' => 59,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            377 =>
            array (
                'id' => 378,
                'city_id' => 59,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            378 =>
            array (
                'id' => 379,
                'city_id' => 59,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            379 =>
            array (
                'id' => 380,
                'city_id' => 59,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            380 =>
            array (
                'id' => 381,
                'city_id' => 59,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            381 =>
            array (
                'id' => 382,
                'city_id' => 59,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            382 =>
            array (
                'id' => 383,
                'city_id' => 59,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            383 =>
            array (
                'id' => 384,
                'city_id' => 59,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            384 =>
            array (
                'id' => 385,
                'city_id' => 60,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            385 =>
            array (
                'id' => 386,
                'city_id' => 60,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            386 =>
            array (
                'id' => 387,
                'city_id' => 60,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            387 =>
            array (
                'id' => 388,
                'city_id' => 60,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            388 =>
            array (
                'id' => 389,
                'city_id' => 60,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            389 =>
            array (
                'id' => 390,
                'city_id' => 60,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            390 =>
            array (
                'id' => 391,
                'city_id' => 60,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            391 =>
            array (
                'id' => 392,
                'city_id' => 60,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            392 =>
            array (
                'id' => 393,
                'city_id' => 60,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            393 =>
            array (
                'id' => 394,
                'city_id' => 60,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            394 =>
            array (
                'id' => 395,
                'city_id' => 60,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            395 =>
            array (
                'id' => 396,
                'city_id' => 60,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            396 =>
            array (
                'id' => 397,
                'city_id' => 61,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            397 =>
            array (
                'id' => 398,
                'city_id' => 61,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            398 =>
            array (
                'id' => 399,
                'city_id' => 61,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            399 =>
            array (
                'id' => 400,
                'city_id' => 61,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            400 =>
            array (
                'id' => 401,
                'city_id' => 61,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            401 =>
            array (
                'id' => 402,
                'city_id' => 61,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            402 =>
            array (
                'id' => 403,
                'city_id' => 61,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            403 =>
            array (
                'id' => 404,
                'city_id' => 61,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            404 =>
            array (
                'id' => 405,
                'city_id' => 61,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            405 =>
            array (
                'id' => 406,
                'city_id' => 61,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            406 =>
            array (
                'id' => 407,
                'city_id' => 61,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            407 =>
            array (
                'id' => 408,
                'city_id' => 61,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            408 =>
            array (
                'id' => 409,
                'city_id' => 62,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            409 =>
            array (
                'id' => 410,
                'city_id' => 62,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            410 =>
            array (
                'id' => 411,
                'city_id' => 62,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            411 =>
            array (
                'id' => 412,
                'city_id' => 62,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            412 =>
            array (
                'id' => 413,
                'city_id' => 62,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            413 =>
            array (
                'id' => 414,
                'city_id' => 62,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            414 =>
            array (
                'id' => 415,
                'city_id' => 62,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            415 =>
            array (
                'id' => 416,
                'city_id' => 62,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            416 =>
            array (
                'id' => 417,
                'city_id' => 62,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            417 =>
            array (
                'id' => 418,
                'city_id' => 62,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            418 =>
            array (
                'id' => 419,
                'city_id' => 62,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            419 =>
            array (
                'id' => 420,
                'city_id' => 62,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            420 =>
            array (
                'id' => 421,
                'city_id' => 63,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            421 =>
            array (
                'id' => 422,
                'city_id' => 63,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            422 =>
            array (
                'id' => 423,
                'city_id' => 63,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            423 =>
            array (
                'id' => 424,
                'city_id' => 63,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            424 =>
            array (
                'id' => 425,
                'city_id' => 63,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            425 =>
            array (
                'id' => 426,
                'city_id' => 63,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            426 =>
            array (
                'id' => 427,
                'city_id' => 63,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            427 =>
            array (
                'id' => 428,
                'city_id' => 63,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            428 =>
            array (
                'id' => 429,
                'city_id' => 63,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            429 =>
            array (
                'id' => 430,
                'city_id' => 63,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            430 =>
            array (
                'id' => 431,
                'city_id' => 63,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            431 =>
            array (
                'id' => 432,
                'city_id' => 63,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            432 =>
            array (
                'id' => 433,
                'city_id' => 64,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            433 =>
            array (
                'id' => 434,
                'city_id' => 64,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            434 =>
            array (
                'id' => 435,
                'city_id' => 64,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            435 =>
            array (
                'id' => 436,
                'city_id' => 64,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            436 =>
            array (
                'id' => 437,
                'city_id' => 64,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            437 =>
            array (
                'id' => 438,
                'city_id' => 64,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            438 =>
            array (
                'id' => 439,
                'city_id' => 64,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            439 =>
            array (
                'id' => 440,
                'city_id' => 64,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            440 =>
            array (
                'id' => 441,
                'city_id' => 64,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            441 =>
            array (
                'id' => 442,
                'city_id' => 64,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            442 =>
            array (
                'id' => 443,
                'city_id' => 64,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            443 =>
            array (
                'id' => 444,
                'city_id' => 64,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            444 =>
            array (
                'id' => 445,
                'city_id' => 65,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            445 =>
            array (
                'id' => 446,
                'city_id' => 65,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            446 =>
            array (
                'id' => 447,
                'city_id' => 65,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            447 =>
            array (
                'id' => 448,
                'city_id' => 65,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            448 =>
            array (
                'id' => 449,
                'city_id' => 65,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            449 =>
            array (
                'id' => 450,
                'city_id' => 65,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            450 =>
            array (
                'id' => 451,
                'city_id' => 65,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            451 =>
            array (
                'id' => 452,
                'city_id' => 65,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            452 =>
            array (
                'id' => 453,
                'city_id' => 65,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            453 =>
            array (
                'id' => 454,
                'city_id' => 65,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            454 =>
            array (
                'id' => 455,
                'city_id' => 65,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            455 =>
            array (
                'id' => 456,
                'city_id' => 65,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            456 =>
            array (
                'id' => 457,
                'city_id' => 66,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            457 =>
            array (
                'id' => 458,
                'city_id' => 66,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            458 =>
            array (
                'id' => 459,
                'city_id' => 66,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            459 =>
            array (
                'id' => 460,
                'city_id' => 66,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            460 =>
            array (
                'id' => 461,
                'city_id' => 66,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            461 =>
            array (
                'id' => 462,
                'city_id' => 66,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            462 =>
            array (
                'id' => 463,
                'city_id' => 66,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            463 =>
            array (
                'id' => 464,
                'city_id' => 66,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            464 =>
            array (
                'id' => 465,
                'city_id' => 66,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            465 =>
            array (
                'id' => 466,
                'city_id' => 66,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            466 =>
            array (
                'id' => 467,
                'city_id' => 66,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            467 =>
            array (
                'id' => 468,
                'city_id' => 66,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            468 =>
            array (
                'id' => 469,
                'city_id' => 67,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            469 =>
            array (
                'id' => 470,
                'city_id' => 67,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            470 =>
            array (
                'id' => 471,
                'city_id' => 67,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            471 =>
            array (
                'id' => 472,
                'city_id' => 67,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            472 =>
            array (
                'id' => 473,
                'city_id' => 67,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            473 =>
            array (
                'id' => 474,
                'city_id' => 67,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            474 =>
            array (
                'id' => 475,
                'city_id' => 67,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            475 =>
            array (
                'id' => 476,
                'city_id' => 67,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            476 =>
            array (
                'id' => 477,
                'city_id' => 67,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            477 =>
            array (
                'id' => 478,
                'city_id' => 67,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            478 =>
            array (
                'id' => 479,
                'city_id' => 67,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            479 =>
            array (
                'id' => 480,
                'city_id' => 67,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            480 =>
            array (
                'id' => 481,
                'city_id' => 68,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            481 =>
            array (
                'id' => 482,
                'city_id' => 68,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            482 =>
            array (
                'id' => 483,
                'city_id' => 68,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            483 =>
            array (
                'id' => 484,
                'city_id' => 68,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            484 =>
            array (
                'id' => 485,
                'city_id' => 68,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            485 =>
            array (
                'id' => 486,
                'city_id' => 68,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            486 =>
            array (
                'id' => 487,
                'city_id' => 68,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            487 =>
            array (
                'id' => 488,
                'city_id' => 68,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            488 =>
            array (
                'id' => 489,
                'city_id' => 68,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            489 =>
            array (
                'id' => 490,
                'city_id' => 68,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            490 =>
            array (
                'id' => 491,
                'city_id' => 68,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            491 =>
            array (
                'id' => 492,
                'city_id' => 68,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            492 =>
            array (
                'id' => 493,
                'city_id' => 69,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            493 =>
            array (
                'id' => 494,
                'city_id' => 69,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            494 =>
            array (
                'id' => 495,
                'city_id' => 69,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            495 =>
            array (
                'id' => 496,
                'city_id' => 69,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            496 =>
            array (
                'id' => 497,
                'city_id' => 69,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            497 =>
            array (
                'id' => 498,
                'city_id' => 69,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            498 =>
            array (
                'id' => 499,
                'city_id' => 69,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            499 =>
            array (
                'id' => 500,
                'city_id' => 69,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
        ));
        \DB::table('actirovki_widget_weather_ranges')->insert(array (
            0 =>
            array (
                'id' => 501,
                'city_id' => 69,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            1 =>
            array (
                'id' => 502,
                'city_id' => 69,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            2 =>
            array (
                'id' => 503,
                'city_id' => 69,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            3 =>
            array (
                'id' => 504,
                'city_id' => 69,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            4 =>
            array (
                'id' => 505,
                'city_id' => 70,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            5 =>
            array (
                'id' => 506,
                'city_id' => 70,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            6 =>
            array (
                'id' => 507,
                'city_id' => 70,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            7 =>
            array (
                'id' => 508,
                'city_id' => 70,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            8 =>
            array (
                'id' => 509,
                'city_id' => 70,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            9 =>
            array (
                'id' => 510,
                'city_id' => 70,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            10 =>
            array (
                'id' => 511,
                'city_id' => 70,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            11 =>
            array (
                'id' => 512,
                'city_id' => 70,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            12 =>
            array (
                'id' => 513,
                'city_id' => 70,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            13 =>
            array (
                'id' => 514,
                'city_id' => 70,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            14 =>
            array (
                'id' => 515,
                'city_id' => 70,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            15 =>
            array (
                'id' => 516,
                'city_id' => 70,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            16 =>
            array (
                'id' => 517,
                'city_id' => 71,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            17 =>
            array (
                'id' => 518,
                'city_id' => 71,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            18 =>
            array (
                'id' => 519,
                'city_id' => 71,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            19 =>
            array (
                'id' => 520,
                'city_id' => 71,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            20 =>
            array (
                'id' => 521,
                'city_id' => 71,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            21 =>
            array (
                'id' => 522,
                'city_id' => 71,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            22 =>
            array (
                'id' => 523,
                'city_id' => 71,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            23 =>
            array (
                'id' => 524,
                'city_id' => 71,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            24 =>
            array (
                'id' => 525,
                'city_id' => 71,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            25 =>
            array (
                'id' => 526,
                'city_id' => 71,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            26 =>
            array (
                'id' => 527,
                'city_id' => 71,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            27 =>
            array (
                'id' => 528,
                'city_id' => 71,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            28 =>
            array (
                'id' => 529,
                'city_id' => 72,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            29 =>
            array (
                'id' => 530,
                'city_id' => 72,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            30 =>
            array (
                'id' => 531,
                'city_id' => 72,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            31 =>
            array (
                'id' => 532,
                'city_id' => 72,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            32 =>
            array (
                'id' => 533,
                'city_id' => 72,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            33 =>
            array (
                'id' => 534,
                'city_id' => 72,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            34 =>
            array (
                'id' => 535,
                'city_id' => 72,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            35 =>
            array (
                'id' => 536,
                'city_id' => 72,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            36 =>
            array (
                'id' => 537,
                'city_id' => 72,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            37 =>
            array (
                'id' => 538,
                'city_id' => 72,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            38 =>
            array (
                'id' => 539,
                'city_id' => 72,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            39 =>
            array (
                'id' => 540,
                'city_id' => 72,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            40 =>
            array (
                'id' => 541,
                'city_id' => 73,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            41 =>
            array (
                'id' => 542,
                'city_id' => 73,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            42 =>
            array (
                'id' => 543,
                'city_id' => 73,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            43 =>
            array (
                'id' => 544,
                'city_id' => 73,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            44 =>
            array (
                'id' => 545,
                'city_id' => 73,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            45 =>
            array (
                'id' => 546,
                'city_id' => 73,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            46 =>
            array (
                'id' => 547,
                'city_id' => 73,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            47 =>
            array (
                'id' => 548,
                'city_id' => 73,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            48 =>
            array (
                'id' => 549,
                'city_id' => 73,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            49 =>
            array (
                'id' => 550,
                'city_id' => 73,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            50 =>
            array (
                'id' => 551,
                'city_id' => 73,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            51 =>
            array (
                'id' => 552,
                'city_id' => 73,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            52 =>
            array (
                'id' => 553,
                'city_id' => 74,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            53 =>
            array (
                'id' => 554,
                'city_id' => 74,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            54 =>
            array (
                'id' => 555,
                'city_id' => 74,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            55 =>
            array (
                'id' => 556,
                'city_id' => 74,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            56 =>
            array (
                'id' => 557,
                'city_id' => 74,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            57 =>
            array (
                'id' => 558,
                'city_id' => 74,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            58 =>
            array (
                'id' => 559,
                'city_id' => 74,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            59 =>
            array (
                'id' => 560,
                'city_id' => 74,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            60 =>
            array (
                'id' => 561,
                'city_id' => 74,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            61 =>
            array (
                'id' => 562,
                'city_id' => 74,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            62 =>
            array (
                'id' => 563,
                'city_id' => 74,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            63 =>
            array (
                'id' => 564,
                'city_id' => 74,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            64 =>
            array (
                'id' => 565,
                'city_id' => 75,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            65 =>
            array (
                'id' => 566,
                'city_id' => 75,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            66 =>
            array (
                'id' => 567,
                'city_id' => 75,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            67 =>
            array (
                'id' => 568,
                'city_id' => 75,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            68 =>
            array (
                'id' => 569,
                'city_id' => 75,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            69 =>
            array (
                'id' => 570,
                'city_id' => 75,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            70 =>
            array (
                'id' => 571,
                'city_id' => 75,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            71 =>
            array (
                'id' => 572,
                'city_id' => 75,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            72 =>
            array (
                'id' => 573,
                'city_id' => 75,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            73 =>
            array (
                'id' => 574,
                'city_id' => 75,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            74 =>
            array (
                'id' => 575,
                'city_id' => 75,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            75 =>
            array (
                'id' => 576,
                'city_id' => 75,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            76 =>
            array (
                'id' => 577,
                'city_id' => 76,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            77 =>
            array (
                'id' => 578,
                'city_id' => 76,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            78 =>
            array (
                'id' => 579,
                'city_id' => 76,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            79 =>
            array (
                'id' => 580,
                'city_id' => 76,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            80 =>
            array (
                'id' => 581,
                'city_id' => 76,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            81 =>
            array (
                'id' => 582,
                'city_id' => 76,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            82 =>
            array (
                'id' => 583,
                'city_id' => 76,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            83 =>
            array (
                'id' => 584,
                'city_id' => 76,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            84 =>
            array (
                'id' => 585,
                'city_id' => 76,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            85 =>
            array (
                'id' => 586,
                'city_id' => 76,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            86 =>
            array (
                'id' => 587,
                'city_id' => 76,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            87 =>
            array (
                'id' => 588,
                'city_id' => 76,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            88 =>
            array (
                'id' => 589,
                'city_id' => 77,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            89 =>
            array (
                'id' => 590,
                'city_id' => 77,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            90 =>
            array (
                'id' => 591,
                'city_id' => 77,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            91 =>
            array (
                'id' => 592,
                'city_id' => 77,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            92 =>
            array (
                'id' => 593,
                'city_id' => 77,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            93 =>
            array (
                'id' => 594,
                'city_id' => 77,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            94 =>
            array (
                'id' => 595,
                'city_id' => 77,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            95 =>
            array (
                'id' => 596,
                'city_id' => 77,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            96 =>
            array (
                'id' => 597,
                'city_id' => 77,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            97 =>
            array (
                'id' => 598,
                'city_id' => 77,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            98 =>
            array (
                'id' => 599,
                'city_id' => 77,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            99 =>
            array (
                'id' => 600,
                'city_id' => 77,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            100 =>
            array (
                'id' => 601,
                'city_id' => 78,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            101 =>
            array (
                'id' => 602,
                'city_id' => 78,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            102 =>
            array (
                'id' => 603,
                'city_id' => 78,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            103 =>
            array (
                'id' => 604,
                'city_id' => 78,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            104 =>
            array (
                'id' => 605,
                'city_id' => 78,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            105 =>
            array (
                'id' => 606,
                'city_id' => 78,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            106 =>
            array (
                'id' => 607,
                'city_id' => 78,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            107 =>
            array (
                'id' => 608,
                'city_id' => 78,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            108 =>
            array (
                'id' => 609,
                'city_id' => 78,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            109 =>
            array (
                'id' => 610,
                'city_id' => 78,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            110 =>
            array (
                'id' => 611,
                'city_id' => 78,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            111 =>
            array (
                'id' => 612,
                'city_id' => 78,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            112 =>
            array (
                'id' => 613,
                'city_id' => 79,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            113 =>
            array (
                'id' => 614,
                'city_id' => 79,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            114 =>
            array (
                'id' => 615,
                'city_id' => 79,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            115 =>
            array (
                'id' => 616,
                'city_id' => 79,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            116 =>
            array (
                'id' => 617,
                'city_id' => 79,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            117 =>
            array (
                'id' => 618,
                'city_id' => 79,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            118 =>
            array (
                'id' => 619,
                'city_id' => 79,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            119 =>
            array (
                'id' => 620,
                'city_id' => 79,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            120 =>
            array (
                'id' => 621,
                'city_id' => 79,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            121 =>
            array (
                'id' => 622,
                'city_id' => 79,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            122 =>
            array (
                'id' => 623,
                'city_id' => 79,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            123 =>
            array (
                'id' => 624,
                'city_id' => 79,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            124 =>
            array (
                'id' => 625,
                'city_id' => 80,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            125 =>
            array (
                'id' => 626,
                'city_id' => 80,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            126 =>
            array (
                'id' => 627,
                'city_id' => 80,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            127 =>
            array (
                'id' => 628,
                'city_id' => 80,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            128 =>
            array (
                'id' => 629,
                'city_id' => 80,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            129 =>
            array (
                'id' => 630,
                'city_id' => 80,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            130 =>
            array (
                'id' => 631,
                'city_id' => 80,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            131 =>
            array (
                'id' => 632,
                'city_id' => 80,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            132 =>
            array (
                'id' => 633,
                'city_id' => 80,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            133 =>
            array (
                'id' => 634,
                'city_id' => 80,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            134 =>
            array (
                'id' => 635,
                'city_id' => 80,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            135 =>
            array (
                'id' => 636,
                'city_id' => 80,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            136 =>
            array (
                'id' => 637,
                'city_id' => 81,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            137 =>
            array (
                'id' => 638,
                'city_id' => 81,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            138 =>
            array (
                'id' => 639,
                'city_id' => 81,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            139 =>
            array (
                'id' => 640,
                'city_id' => 81,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            140 =>
            array (
                'id' => 641,
                'city_id' => 81,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            141 =>
            array (
                'id' => 642,
                'city_id' => 81,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            142 =>
            array (
                'id' => 643,
                'city_id' => 81,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            143 =>
            array (
                'id' => 644,
                'city_id' => 81,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            144 =>
            array (
                'id' => 645,
                'city_id' => 81,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            145 =>
            array (
                'id' => 646,
                'city_id' => 81,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            146 =>
            array (
                'id' => 647,
                'city_id' => 81,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            147 =>
            array (
                'id' => 648,
                'city_id' => 81,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            148 =>
            array (
                'id' => 649,
                'city_id' => 82,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            149 =>
            array (
                'id' => 650,
                'city_id' => 82,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            150 =>
            array (
                'id' => 651,
                'city_id' => 82,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            151 =>
            array (
                'id' => 652,
                'city_id' => 82,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            152 =>
            array (
                'id' => 653,
                'city_id' => 82,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            153 =>
            array (
                'id' => 654,
                'city_id' => 82,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            154 =>
            array (
                'id' => 655,
                'city_id' => 82,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            155 =>
            array (
                'id' => 656,
                'city_id' => 82,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            156 =>
            array (
                'id' => 657,
                'city_id' => 82,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            157 =>
            array (
                'id' => 658,
                'city_id' => 82,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            158 =>
            array (
                'id' => 659,
                'city_id' => 82,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            159 =>
            array (
                'id' => 660,
                'city_id' => 82,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            160 =>
            array (
                'id' => 661,
                'city_id' => 83,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            161 =>
            array (
                'id' => 662,
                'city_id' => 83,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            162 =>
            array (
                'id' => 663,
                'city_id' => 83,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            163 =>
            array (
                'id' => 664,
                'city_id' => 83,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            164 =>
            array (
                'id' => 665,
                'city_id' => 83,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            165 =>
            array (
                'id' => 666,
                'city_id' => 83,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            166 =>
            array (
                'id' => 667,
                'city_id' => 83,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            167 =>
            array (
                'id' => 668,
                'city_id' => 83,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            168 =>
            array (
                'id' => 669,
                'city_id' => 83,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            169 =>
            array (
                'id' => 670,
                'city_id' => 83,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            170 =>
            array (
                'id' => 671,
                'city_id' => 83,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            171 =>
            array (
                'id' => 672,
                'city_id' => 83,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            172 =>
            array (
                'id' => 673,
                'city_id' => 84,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            173 =>
            array (
                'id' => 674,
                'city_id' => 84,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            174 =>
            array (
                'id' => 675,
                'city_id' => 84,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            175 =>
            array (
                'id' => 676,
                'city_id' => 84,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            176 =>
            array (
                'id' => 677,
                'city_id' => 84,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            177 =>
            array (
                'id' => 678,
                'city_id' => 84,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            178 =>
            array (
                'id' => 679,
                'city_id' => 84,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            179 =>
            array (
                'id' => 680,
                'city_id' => 84,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            180 =>
            array (
                'id' => 681,
                'city_id' => 84,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            181 =>
            array (
                'id' => 682,
                'city_id' => 84,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            182 =>
            array (
                'id' => 683,
                'city_id' => 84,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            183 =>
            array (
                'id' => 684,
                'city_id' => 84,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            184 =>
            array (
                'id' => 685,
                'city_id' => 85,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            185 =>
            array (
                'id' => 686,
                'city_id' => 85,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            186 =>
            array (
                'id' => 687,
                'city_id' => 85,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            187 =>
            array (
                'id' => 688,
                'city_id' => 85,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            188 =>
            array (
                'id' => 689,
                'city_id' => 85,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            189 =>
            array (
                'id' => 690,
                'city_id' => 85,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            190 =>
            array (
                'id' => 691,
                'city_id' => 85,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            191 =>
            array (
                'id' => 692,
                'city_id' => 85,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            192 =>
            array (
                'id' => 693,
                'city_id' => 85,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            193 =>
            array (
                'id' => 694,
                'city_id' => 85,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            194 =>
            array (
                'id' => 695,
                'city_id' => 85,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            195 =>
            array (
                'id' => 696,
                'city_id' => 85,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            196 =>
            array (
                'id' => 697,
                'city_id' => 86,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            197 =>
            array (
                'id' => 698,
                'city_id' => 86,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            198 =>
            array (
                'id' => 699,
                'city_id' => 86,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            199 =>
            array (
                'id' => 700,
                'city_id' => 86,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            200 =>
            array (
                'id' => 701,
                'city_id' => 86,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            201 =>
            array (
                'id' => 702,
                'city_id' => 86,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            202 =>
            array (
                'id' => 703,
                'city_id' => 86,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            203 =>
            array (
                'id' => 704,
                'city_id' => 86,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            204 =>
            array (
                'id' => 705,
                'city_id' => 86,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            205 =>
            array (
                'id' => 706,
                'city_id' => 86,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            206 =>
            array (
                'id' => 707,
                'city_id' => 86,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            207 =>
            array (
                'id' => 708,
                'city_id' => 86,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            208 =>
            array (
                'id' => 709,
                'city_id' => 87,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            209 =>
            array (
                'id' => 710,
                'city_id' => 87,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            210 =>
            array (
                'id' => 711,
                'city_id' => 87,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            211 =>
            array (
                'id' => 712,
                'city_id' => 87,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            212 =>
            array (
                'id' => 713,
                'city_id' => 87,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            213 =>
            array (
                'id' => 714,
                'city_id' => 87,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            214 =>
            array (
                'id' => 715,
                'city_id' => 87,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            215 =>
            array (
                'id' => 716,
                'city_id' => 87,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            216 =>
            array (
                'id' => 717,
                'city_id' => 87,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            217 =>
            array (
                'id' => 718,
                'city_id' => 87,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            218 =>
            array (
                'id' => 719,
                'city_id' => 87,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            219 =>
            array (
                'id' => 720,
                'city_id' => 87,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            220 =>
            array (
                'id' => 721,
                'city_id' => 88,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            221 =>
            array (
                'id' => 722,
                'city_id' => 88,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            222 =>
            array (
                'id' => 723,
                'city_id' => 88,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            223 =>
            array (
                'id' => 724,
                'city_id' => 88,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            224 =>
            array (
                'id' => 725,
                'city_id' => 88,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            225 =>
            array (
                'id' => 726,
                'city_id' => 88,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            226 =>
            array (
                'id' => 727,
                'city_id' => 88,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            227 =>
            array (
                'id' => 728,
                'city_id' => 88,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            228 =>
            array (
                'id' => 729,
                'city_id' => 88,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            229 =>
            array (
                'id' => 730,
                'city_id' => 88,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            230 =>
            array (
                'id' => 731,
                'city_id' => 88,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            231 =>
            array (
                'id' => 732,
                'city_id' => 88,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            232 =>
            array (
                'id' => 733,
                'city_id' => 89,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            233 =>
            array (
                'id' => 734,
                'city_id' => 89,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            234 =>
            array (
                'id' => 735,
                'city_id' => 89,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            235 =>
            array (
                'id' => 736,
                'city_id' => 89,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            236 =>
            array (
                'id' => 737,
                'city_id' => 89,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            237 =>
            array (
                'id' => 738,
                'city_id' => 89,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            238 =>
            array (
                'id' => 739,
                'city_id' => 89,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            239 =>
            array (
                'id' => 740,
                'city_id' => 89,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            240 =>
            array (
                'id' => 741,
                'city_id' => 89,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            241 =>
            array (
                'id' => 742,
                'city_id' => 89,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            242 =>
            array (
                'id' => 743,
                'city_id' => 89,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            243 =>
            array (
                'id' => 744,
                'city_id' => 89,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            244 =>
            array (
                'id' => 745,
                'city_id' => 90,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            245 =>
            array (
                'id' => 746,
                'city_id' => 90,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            246 =>
            array (
                'id' => 747,
                'city_id' => 90,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            247 =>
            array (
                'id' => 748,
                'city_id' => 90,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            248 =>
            array (
                'id' => 749,
                'city_id' => 90,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            249 =>
            array (
                'id' => 750,
                'city_id' => 90,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            250 =>
            array (
                'id' => 751,
                'city_id' => 90,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            251 =>
            array (
                'id' => 752,
                'city_id' => 90,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            252 =>
            array (
                'id' => 753,
                'city_id' => 90,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            253 =>
            array (
                'id' => 754,
                'city_id' => 90,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            254 =>
            array (
                'id' => 755,
                'city_id' => 90,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            255 =>
            array (
                'id' => 756,
                'city_id' => 90,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            256 =>
            array (
                'id' => 757,
                'city_id' => 91,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            257 =>
            array (
                'id' => 758,
                'city_id' => 91,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            258 =>
            array (
                'id' => 759,
                'city_id' => 91,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            259 =>
            array (
                'id' => 760,
                'city_id' => 91,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            260 =>
            array (
                'id' => 761,
                'city_id' => 91,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            261 =>
            array (
                'id' => 762,
                'city_id' => 91,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            262 =>
            array (
                'id' => 763,
                'city_id' => 91,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            263 =>
            array (
                'id' => 764,
                'city_id' => 91,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            264 =>
            array (
                'id' => 765,
                'city_id' => 91,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            265 =>
            array (
                'id' => 766,
                'city_id' => 91,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            266 =>
            array (
                'id' => 767,
                'city_id' => 91,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            267 =>
            array (
                'id' => 768,
                'city_id' => 91,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            268 =>
            array (
                'id' => 769,
                'city_id' => 92,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            269 =>
            array (
                'id' => 770,
                'city_id' => 92,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            270 =>
            array (
                'id' => 771,
                'city_id' => 92,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            271 =>
            array (
                'id' => 772,
                'city_id' => 92,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            272 =>
            array (
                'id' => 773,
                'city_id' => 92,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            273 =>
            array (
                'id' => 774,
                'city_id' => 92,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            274 =>
            array (
                'id' => 775,
                'city_id' => 92,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            275 =>
            array (
                'id' => 776,
                'city_id' => 92,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            276 =>
            array (
                'id' => 777,
                'city_id' => 92,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            277 =>
            array (
                'id' => 778,
                'city_id' => 92,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            278 =>
            array (
                'id' => 779,
                'city_id' => 92,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            279 =>
            array (
                'id' => 780,
                'city_id' => 92,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            280 =>
            array (
                'id' => 781,
                'city_id' => 93,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            281 =>
            array (
                'id' => 782,
                'city_id' => 93,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            282 =>
            array (
                'id' => 783,
                'city_id' => 93,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            283 =>
            array (
                'id' => 784,
                'city_id' => 93,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            284 =>
            array (
                'id' => 785,
                'city_id' => 93,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            285 =>
            array (
                'id' => 786,
                'city_id' => 93,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            286 =>
            array (
                'id' => 787,
                'city_id' => 93,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            287 =>
            array (
                'id' => 788,
                'city_id' => 93,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            288 =>
            array (
                'id' => 789,
                'city_id' => 93,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            289 =>
            array (
                'id' => 790,
                'city_id' => 93,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            290 =>
            array (
                'id' => 791,
                'city_id' => 93,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            291 =>
            array (
                'id' => 792,
                'city_id' => 93,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            292 =>
            array (
                'id' => 793,
                'city_id' => 94,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            293 =>
            array (
                'id' => 794,
                'city_id' => 94,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            294 =>
            array (
                'id' => 795,
                'city_id' => 94,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            295 =>
            array (
                'id' => 796,
                'city_id' => 94,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            296 =>
            array (
                'id' => 797,
                'city_id' => 94,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            297 =>
            array (
                'id' => 798,
                'city_id' => 94,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            298 =>
            array (
                'id' => 799,
                'city_id' => 94,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            299 =>
            array (
                'id' => 800,
                'city_id' => 94,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            300 =>
            array (
                'id' => 801,
                'city_id' => 94,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            301 =>
            array (
                'id' => 802,
                'city_id' => 94,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            302 =>
            array (
                'id' => 803,
                'city_id' => 94,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            303 =>
            array (
                'id' => 804,
                'city_id' => 94,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            304 =>
            array (
                'id' => 805,
                'city_id' => 95,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            305 =>
            array (
                'id' => 806,
                'city_id' => 95,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            306 =>
            array (
                'id' => 807,
                'city_id' => 95,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            307 =>
            array (
                'id' => 808,
                'city_id' => 95,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            308 =>
            array (
                'id' => 809,
                'city_id' => 95,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            309 =>
            array (
                'id' => 810,
                'city_id' => 95,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            310 =>
            array (
                'id' => 811,
                'city_id' => 95,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            311 =>
            array (
                'id' => 812,
                'city_id' => 95,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            312 =>
            array (
                'id' => 813,
                'city_id' => 95,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            313 =>
            array (
                'id' => 814,
                'city_id' => 95,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            314 =>
            array (
                'id' => 815,
                'city_id' => 95,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            315 =>
            array (
                'id' => 816,
                'city_id' => 95,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            316 =>
            array (
                'id' => 817,
                'city_id' => 96,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            317 =>
            array (
                'id' => 818,
                'city_id' => 96,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            318 =>
            array (
                'id' => 819,
                'city_id' => 96,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            319 =>
            array (
                'id' => 820,
                'city_id' => 96,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            320 =>
            array (
                'id' => 821,
                'city_id' => 96,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            321 =>
            array (
                'id' => 822,
                'city_id' => 96,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            322 =>
            array (
                'id' => 823,
                'city_id' => 96,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            323 =>
            array (
                'id' => 824,
                'city_id' => 96,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            324 =>
            array (
                'id' => 825,
                'city_id' => 96,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            325 =>
            array (
                'id' => 826,
                'city_id' => 96,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            326 =>
            array (
                'id' => 827,
                'city_id' => 96,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            327 =>
            array (
                'id' => 828,
                'city_id' => 96,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            328 =>
            array (
                'id' => 829,
                'city_id' => 97,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            329 =>
            array (
                'id' => 830,
                'city_id' => 97,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            330 =>
            array (
                'id' => 831,
                'city_id' => 97,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            331 =>
            array (
                'id' => 832,
                'city_id' => 97,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            332 =>
            array (
                'id' => 833,
                'city_id' => 97,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            333 =>
            array (
                'id' => 834,
                'city_id' => 97,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            334 =>
            array (
                'id' => 835,
                'city_id' => 97,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            335 =>
            array (
                'id' => 836,
                'city_id' => 97,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            336 =>
            array (
                'id' => 837,
                'city_id' => 97,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            337 =>
            array (
                'id' => 838,
                'city_id' => 97,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            338 =>
            array (
                'id' => 839,
                'city_id' => 97,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            339 =>
            array (
                'id' => 840,
                'city_id' => 97,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            340 =>
            array (
                'id' => 841,
                'city_id' => 98,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            341 =>
            array (
                'id' => 842,
                'city_id' => 98,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            342 =>
            array (
                'id' => 843,
                'city_id' => 98,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            343 =>
            array (
                'id' => 844,
                'city_id' => 98,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            344 =>
            array (
                'id' => 845,
                'city_id' => 98,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            345 =>
            array (
                'id' => 846,
                'city_id' => 98,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            346 =>
            array (
                'id' => 847,
                'city_id' => 98,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            347 =>
            array (
                'id' => 848,
                'city_id' => 98,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            348 =>
            array (
                'id' => 849,
                'city_id' => 98,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            349 =>
            array (
                'id' => 850,
                'city_id' => 98,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            350 =>
            array (
                'id' => 851,
                'city_id' => 98,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            351 =>
            array (
                'id' => 852,
                'city_id' => 98,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            352 =>
            array (
                'id' => 853,
                'city_id' => 99,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            353 =>
            array (
                'id' => 854,
                'city_id' => 99,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            354 =>
            array (
                'id' => 855,
                'city_id' => 99,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            355 =>
            array (
                'id' => 856,
                'city_id' => 99,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            356 =>
            array (
                'id' => 857,
                'city_id' => 99,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            357 =>
            array (
                'id' => 858,
                'city_id' => 99,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            358 =>
            array (
                'id' => 859,
                'city_id' => 99,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            359 =>
            array (
                'id' => 860,
                'city_id' => 99,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            360 =>
            array (
                'id' => 861,
                'city_id' => 99,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            361 =>
            array (
                'id' => 862,
                'city_id' => 99,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            362 =>
            array (
                'id' => 863,
                'city_id' => 99,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            363 =>
            array (
                'id' => 864,
                'city_id' => 99,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            364 =>
            array (
                'id' => 865,
                'city_id' => 100,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            365 =>
            array (
                'id' => 866,
                'city_id' => 100,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            366 =>
            array (
                'id' => 867,
                'city_id' => 100,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            367 =>
            array (
                'id' => 868,
                'city_id' => 100,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            368 =>
            array (
                'id' => 869,
                'city_id' => 100,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            369 =>
            array (
                'id' => 870,
                'city_id' => 100,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            370 =>
            array (
                'id' => 871,
                'city_id' => 100,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            371 =>
            array (
                'id' => 872,
                'city_id' => 100,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            372 =>
            array (
                'id' => 873,
                'city_id' => 100,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            373 =>
            array (
                'id' => 874,
                'city_id' => 100,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            374 =>
            array (
                'id' => 875,
                'city_id' => 100,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            375 =>
            array (
                'id' => 876,
                'city_id' => 100,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            376 =>
            array (
                'id' => 877,
                'city_id' => 101,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            377 =>
            array (
                'id' => 878,
                'city_id' => 101,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            378 =>
            array (
                'id' => 879,
                'city_id' => 101,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            379 =>
            array (
                'id' => 880,
                'city_id' => 101,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            380 =>
            array (
                'id' => 881,
                'city_id' => 101,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            381 =>
            array (
                'id' => 882,
                'city_id' => 101,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            382 =>
            array (
                'id' => 883,
                'city_id' => 101,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            383 =>
            array (
                'id' => 884,
                'city_id' => 101,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            384 =>
            array (
                'id' => 885,
                'city_id' => 101,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            385 =>
            array (
                'id' => 886,
                'city_id' => 101,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            386 =>
            array (
                'id' => 887,
                'city_id' => 101,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            387 =>
            array (
                'id' => 888,
                'city_id' => 101,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            388 =>
            array (
                'id' => 889,
                'city_id' => 102,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            389 =>
            array (
                'id' => 890,
                'city_id' => 102,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            390 =>
            array (
                'id' => 891,
                'city_id' => 102,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            391 =>
            array (
                'id' => 892,
                'city_id' => 102,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            392 =>
            array (
                'id' => 893,
                'city_id' => 102,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            393 =>
            array (
                'id' => 894,
                'city_id' => 102,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            394 =>
            array (
                'id' => 895,
                'city_id' => 102,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            395 =>
            array (
                'id' => 896,
                'city_id' => 102,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            396 =>
            array (
                'id' => 897,
                'city_id' => 102,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            397 =>
            array (
                'id' => 898,
                'city_id' => 102,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            398 =>
            array (
                'id' => 899,
                'city_id' => 102,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            399 =>
            array (
                'id' => 900,
                'city_id' => 102,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            400 =>
            array (
                'id' => 901,
                'city_id' => 103,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            401 =>
            array (
                'id' => 902,
                'city_id' => 103,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            402 =>
            array (
                'id' => 903,
                'city_id' => 103,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            403 =>
            array (
                'id' => 904,
                'city_id' => 103,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            404 =>
            array (
                'id' => 905,
                'city_id' => 103,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            405 =>
            array (
                'id' => 906,
                'city_id' => 103,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            406 =>
            array (
                'id' => 907,
                'city_id' => 103,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            407 =>
            array (
                'id' => 908,
                'city_id' => 103,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            408 =>
            array (
                'id' => 909,
                'city_id' => 103,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            409 =>
            array (
                'id' => 910,
                'city_id' => 103,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            410 =>
            array (
                'id' => 911,
                'city_id' => 103,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            411 =>
            array (
                'id' => 912,
                'city_id' => 103,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            412 =>
            array (
                'id' => 913,
                'city_id' => 104,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            413 =>
            array (
                'id' => 914,
                'city_id' => 104,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            414 =>
            array (
                'id' => 915,
                'city_id' => 104,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            415 =>
            array (
                'id' => 916,
                'city_id' => 104,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            416 =>
            array (
                'id' => 917,
                'city_id' => 104,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            417 =>
            array (
                'id' => 918,
                'city_id' => 104,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            418 =>
            array (
                'id' => 919,
                'city_id' => 104,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            419 =>
            array (
                'id' => 920,
                'city_id' => 104,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            420 =>
            array (
                'id' => 921,
                'city_id' => 104,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            421 =>
            array (
                'id' => 922,
                'city_id' => 104,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            422 =>
            array (
                'id' => 923,
                'city_id' => 104,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            423 =>
            array (
                'id' => 924,
                'city_id' => 104,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            424 =>
            array (
                'id' => 925,
                'city_id' => 105,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            425 =>
            array (
                'id' => 926,
                'city_id' => 105,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            426 =>
            array (
                'id' => 927,
                'city_id' => 105,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            427 =>
            array (
                'id' => 928,
                'city_id' => 105,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            428 =>
            array (
                'id' => 929,
                'city_id' => 105,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            429 =>
            array (
                'id' => 930,
                'city_id' => 105,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            430 =>
            array (
                'id' => 931,
                'city_id' => 105,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            431 =>
            array (
                'id' => 932,
                'city_id' => 105,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            432 =>
            array (
                'id' => 933,
                'city_id' => 105,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            433 =>
            array (
                'id' => 934,
                'city_id' => 105,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            434 =>
            array (
                'id' => 935,
                'city_id' => 105,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            435 =>
            array (
                'id' => 936,
                'city_id' => 105,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            436 =>
            array (
                'id' => 937,
                'city_id' => 106,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            437 =>
            array (
                'id' => 938,
                'city_id' => 106,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            438 =>
            array (
                'id' => 939,
                'city_id' => 106,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            439 =>
            array (
                'id' => 940,
                'city_id' => 106,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            440 =>
            array (
                'id' => 941,
                'city_id' => 106,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            441 =>
            array (
                'id' => 942,
                'city_id' => 106,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            442 =>
            array (
                'id' => 943,
                'city_id' => 106,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            443 =>
            array (
                'id' => 944,
                'city_id' => 106,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            444 =>
            array (
                'id' => 945,
                'city_id' => 106,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            445 =>
            array (
                'id' => 946,
                'city_id' => 106,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            446 =>
            array (
                'id' => 947,
                'city_id' => 106,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            447 =>
            array (
                'id' => 948,
                'city_id' => 106,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            448 =>
            array (
                'id' => 949,
                'city_id' => 107,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            449 =>
            array (
                'id' => 950,
                'city_id' => 107,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            450 =>
            array (
                'id' => 951,
                'city_id' => 107,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            451 =>
            array (
                'id' => 952,
                'city_id' => 107,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            452 =>
            array (
                'id' => 953,
                'city_id' => 107,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            453 =>
            array (
                'id' => 954,
                'city_id' => 107,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            454 =>
            array (
                'id' => 955,
                'city_id' => 107,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            455 =>
            array (
                'id' => 956,
                'city_id' => 107,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            456 =>
            array (
                'id' => 957,
                'city_id' => 107,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            457 =>
            array (
                'id' => 958,
                'city_id' => 107,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            458 =>
            array (
                'id' => 959,
                'city_id' => 107,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            459 =>
            array (
                'id' => 960,
                'city_id' => 107,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            460 =>
            array (
                'id' => 961,
                'city_id' => 108,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            461 =>
            array (
                'id' => 962,
                'city_id' => 108,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            462 =>
            array (
                'id' => 963,
                'city_id' => 108,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            463 =>
            array (
                'id' => 964,
                'city_id' => 108,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            464 =>
            array (
                'id' => 965,
                'city_id' => 108,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            465 =>
            array (
                'id' => 966,
                'city_id' => 108,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            466 =>
            array (
                'id' => 967,
                'city_id' => 108,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            467 =>
            array (
                'id' => 968,
                'city_id' => 108,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            468 =>
            array (
                'id' => 969,
                'city_id' => 108,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            469 =>
            array (
                'id' => 970,
                'city_id' => 108,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            470 =>
            array (
                'id' => 971,
                'city_id' => 108,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            471 =>
            array (
                'id' => 972,
                'city_id' => 108,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            472 =>
            array (
                'id' => 973,
                'city_id' => 109,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            473 =>
            array (
                'id' => 974,
                'city_id' => 109,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            474 =>
            array (
                'id' => 975,
                'city_id' => 109,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            475 =>
            array (
                'id' => 976,
                'city_id' => 109,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            476 =>
            array (
                'id' => 977,
                'city_id' => 109,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            477 =>
            array (
                'id' => 978,
                'city_id' => 109,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            478 =>
            array (
                'id' => 979,
                'city_id' => 109,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            479 =>
            array (
                'id' => 980,
                'city_id' => 109,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            480 =>
            array (
                'id' => 981,
                'city_id' => 109,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            481 =>
            array (
                'id' => 982,
                'city_id' => 109,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            482 =>
            array (
                'id' => 983,
                'city_id' => 109,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            483 =>
            array (
                'id' => 984,
                'city_id' => 109,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            484 =>
            array (
                'id' => 985,
                'city_id' => 110,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            485 =>
            array (
                'id' => 986,
                'city_id' => 110,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            486 =>
            array (
                'id' => 987,
                'city_id' => 110,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            487 =>
            array (
                'id' => 988,
                'city_id' => 110,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            488 =>
            array (
                'id' => 989,
                'city_id' => 110,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            489 =>
            array (
                'id' => 990,
                'city_id' => 110,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            490 =>
            array (
                'id' => 991,
                'city_id' => 110,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            491 =>
            array (
                'id' => 992,
                'city_id' => 110,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            492 =>
            array (
                'id' => 993,
                'city_id' => 110,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            493 =>
            array (
                'id' => 994,
                'city_id' => 110,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            494 =>
            array (
                'id' => 995,
                'city_id' => 110,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            495 =>
            array (
                'id' => 996,
                'city_id' => 110,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            496 =>
            array (
                'id' => 997,
                'city_id' => 111,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            497 =>
            array (
                'id' => 998,
                'city_id' => 111,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            498 =>
            array (
                'id' => 999,
                'city_id' => 111,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            499 =>
            array (
                'id' => 1000,
                'city_id' => 111,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
        ));
        \DB::table('actirovki_widget_weather_ranges')->insert(array (
            0 =>
            array (
                'id' => 1001,
                'city_id' => 111,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            1 =>
            array (
                'id' => 1002,
                'city_id' => 111,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            2 =>
            array (
                'id' => 1003,
                'city_id' => 111,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            3 =>
            array (
                'id' => 1004,
                'city_id' => 111,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            4 =>
            array (
                'id' => 1005,
                'city_id' => 111,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            5 =>
            array (
                'id' => 1006,
                'city_id' => 111,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            6 =>
            array (
                'id' => 1007,
                'city_id' => 111,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            7 =>
            array (
                'id' => 1008,
                'city_id' => 111,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            8 =>
            array (
                'id' => 1009,
                'city_id' => 112,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            9 =>
            array (
                'id' => 1010,
                'city_id' => 112,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            10 =>
            array (
                'id' => 1011,
                'city_id' => 112,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            11 =>
            array (
                'id' => 1012,
                'city_id' => 112,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            12 =>
            array (
                'id' => 1013,
                'city_id' => 112,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            13 =>
            array (
                'id' => 1014,
                'city_id' => 112,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            14 =>
            array (
                'id' => 1015,
                'city_id' => 112,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            15 =>
            array (
                'id' => 1016,
                'city_id' => 112,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            16 =>
            array (
                'id' => 1017,
                'city_id' => 112,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            17 =>
            array (
                'id' => 1018,
                'city_id' => 112,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            18 =>
            array (
                'id' => 1019,
                'city_id' => 112,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            19 =>
            array (
                'id' => 1020,
                'city_id' => 112,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            20 =>
            array (
                'id' => 1021,
                'city_id' => 113,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            21 =>
            array (
                'id' => 1022,
                'city_id' => 113,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            22 =>
            array (
                'id' => 1023,
                'city_id' => 113,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            23 =>
            array (
                'id' => 1024,
                'city_id' => 113,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            24 =>
            array (
                'id' => 1025,
                'city_id' => 113,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            25 =>
            array (
                'id' => 1026,
                'city_id' => 113,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            26 =>
            array (
                'id' => 1027,
                'city_id' => 113,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            27 =>
            array (
                'id' => 1028,
                'city_id' => 113,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            28 =>
            array (
                'id' => 1029,
                'city_id' => 113,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            29 =>
            array (
                'id' => 1030,
                'city_id' => 113,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            30 =>
            array (
                'id' => 1031,
                'city_id' => 113,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            31 =>
            array (
                'id' => 1032,
                'city_id' => 113,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            32 =>
            array (
                'id' => 1033,
                'city_id' => 114,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            33 =>
            array (
                'id' => 1034,
                'city_id' => 114,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            34 =>
            array (
                'id' => 1035,
                'city_id' => 114,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            35 =>
            array (
                'id' => 1036,
                'city_id' => 114,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            36 =>
            array (
                'id' => 1037,
                'city_id' => 114,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            37 =>
            array (
                'id' => 1038,
                'city_id' => 114,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            38 =>
            array (
                'id' => 1039,
                'city_id' => 114,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            39 =>
            array (
                'id' => 1040,
                'city_id' => 114,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            40 =>
            array (
                'id' => 1041,
                'city_id' => 114,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            41 =>
            array (
                'id' => 1042,
                'city_id' => 114,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            42 =>
            array (
                'id' => 1043,
                'city_id' => 114,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            43 =>
            array (
                'id' => 1044,
                'city_id' => 114,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            44 =>
            array (
                'id' => 1045,
                'city_id' => 115,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            45 =>
            array (
                'id' => 1046,
                'city_id' => 115,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            46 =>
            array (
                'id' => 1047,
                'city_id' => 115,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            47 =>
            array (
                'id' => 1048,
                'city_id' => 115,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            48 =>
            array (
                'id' => 1049,
                'city_id' => 115,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            49 =>
            array (
                'id' => 1050,
                'city_id' => 115,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            50 =>
            array (
                'id' => 1051,
                'city_id' => 115,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            51 =>
            array (
                'id' => 1052,
                'city_id' => 115,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            52 =>
            array (
                'id' => 1053,
                'city_id' => 115,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            53 =>
            array (
                'id' => 1054,
                'city_id' => 115,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            54 =>
            array (
                'id' => 1055,
                'city_id' => 115,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            55 =>
            array (
                'id' => 1056,
                'city_id' => 115,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            56 =>
            array (
                'id' => 1057,
                'city_id' => 116,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            57 =>
            array (
                'id' => 1058,
                'city_id' => 116,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            58 =>
            array (
                'id' => 1059,
                'city_id' => 116,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            59 =>
            array (
                'id' => 1060,
                'city_id' => 116,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            60 =>
            array (
                'id' => 1061,
                'city_id' => 116,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            61 =>
            array (
                'id' => 1062,
                'city_id' => 116,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            62 =>
            array (
                'id' => 1063,
                'city_id' => 116,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            63 =>
            array (
                'id' => 1064,
                'city_id' => 116,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            64 =>
            array (
                'id' => 1065,
                'city_id' => 116,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            65 =>
            array (
                'id' => 1066,
                'city_id' => 116,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            66 =>
            array (
                'id' => 1067,
                'city_id' => 116,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            67 =>
            array (
                'id' => 1068,
                'city_id' => 116,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            68 =>
            array (
                'id' => 1069,
                'city_id' => 117,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            69 =>
            array (
                'id' => 1070,
                'city_id' => 117,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            70 =>
            array (
                'id' => 1071,
                'city_id' => 117,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            71 =>
            array (
                'id' => 1072,
                'city_id' => 117,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            72 =>
            array (
                'id' => 1073,
                'city_id' => 117,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            73 =>
            array (
                'id' => 1074,
                'city_id' => 117,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            74 =>
            array (
                'id' => 1075,
                'city_id' => 117,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            75 =>
            array (
                'id' => 1076,
                'city_id' => 117,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            76 =>
            array (
                'id' => 1077,
                'city_id' => 117,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            77 =>
            array (
                'id' => 1078,
                'city_id' => 117,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            78 =>
            array (
                'id' => 1079,
                'city_id' => 117,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            79 =>
            array (
                'id' => 1080,
                'city_id' => 117,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            80 =>
            array (
                'id' => 1081,
                'city_id' => 118,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            81 =>
            array (
                'id' => 1082,
                'city_id' => 118,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            82 =>
            array (
                'id' => 1083,
                'city_id' => 118,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            83 =>
            array (
                'id' => 1084,
                'city_id' => 118,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            84 =>
            array (
                'id' => 1085,
                'city_id' => 118,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            85 =>
            array (
                'id' => 1086,
                'city_id' => 118,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            86 =>
            array (
                'id' => 1087,
                'city_id' => 118,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            87 =>
            array (
                'id' => 1088,
                'city_id' => 118,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            88 =>
            array (
                'id' => 1089,
                'city_id' => 118,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            89 =>
            array (
                'id' => 1090,
                'city_id' => 118,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            90 =>
            array (
                'id' => 1091,
                'city_id' => 118,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            91 =>
            array (
                'id' => 1092,
                'city_id' => 118,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            92 =>
            array (
                'id' => 1093,
                'city_id' => 119,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            93 =>
            array (
                'id' => 1094,
                'city_id' => 119,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            94 =>
            array (
                'id' => 1095,
                'city_id' => 119,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            95 =>
            array (
                'id' => 1096,
                'city_id' => 119,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            96 =>
            array (
                'id' => 1097,
                'city_id' => 119,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            97 =>
            array (
                'id' => 1098,
                'city_id' => 119,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            98 =>
            array (
                'id' => 1099,
                'city_id' => 119,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            99 =>
            array (
                'id' => 1100,
                'city_id' => 119,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            100 =>
            array (
                'id' => 1101,
                'city_id' => 119,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            101 =>
            array (
                'id' => 1102,
                'city_id' => 119,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            102 =>
            array (
                'id' => 1103,
                'city_id' => 119,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            103 =>
            array (
                'id' => 1104,
                'city_id' => 119,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            104 =>
            array (
                'id' => 1105,
                'city_id' => 120,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            105 =>
            array (
                'id' => 1106,
                'city_id' => 120,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            106 =>
            array (
                'id' => 1107,
                'city_id' => 120,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            107 =>
            array (
                'id' => 1108,
                'city_id' => 120,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            108 =>
            array (
                'id' => 1109,
                'city_id' => 120,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            109 =>
            array (
                'id' => 1110,
                'city_id' => 120,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            110 =>
            array (
                'id' => 1111,
                'city_id' => 120,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            111 =>
            array (
                'id' => 1112,
                'city_id' => 120,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            112 =>
            array (
                'id' => 1113,
                'city_id' => 120,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            113 =>
            array (
                'id' => 1114,
                'city_id' => 120,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            114 =>
            array (
                'id' => 1115,
                'city_id' => 120,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            115 =>
            array (
                'id' => 1116,
                'city_id' => 120,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            116 =>
            array (
                'id' => 1117,
                'city_id' => 121,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            117 =>
            array (
                'id' => 1118,
                'city_id' => 121,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            118 =>
            array (
                'id' => 1119,
                'city_id' => 121,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            119 =>
            array (
                'id' => 1120,
                'city_id' => 121,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            120 =>
            array (
                'id' => 1121,
                'city_id' => 121,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            121 =>
            array (
                'id' => 1122,
                'city_id' => 121,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            122 =>
            array (
                'id' => 1123,
                'city_id' => 121,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            123 =>
            array (
                'id' => 1124,
                'city_id' => 121,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            124 =>
            array (
                'id' => 1125,
                'city_id' => 121,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            125 =>
            array (
                'id' => 1126,
                'city_id' => 121,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            126 =>
            array (
                'id' => 1127,
                'city_id' => 121,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            127 =>
            array (
                'id' => 1128,
                'city_id' => 121,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            128 =>
            array (
                'id' => 1129,
                'city_id' => 122,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            129 =>
            array (
                'id' => 1130,
                'city_id' => 122,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            130 =>
            array (
                'id' => 1131,
                'city_id' => 122,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            131 =>
            array (
                'id' => 1132,
                'city_id' => 122,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            132 =>
            array (
                'id' => 1133,
                'city_id' => 122,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            133 =>
            array (
                'id' => 1134,
                'city_id' => 122,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            134 =>
            array (
                'id' => 1135,
                'city_id' => 122,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            135 =>
            array (
                'id' => 1136,
                'city_id' => 122,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            136 =>
            array (
                'id' => 1137,
                'city_id' => 122,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            137 =>
            array (
                'id' => 1138,
                'city_id' => 122,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            138 =>
            array (
                'id' => 1139,
                'city_id' => 122,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            139 =>
            array (
                'id' => 1140,
                'city_id' => 122,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            140 =>
            array (
                'id' => 1141,
                'city_id' => 123,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            141 =>
            array (
                'id' => 1142,
                'city_id' => 123,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            142 =>
            array (
                'id' => 1143,
                'city_id' => 123,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            143 =>
            array (
                'id' => 1144,
                'city_id' => 123,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            144 =>
            array (
                'id' => 1145,
                'city_id' => 123,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            145 =>
            array (
                'id' => 1146,
                'city_id' => 123,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            146 =>
            array (
                'id' => 1147,
                'city_id' => 123,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            147 =>
            array (
                'id' => 1148,
                'city_id' => 123,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            148 =>
            array (
                'id' => 1149,
                'city_id' => 123,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            149 =>
            array (
                'id' => 1150,
                'city_id' => 123,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            150 =>
            array (
                'id' => 1151,
                'city_id' => 123,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            151 =>
            array (
                'id' => 1152,
                'city_id' => 123,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            152 =>
            array (
                'id' => 1153,
                'city_id' => 124,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            153 =>
            array (
                'id' => 1154,
                'city_id' => 124,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            154 =>
            array (
                'id' => 1155,
                'city_id' => 124,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            155 =>
            array (
                'id' => 1156,
                'city_id' => 124,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            156 =>
            array (
                'id' => 1157,
                'city_id' => 124,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            157 =>
            array (
                'id' => 1158,
                'city_id' => 124,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            158 =>
            array (
                'id' => 1159,
                'city_id' => 124,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            159 =>
            array (
                'id' => 1160,
                'city_id' => 124,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            160 =>
            array (
                'id' => 1161,
                'city_id' => 124,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            161 =>
            array (
                'id' => 1162,
                'city_id' => 124,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            162 =>
            array (
                'id' => 1163,
                'city_id' => 124,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            163 =>
            array (
                'id' => 1164,
                'city_id' => 124,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            164 =>
            array (
                'id' => 1165,
                'city_id' => 125,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            165 =>
            array (
                'id' => 1166,
                'city_id' => 125,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            166 =>
            array (
                'id' => 1167,
                'city_id' => 125,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            167 =>
            array (
                'id' => 1168,
                'city_id' => 125,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            168 =>
            array (
                'id' => 1169,
                'city_id' => 125,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            169 =>
            array (
                'id' => 1170,
                'city_id' => 125,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            170 =>
            array (
                'id' => 1171,
                'city_id' => 125,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            171 =>
            array (
                'id' => 1172,
                'city_id' => 125,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            172 =>
            array (
                'id' => 1173,
                'city_id' => 125,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            173 =>
            array (
                'id' => 1174,
                'city_id' => 125,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            174 =>
            array (
                'id' => 1175,
                'city_id' => 125,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            175 =>
            array (
                'id' => 1176,
                'city_id' => 125,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            176 =>
            array (
                'id' => 1177,
                'city_id' => 126,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            177 =>
            array (
                'id' => 1178,
                'city_id' => 126,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            178 =>
            array (
                'id' => 1179,
                'city_id' => 126,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            179 =>
            array (
                'id' => 1180,
                'city_id' => 126,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            180 =>
            array (
                'id' => 1181,
                'city_id' => 126,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            181 =>
            array (
                'id' => 1182,
                'city_id' => 126,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            182 =>
            array (
                'id' => 1183,
                'city_id' => 126,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            183 =>
            array (
                'id' => 1184,
                'city_id' => 126,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            184 =>
            array (
                'id' => 1185,
                'city_id' => 126,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            185 =>
            array (
                'id' => 1186,
                'city_id' => 126,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            186 =>
            array (
                'id' => 1187,
                'city_id' => 126,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            187 =>
            array (
                'id' => 1188,
                'city_id' => 126,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            188 =>
            array (
                'id' => 1189,
                'city_id' => 127,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            189 =>
            array (
                'id' => 1190,
                'city_id' => 127,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            190 =>
            array (
                'id' => 1191,
                'city_id' => 127,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            191 =>
            array (
                'id' => 1192,
                'city_id' => 127,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            192 =>
            array (
                'id' => 1193,
                'city_id' => 127,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            193 =>
            array (
                'id' => 1194,
                'city_id' => 127,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            194 =>
            array (
                'id' => 1195,
                'city_id' => 127,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            195 =>
            array (
                'id' => 1196,
                'city_id' => 127,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            196 =>
            array (
                'id' => 1197,
                'city_id' => 127,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            197 =>
            array (
                'id' => 1198,
                'city_id' => 127,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            198 =>
            array (
                'id' => 1199,
                'city_id' => 127,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            199 =>
            array (
                'id' => 1200,
                'city_id' => 127,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            200 =>
            array (
                'id' => 1201,
                'city_id' => 128,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            201 =>
            array (
                'id' => 1202,
                'city_id' => 128,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            202 =>
            array (
                'id' => 1203,
                'city_id' => 128,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            203 =>
            array (
                'id' => 1204,
                'city_id' => 128,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            204 =>
            array (
                'id' => 1205,
                'city_id' => 128,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            205 =>
            array (
                'id' => 1206,
                'city_id' => 128,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            206 =>
            array (
                'id' => 1207,
                'city_id' => 128,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            207 =>
            array (
                'id' => 1208,
                'city_id' => 128,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            208 =>
            array (
                'id' => 1209,
                'city_id' => 128,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            209 =>
            array (
                'id' => 1210,
                'city_id' => 128,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            210 =>
            array (
                'id' => 1211,
                'city_id' => 128,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            211 =>
            array (
                'id' => 1212,
                'city_id' => 128,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            212 =>
            array (
                'id' => 1213,
                'city_id' => 129,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            213 =>
            array (
                'id' => 1214,
                'city_id' => 129,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            214 =>
            array (
                'id' => 1215,
                'city_id' => 129,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            215 =>
            array (
                'id' => 1216,
                'city_id' => 129,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            216 =>
            array (
                'id' => 1217,
                'city_id' => 129,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            217 =>
            array (
                'id' => 1218,
                'city_id' => 129,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            218 =>
            array (
                'id' => 1219,
                'city_id' => 129,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            219 =>
            array (
                'id' => 1220,
                'city_id' => 129,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            220 =>
            array (
                'id' => 1221,
                'city_id' => 129,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            221 =>
            array (
                'id' => 1222,
                'city_id' => 129,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            222 =>
            array (
                'id' => 1223,
                'city_id' => 129,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            223 =>
            array (
                'id' => 1224,
                'city_id' => 129,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            224 =>
            array (
                'id' => 1225,
                'city_id' => 130,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            225 =>
            array (
                'id' => 1226,
                'city_id' => 130,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            226 =>
            array (
                'id' => 1227,
                'city_id' => 130,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            227 =>
            array (
                'id' => 1228,
                'city_id' => 130,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            228 =>
            array (
                'id' => 1229,
                'city_id' => 130,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            229 =>
            array (
                'id' => 1230,
                'city_id' => 130,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            230 =>
            array (
                'id' => 1231,
                'city_id' => 130,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            231 =>
            array (
                'id' => 1232,
                'city_id' => 130,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            232 =>
            array (
                'id' => 1233,
                'city_id' => 130,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            233 =>
            array (
                'id' => 1234,
                'city_id' => 130,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            234 =>
            array (
                'id' => 1235,
                'city_id' => 130,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            235 =>
            array (
                'id' => 1236,
                'city_id' => 130,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            236 =>
            array (
                'id' => 1237,
                'city_id' => 131,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            237 =>
            array (
                'id' => 1238,
                'city_id' => 131,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            238 =>
            array (
                'id' => 1239,
                'city_id' => 131,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            239 =>
            array (
                'id' => 1240,
                'city_id' => 131,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            240 =>
            array (
                'id' => 1241,
                'city_id' => 131,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            241 =>
            array (
                'id' => 1242,
                'city_id' => 131,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            242 =>
            array (
                'id' => 1243,
                'city_id' => 131,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            243 =>
            array (
                'id' => 1244,
                'city_id' => 131,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            244 =>
            array (
                'id' => 1245,
                'city_id' => 131,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            245 =>
            array (
                'id' => 1246,
                'city_id' => 131,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            246 =>
            array (
                'id' => 1247,
                'city_id' => 131,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            247 =>
            array (
                'id' => 1248,
                'city_id' => 131,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            248 =>
            array (
                'id' => 1249,
                'city_id' => 132,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            249 =>
            array (
                'id' => 1250,
                'city_id' => 132,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            250 =>
            array (
                'id' => 1251,
                'city_id' => 132,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            251 =>
            array (
                'id' => 1252,
                'city_id' => 132,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            252 =>
            array (
                'id' => 1253,
                'city_id' => 132,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            253 =>
            array (
                'id' => 1254,
                'city_id' => 132,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            254 =>
            array (
                'id' => 1255,
                'city_id' => 132,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            255 =>
            array (
                'id' => 1256,
                'city_id' => 132,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            256 =>
            array (
                'id' => 1257,
                'city_id' => 132,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            257 =>
            array (
                'id' => 1258,
                'city_id' => 132,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            258 =>
            array (
                'id' => 1259,
                'city_id' => 132,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            259 =>
            array (
                'id' => 1260,
                'city_id' => 132,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            260 =>
            array (
                'id' => 1261,
                'city_id' => 133,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            261 =>
            array (
                'id' => 1262,
                'city_id' => 133,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            262 =>
            array (
                'id' => 1263,
                'city_id' => 133,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            263 =>
            array (
                'id' => 1264,
                'city_id' => 133,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            264 =>
            array (
                'id' => 1265,
                'city_id' => 133,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            265 =>
            array (
                'id' => 1266,
                'city_id' => 133,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            266 =>
            array (
                'id' => 1267,
                'city_id' => 133,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            267 =>
            array (
                'id' => 1268,
                'city_id' => 133,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            268 =>
            array (
                'id' => 1269,
                'city_id' => 133,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            269 =>
            array (
                'id' => 1270,
                'city_id' => 133,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            270 =>
            array (
                'id' => 1271,
                'city_id' => 133,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            271 =>
            array (
                'id' => 1272,
                'city_id' => 133,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            272 =>
            array (
                'id' => 1273,
                'city_id' => 134,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            273 =>
            array (
                'id' => 1274,
                'city_id' => 134,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            274 =>
            array (
                'id' => 1275,
                'city_id' => 134,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            275 =>
            array (
                'id' => 1276,
                'city_id' => 134,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            276 =>
            array (
                'id' => 1277,
                'city_id' => 134,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            277 =>
            array (
                'id' => 1278,
                'city_id' => 134,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            278 =>
            array (
                'id' => 1279,
                'city_id' => 134,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            279 =>
            array (
                'id' => 1280,
                'city_id' => 134,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            280 =>
            array (
                'id' => 1281,
                'city_id' => 134,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            281 =>
            array (
                'id' => 1282,
                'city_id' => 134,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            282 =>
            array (
                'id' => 1283,
                'city_id' => 134,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            283 =>
            array (
                'id' => 1284,
                'city_id' => 134,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            284 =>
            array (
                'id' => 1285,
                'city_id' => 135,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            285 =>
            array (
                'id' => 1286,
                'city_id' => 135,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            286 =>
            array (
                'id' => 1287,
                'city_id' => 135,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            287 =>
            array (
                'id' => 1288,
                'city_id' => 135,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            288 =>
            array (
                'id' => 1289,
                'city_id' => 135,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            289 =>
            array (
                'id' => 1290,
                'city_id' => 135,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            290 =>
            array (
                'id' => 1291,
                'city_id' => 135,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            291 =>
            array (
                'id' => 1292,
                'city_id' => 135,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            292 =>
            array (
                'id' => 1293,
                'city_id' => 135,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            293 =>
            array (
                'id' => 1294,
                'city_id' => 135,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            294 =>
            array (
                'id' => 1295,
                'city_id' => 135,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            295 =>
            array (
                'id' => 1296,
                'city_id' => 135,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            296 =>
            array (
                'id' => 1297,
                'city_id' => 136,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            297 =>
            array (
                'id' => 1298,
                'city_id' => 136,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            298 =>
            array (
                'id' => 1299,
                'city_id' => 136,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            299 =>
            array (
                'id' => 1300,
                'city_id' => 136,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            300 =>
            array (
                'id' => 1301,
                'city_id' => 136,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            301 =>
            array (
                'id' => 1302,
                'city_id' => 136,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            302 =>
            array (
                'id' => 1303,
                'city_id' => 136,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            303 =>
            array (
                'id' => 1304,
                'city_id' => 136,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            304 =>
            array (
                'id' => 1305,
                'city_id' => 136,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            305 =>
            array (
                'id' => 1306,
                'city_id' => 136,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            306 =>
            array (
                'id' => 1307,
                'city_id' => 136,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            307 =>
            array (
                'id' => 1308,
                'city_id' => 136,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            308 =>
            array (
                'id' => 1309,
                'city_id' => 137,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            309 =>
            array (
                'id' => 1310,
                'city_id' => 137,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            310 =>
            array (
                'id' => 1311,
                'city_id' => 137,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            311 =>
            array (
                'id' => 1312,
                'city_id' => 137,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            312 =>
            array (
                'id' => 1313,
                'city_id' => 137,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            313 =>
            array (
                'id' => 1314,
                'city_id' => 137,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            314 =>
            array (
                'id' => 1315,
                'city_id' => 137,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            315 =>
            array (
                'id' => 1316,
                'city_id' => 137,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            316 =>
            array (
                'id' => 1317,
                'city_id' => 137,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            317 =>
            array (
                'id' => 1318,
                'city_id' => 137,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            318 =>
            array (
                'id' => 1319,
                'city_id' => 137,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            319 =>
            array (
                'id' => 1320,
                'city_id' => 137,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            320 =>
            array (
                'id' => 1321,
                'city_id' => 138,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            321 =>
            array (
                'id' => 1322,
                'city_id' => 138,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            322 =>
            array (
                'id' => 1323,
                'city_id' => 138,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            323 =>
            array (
                'id' => 1324,
                'city_id' => 138,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            324 =>
            array (
                'id' => 1325,
                'city_id' => 138,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            325 =>
            array (
                'id' => 1326,
                'city_id' => 138,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            326 =>
            array (
                'id' => 1327,
                'city_id' => 138,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            327 =>
            array (
                'id' => 1328,
                'city_id' => 138,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            328 =>
            array (
                'id' => 1329,
                'city_id' => 138,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            329 =>
            array (
                'id' => 1330,
                'city_id' => 138,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            330 =>
            array (
                'id' => 1331,
                'city_id' => 138,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            331 =>
            array (
                'id' => 1332,
                'city_id' => 138,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            332 =>
            array (
                'id' => 1333,
                'city_id' => 139,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            333 =>
            array (
                'id' => 1334,
                'city_id' => 139,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            334 =>
            array (
                'id' => 1335,
                'city_id' => 139,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            335 =>
            array (
                'id' => 1336,
                'city_id' => 139,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            336 =>
            array (
                'id' => 1337,
                'city_id' => 139,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            337 =>
            array (
                'id' => 1338,
                'city_id' => 139,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            338 =>
            array (
                'id' => 1339,
                'city_id' => 139,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            339 =>
            array (
                'id' => 1340,
                'city_id' => 139,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            340 =>
            array (
                'id' => 1341,
                'city_id' => 139,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            341 =>
            array (
                'id' => 1342,
                'city_id' => 139,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            342 =>
            array (
                'id' => 1343,
                'city_id' => 139,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            343 =>
            array (
                'id' => 1344,
                'city_id' => 139,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            344 =>
            array (
                'id' => 1345,
                'city_id' => 140,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            345 =>
            array (
                'id' => 1346,
                'city_id' => 140,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            346 =>
            array (
                'id' => 1347,
                'city_id' => 140,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            347 =>
            array (
                'id' => 1348,
                'city_id' => 140,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            348 =>
            array (
                'id' => 1349,
                'city_id' => 140,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            349 =>
            array (
                'id' => 1350,
                'city_id' => 140,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            350 =>
            array (
                'id' => 1351,
                'city_id' => 140,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            351 =>
            array (
                'id' => 1352,
                'city_id' => 140,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            352 =>
            array (
                'id' => 1353,
                'city_id' => 140,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            353 =>
            array (
                'id' => 1354,
                'city_id' => 140,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            354 =>
            array (
                'id' => 1355,
                'city_id' => 140,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            355 =>
            array (
                'id' => 1356,
                'city_id' => 140,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            356 =>
            array (
                'id' => 1357,
                'city_id' => 141,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            357 =>
            array (
                'id' => 1358,
                'city_id' => 141,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            358 =>
            array (
                'id' => 1359,
                'city_id' => 141,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            359 =>
            array (
                'id' => 1360,
                'city_id' => 141,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            360 =>
            array (
                'id' => 1361,
                'city_id' => 141,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            361 =>
            array (
                'id' => 1362,
                'city_id' => 141,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            362 =>
            array (
                'id' => 1363,
                'city_id' => 141,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            363 =>
            array (
                'id' => 1364,
                'city_id' => 141,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            364 =>
            array (
                'id' => 1365,
                'city_id' => 141,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            365 =>
            array (
                'id' => 1366,
                'city_id' => 141,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            366 =>
            array (
                'id' => 1367,
                'city_id' => 141,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            367 =>
            array (
                'id' => 1368,
                'city_id' => 141,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            368 =>
            array (
                'id' => 1369,
                'city_id' => 142,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            369 =>
            array (
                'id' => 1370,
                'city_id' => 142,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            370 =>
            array (
                'id' => 1371,
                'city_id' => 142,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            371 =>
            array (
                'id' => 1372,
                'city_id' => 142,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            372 =>
            array (
                'id' => 1373,
                'city_id' => 142,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            373 =>
            array (
                'id' => 1374,
                'city_id' => 142,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            374 =>
            array (
                'id' => 1375,
                'city_id' => 142,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            375 =>
            array (
                'id' => 1376,
                'city_id' => 142,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            376 =>
            array (
                'id' => 1377,
                'city_id' => 142,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            377 =>
            array (
                'id' => 1378,
                'city_id' => 142,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            378 =>
            array (
                'id' => 1379,
                'city_id' => 142,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            379 =>
            array (
                'id' => 1380,
                'city_id' => 142,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            380 =>
            array (
                'id' => 1381,
                'city_id' => 143,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            381 =>
            array (
                'id' => 1382,
                'city_id' => 143,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            382 =>
            array (
                'id' => 1383,
                'city_id' => 143,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            383 =>
            array (
                'id' => 1384,
                'city_id' => 143,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            384 =>
            array (
                'id' => 1385,
                'city_id' => 143,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            385 =>
            array (
                'id' => 1386,
                'city_id' => 143,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            386 =>
            array (
                'id' => 1387,
                'city_id' => 143,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            387 =>
            array (
                'id' => 1388,
                'city_id' => 143,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            388 =>
            array (
                'id' => 1389,
                'city_id' => 143,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            389 =>
            array (
                'id' => 1390,
                'city_id' => 143,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            390 =>
            array (
                'id' => 1391,
                'city_id' => 143,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            391 =>
            array (
                'id' => 1392,
                'city_id' => 143,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            392 =>
            array (
                'id' => 1393,
                'city_id' => 144,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            393 =>
            array (
                'id' => 1394,
                'city_id' => 144,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            394 =>
            array (
                'id' => 1395,
                'city_id' => 144,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            395 =>
            array (
                'id' => 1396,
                'city_id' => 144,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            396 =>
            array (
                'id' => 1397,
                'city_id' => 144,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            397 =>
            array (
                'id' => 1398,
                'city_id' => 144,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            398 =>
            array (
                'id' => 1399,
                'city_id' => 144,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            399 =>
            array (
                'id' => 1400,
                'city_id' => 144,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            400 =>
            array (
                'id' => 1401,
                'city_id' => 144,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            401 =>
            array (
                'id' => 1402,
                'city_id' => 144,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            402 =>
            array (
                'id' => 1403,
                'city_id' => 144,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            403 =>
            array (
                'id' => 1404,
                'city_id' => 144,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            404 =>
            array (
                'id' => 1405,
                'city_id' => 145,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            405 =>
            array (
                'id' => 1406,
                'city_id' => 145,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            406 =>
            array (
                'id' => 1407,
                'city_id' => 145,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            407 =>
            array (
                'id' => 1408,
                'city_id' => 145,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            408 =>
            array (
                'id' => 1409,
                'city_id' => 145,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            409 =>
            array (
                'id' => 1410,
                'city_id' => 145,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            410 =>
            array (
                'id' => 1411,
                'city_id' => 145,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            411 =>
            array (
                'id' => 1412,
                'city_id' => 145,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            412 =>
            array (
                'id' => 1413,
                'city_id' => 145,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            413 =>
            array (
                'id' => 1414,
                'city_id' => 145,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            414 =>
            array (
                'id' => 1415,
                'city_id' => 145,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            415 =>
            array (
                'id' => 1416,
                'city_id' => 145,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            416 =>
            array (
                'id' => 1417,
                'city_id' => 146,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            417 =>
            array (
                'id' => 1418,
                'city_id' => 146,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            418 =>
            array (
                'id' => 1419,
                'city_id' => 146,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            419 =>
            array (
                'id' => 1420,
                'city_id' => 146,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            420 =>
            array (
                'id' => 1421,
                'city_id' => 146,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            421 =>
            array (
                'id' => 1422,
                'city_id' => 146,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            422 =>
            array (
                'id' => 1423,
                'city_id' => 146,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            423 =>
            array (
                'id' => 1424,
                'city_id' => 146,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            424 =>
            array (
                'id' => 1425,
                'city_id' => 146,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            425 =>
            array (
                'id' => 1426,
                'city_id' => 146,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            426 =>
            array (
                'id' => 1427,
                'city_id' => 146,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            427 =>
            array (
                'id' => 1428,
                'city_id' => 146,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            428 =>
            array (
                'id' => 1429,
                'city_id' => 147,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            429 =>
            array (
                'id' => 1430,
                'city_id' => 147,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            430 =>
            array (
                'id' => 1431,
                'city_id' => 147,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            431 =>
            array (
                'id' => 1432,
                'city_id' => 147,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            432 =>
            array (
                'id' => 1433,
                'city_id' => 147,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            433 =>
            array (
                'id' => 1434,
                'city_id' => 147,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            434 =>
            array (
                'id' => 1435,
                'city_id' => 147,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            435 =>
            array (
                'id' => 1436,
                'city_id' => 147,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            436 =>
            array (
                'id' => 1437,
                'city_id' => 147,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            437 =>
            array (
                'id' => 1438,
                'city_id' => 147,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            438 =>
            array (
                'id' => 1439,
                'city_id' => 147,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            439 =>
            array (
                'id' => 1440,
                'city_id' => 147,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            440 =>
            array (
                'id' => 1441,
                'city_id' => 148,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            441 =>
            array (
                'id' => 1442,
                'city_id' => 148,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            442 =>
            array (
                'id' => 1443,
                'city_id' => 148,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            443 =>
            array (
                'id' => 1444,
                'city_id' => 148,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            444 =>
            array (
                'id' => 1445,
                'city_id' => 148,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            445 =>
            array (
                'id' => 1446,
                'city_id' => 148,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            446 =>
            array (
                'id' => 1447,
                'city_id' => 148,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            447 =>
            array (
                'id' => 1448,
                'city_id' => 148,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            448 =>
            array (
                'id' => 1449,
                'city_id' => 148,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            449 =>
            array (
                'id' => 1450,
                'city_id' => 148,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            450 =>
            array (
                'id' => 1451,
                'city_id' => 148,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            451 =>
            array (
                'id' => 1452,
                'city_id' => 148,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            452 =>
            array (
                'id' => 1453,
                'city_id' => 149,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            453 =>
            array (
                'id' => 1454,
                'city_id' => 149,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            454 =>
            array (
                'id' => 1455,
                'city_id' => 149,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            455 =>
            array (
                'id' => 1456,
                'city_id' => 149,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            456 =>
            array (
                'id' => 1457,
                'city_id' => 149,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            457 =>
            array (
                'id' => 1458,
                'city_id' => 149,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            458 =>
            array (
                'id' => 1459,
                'city_id' => 149,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            459 =>
            array (
                'id' => 1460,
                'city_id' => 149,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            460 =>
            array (
                'id' => 1461,
                'city_id' => 149,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            461 =>
            array (
                'id' => 1462,
                'city_id' => 149,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            462 =>
            array (
                'id' => 1463,
                'city_id' => 149,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            463 =>
            array (
                'id' => 1464,
                'city_id' => 149,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            464 =>
            array (
                'id' => 1465,
                'city_id' => 150,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            465 =>
            array (
                'id' => 1466,
                'city_id' => 150,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            466 =>
            array (
                'id' => 1467,
                'city_id' => 150,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            467 =>
            array (
                'id' => 1468,
                'city_id' => 150,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            468 =>
            array (
                'id' => 1469,
                'city_id' => 150,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            469 =>
            array (
                'id' => 1470,
                'city_id' => 150,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            470 =>
            array (
                'id' => 1471,
                'city_id' => 150,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            471 =>
            array (
                'id' => 1472,
                'city_id' => 150,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            472 =>
            array (
                'id' => 1473,
                'city_id' => 150,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            473 =>
            array (
                'id' => 1474,
                'city_id' => 150,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            474 =>
            array (
                'id' => 1475,
                'city_id' => 150,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            475 =>
            array (
                'id' => 1476,
                'city_id' => 150,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            476 =>
            array (
                'id' => 1477,
                'city_id' => 151,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            477 =>
            array (
                'id' => 1478,
                'city_id' => 151,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            478 =>
            array (
                'id' => 1479,
                'city_id' => 151,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            479 =>
            array (
                'id' => 1480,
                'city_id' => 151,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            480 =>
            array (
                'id' => 1481,
                'city_id' => 151,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            481 =>
            array (
                'id' => 1482,
                'city_id' => 151,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            482 =>
            array (
                'id' => 1483,
                'city_id' => 151,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            483 =>
            array (
                'id' => 1484,
                'city_id' => 151,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            484 =>
            array (
                'id' => 1485,
                'city_id' => 151,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            485 =>
            array (
                'id' => 1486,
                'city_id' => 151,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            486 =>
            array (
                'id' => 1487,
                'city_id' => 151,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            487 =>
            array (
                'id' => 1488,
                'city_id' => 151,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            488 =>
            array (
                'id' => 1489,
                'city_id' => 152,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            489 =>
            array (
                'id' => 1490,
                'city_id' => 152,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            490 =>
            array (
                'id' => 1491,
                'city_id' => 152,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            491 =>
            array (
                'id' => 1492,
                'city_id' => 152,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            492 =>
            array (
                'id' => 1493,
                'city_id' => 152,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            493 =>
            array (
                'id' => 1494,
                'city_id' => 152,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            494 =>
            array (
                'id' => 1495,
                'city_id' => 152,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            495 =>
            array (
                'id' => 1496,
                'city_id' => 152,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            496 =>
            array (
                'id' => 1497,
                'city_id' => 152,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            497 =>
            array (
                'id' => 1498,
                'city_id' => 152,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            498 =>
            array (
                'id' => 1499,
                'city_id' => 152,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            499 =>
            array (
                'id' => 1500,
                'city_id' => 152,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
        ));
        \DB::table('actirovki_widget_weather_ranges')->insert(array (
            0 =>
            array (
                'id' => 1501,
                'city_id' => 153,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            1 =>
            array (
                'id' => 1502,
                'city_id' => 153,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            2 =>
            array (
                'id' => 1503,
                'city_id' => 153,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            3 =>
            array (
                'id' => 1504,
                'city_id' => 153,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            4 =>
            array (
                'id' => 1505,
                'city_id' => 153,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            5 =>
            array (
                'id' => 1506,
                'city_id' => 153,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            6 =>
            array (
                'id' => 1507,
                'city_id' => 153,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            7 =>
            array (
                'id' => 1508,
                'city_id' => 153,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            8 =>
            array (
                'id' => 1509,
                'city_id' => 153,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            9 =>
            array (
                'id' => 1510,
                'city_id' => 153,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            10 =>
            array (
                'id' => 1511,
                'city_id' => 153,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            11 =>
            array (
                'id' => 1512,
                'city_id' => 153,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            12 =>
            array (
                'id' => 1513,
                'city_id' => 154,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            13 =>
            array (
                'id' => 1514,
                'city_id' => 154,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            14 =>
            array (
                'id' => 1515,
                'city_id' => 154,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            15 =>
            array (
                'id' => 1516,
                'city_id' => 154,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            16 =>
            array (
                'id' => 1517,
                'city_id' => 154,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            17 =>
            array (
                'id' => 1518,
                'city_id' => 154,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            18 =>
            array (
                'id' => 1519,
                'city_id' => 154,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            19 =>
            array (
                'id' => 1520,
                'city_id' => 154,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            20 =>
            array (
                'id' => 1521,
                'city_id' => 154,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            21 =>
            array (
                'id' => 1522,
                'city_id' => 154,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            22 =>
            array (
                'id' => 1523,
                'city_id' => 154,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            23 =>
            array (
                'id' => 1524,
                'city_id' => 154,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            24 =>
            array (
                'id' => 1525,
                'city_id' => 155,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            25 =>
            array (
                'id' => 1526,
                'city_id' => 155,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            26 =>
            array (
                'id' => 1527,
                'city_id' => 155,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            27 =>
            array (
                'id' => 1528,
                'city_id' => 155,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            28 =>
            array (
                'id' => 1529,
                'city_id' => 155,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            29 =>
            array (
                'id' => 1530,
                'city_id' => 155,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            30 =>
            array (
                'id' => 1531,
                'city_id' => 155,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            31 =>
            array (
                'id' => 1532,
                'city_id' => 155,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            32 =>
            array (
                'id' => 1533,
                'city_id' => 155,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            33 =>
            array (
                'id' => 1534,
                'city_id' => 155,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            34 =>
            array (
                'id' => 1535,
                'city_id' => 155,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            35 =>
            array (
                'id' => 1536,
                'city_id' => 155,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            36 =>
            array (
                'id' => 1537,
                'city_id' => 156,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            37 =>
            array (
                'id' => 1538,
                'city_id' => 156,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            38 =>
            array (
                'id' => 1539,
                'city_id' => 156,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            39 =>
            array (
                'id' => 1540,
                'city_id' => 156,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            40 =>
            array (
                'id' => 1541,
                'city_id' => 156,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            41 =>
            array (
                'id' => 1542,
                'city_id' => 156,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            42 =>
            array (
                'id' => 1543,
                'city_id' => 156,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            43 =>
            array (
                'id' => 1544,
                'city_id' => 156,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            44 =>
            array (
                'id' => 1545,
                'city_id' => 156,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            45 =>
            array (
                'id' => 1546,
                'city_id' => 156,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            46 =>
            array (
                'id' => 1547,
                'city_id' => 156,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            47 =>
            array (
                'id' => 1548,
                'city_id' => 156,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            48 =>
            array (
                'id' => 1549,
                'city_id' => 157,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            49 =>
            array (
                'id' => 1550,
                'city_id' => 157,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            50 =>
            array (
                'id' => 1551,
                'city_id' => 157,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            51 =>
            array (
                'id' => 1552,
                'city_id' => 157,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            52 =>
            array (
                'id' => 1553,
                'city_id' => 157,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            53 =>
            array (
                'id' => 1554,
                'city_id' => 157,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            54 =>
            array (
                'id' => 1555,
                'city_id' => 157,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            55 =>
            array (
                'id' => 1556,
                'city_id' => 157,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            56 =>
            array (
                'id' => 1557,
                'city_id' => 157,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            57 =>
            array (
                'id' => 1558,
                'city_id' => 157,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            58 =>
            array (
                'id' => 1559,
                'city_id' => 157,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            59 =>
            array (
                'id' => 1560,
                'city_id' => 157,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            60 =>
            array (
                'id' => 1561,
                'city_id' => 158,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            61 =>
            array (
                'id' => 1562,
                'city_id' => 158,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            62 =>
            array (
                'id' => 1563,
                'city_id' => 158,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            63 =>
            array (
                'id' => 1564,
                'city_id' => 158,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            64 =>
            array (
                'id' => 1565,
                'city_id' => 158,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            65 =>
            array (
                'id' => 1566,
                'city_id' => 158,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            66 =>
            array (
                'id' => 1567,
                'city_id' => 158,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            67 =>
            array (
                'id' => 1568,
                'city_id' => 158,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            68 =>
            array (
                'id' => 1569,
                'city_id' => 158,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            69 =>
            array (
                'id' => 1570,
                'city_id' => 158,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            70 =>
            array (
                'id' => 1571,
                'city_id' => 158,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            71 =>
            array (
                'id' => 1572,
                'city_id' => 158,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            72 =>
            array (
                'id' => 1573,
                'city_id' => 159,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            73 =>
            array (
                'id' => 1574,
                'city_id' => 159,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            74 =>
            array (
                'id' => 1575,
                'city_id' => 159,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            75 =>
            array (
                'id' => 1576,
                'city_id' => 159,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            76 =>
            array (
                'id' => 1577,
                'city_id' => 159,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            77 =>
            array (
                'id' => 1578,
                'city_id' => 159,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            78 =>
            array (
                'id' => 1579,
                'city_id' => 159,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            79 =>
            array (
                'id' => 1580,
                'city_id' => 159,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            80 =>
            array (
                'id' => 1581,
                'city_id' => 159,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            81 =>
            array (
                'id' => 1582,
                'city_id' => 159,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            82 =>
            array (
                'id' => 1583,
                'city_id' => 159,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            83 =>
            array (
                'id' => 1584,
                'city_id' => 159,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            84 =>
            array (
                'id' => 1585,
                'city_id' => 160,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            85 =>
            array (
                'id' => 1586,
                'city_id' => 160,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            86 =>
            array (
                'id' => 1587,
                'city_id' => 160,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            87 =>
            array (
                'id' => 1588,
                'city_id' => 160,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            88 =>
            array (
                'id' => 1589,
                'city_id' => 160,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            89 =>
            array (
                'id' => 1590,
                'city_id' => 160,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            90 =>
            array (
                'id' => 1591,
                'city_id' => 160,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            91 =>
            array (
                'id' => 1592,
                'city_id' => 160,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            92 =>
            array (
                'id' => 1593,
                'city_id' => 160,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            93 =>
            array (
                'id' => 1594,
                'city_id' => 160,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            94 =>
            array (
                'id' => 1595,
                'city_id' => 160,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            95 =>
            array (
                'id' => 1596,
                'city_id' => 160,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            96 =>
            array (
                'id' => 1597,
                'city_id' => 161,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            97 =>
            array (
                'id' => 1598,
                'city_id' => 161,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            98 =>
            array (
                'id' => 1599,
                'city_id' => 161,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            99 =>
            array (
                'id' => 1600,
                'city_id' => 161,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            100 =>
            array (
                'id' => 1601,
                'city_id' => 161,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            101 =>
            array (
                'id' => 1602,
                'city_id' => 161,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            102 =>
            array (
                'id' => 1603,
                'city_id' => 161,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            103 =>
            array (
                'id' => 1604,
                'city_id' => 161,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            104 =>
            array (
                'id' => 1605,
                'city_id' => 161,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            105 =>
            array (
                'id' => 1606,
                'city_id' => 161,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            106 =>
            array (
                'id' => 1607,
                'city_id' => 161,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            107 =>
            array (
                'id' => 1608,
                'city_id' => 161,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
            108 =>
            array (
                'id' => 1609,
                'city_id' => 162,
                'temperature' => '-29.0',
                'wind' => '0.0',
                'school_class' => 4,
            ),
            109 =>
            array (
                'id' => 1610,
                'city_id' => 162,
                'temperature' => '-27.0',
                'wind' => '0.1',
                'school_class' => 4,
            ),
            110 =>
            array (
                'id' => 1611,
                'city_id' => 162,
                'temperature' => '-25.0',
                'wind' => '5.0',
                'school_class' => 4,
            ),
            111 =>
            array (
                'id' => 1612,
                'city_id' => 162,
                'temperature' => '-24.0',
                'wind' => '10.0',
                'school_class' => 4,
            ),
            112 =>
            array (
                'id' => 1613,
                'city_id' => 162,
                'temperature' => '-32.0',
                'wind' => '0.0',
                'school_class' => 8,
            ),
            113 =>
            array (
                'id' => 1614,
                'city_id' => 162,
                'temperature' => '-30.0',
                'wind' => '0.1',
                'school_class' => 8,
            ),
            114 =>
            array (
                'id' => 1615,
                'city_id' => 162,
                'temperature' => '-28.0',
                'wind' => '5.0',
                'school_class' => 8,
            ),
            115 =>
            array (
                'id' => 1616,
                'city_id' => 162,
                'temperature' => '-27.0',
                'wind' => '10.0',
                'school_class' => 8,
            ),
            116 =>
            array (
                'id' => 1617,
                'city_id' => 162,
                'temperature' => '-36.0',
                'wind' => '0.0',
                'school_class' => 11,
            ),
            117 =>
            array (
                'id' => 1618,
                'city_id' => 162,
                'temperature' => '-34.0',
                'wind' => '0.1',
                'school_class' => 11,
            ),
            118 =>
            array (
                'id' => 1619,
                'city_id' => 162,
                'temperature' => '-32.0',
                'wind' => '5.0',
                'school_class' => 11,
            ),
            119 =>
            array (
                'id' => 1620,
                'city_id' => 162,
                'temperature' => '-31.0',
                'wind' => '10.0',
                'school_class' => 11,
            ),
        ));


    }
}
