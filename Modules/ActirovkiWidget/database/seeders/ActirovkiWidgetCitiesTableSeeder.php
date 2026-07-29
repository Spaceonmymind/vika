<?php

namespace Modules\ActirovkiWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class ActirovkiWidgetCitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        if (\DB::table('actirovki_widget_cities')->exists()) {
            return;
        }

        \DB::table('actirovki_widget_cities')->insert(array (
            0 =>
            array (
                'id' => 28,
                'name' => 'пгт. Андра',
                'fias_id' => '1f2e6d0b-008a-4ffc-a60d-e3b410a22762',
            ),
            1 =>
            array (
                'id' => 29,
                'name' => 'пгт. Талинка',
                'fias_id' => '7d7fe155-fb56-4a14-b343-91f2b4cf9f30',
            ),
            2 =>
            array (
                'id' => 30,
                'name' => 'с. Перегребное',
                'fias_id' => 'b8e42f35-7ded-4a78-8a0d-113e111abc28',
            ),
            3 =>
            array (
                'id' => 31,
                'name' => 'п. Сергино',
                'fias_id' => '111ad40a-25cd-45f0-af82-e2c0cccf91da',
            ),
            4 =>
            array (
                'id' => 32,
                'name' => 'п. Унъюган',
                'fias_id' => '93e3f642-3637-49ba-a400-67baf0772bc7',
            ),
            5 =>
            array (
                'id' => 33,
                'name' => 'с. Большой Атлым',
                'fias_id' => '90c2a39a-ce36-4381-a3bc-51902c099bf7',
            ),
            6 =>
            array (
                'id' => 34,
                'name' => 'с. Большие Леуши',
                'fias_id' => '98d6df61-b7f7-4510-8d85-de3c95bb7b87',
            ),
            7 =>
            array (
                'id' => 35,
                'name' => 'с. Каменное',
                'fias_id' => '282e980f-1654-4967-b62e-390d6f67784b',
            ),
            8 =>
            array (
                'id' => 36,
                'name' => 'п. Карымкары',
                'fias_id' => 'cea00c7a-b6bd-47d9-855f-3504747c7b11',
            ),
            9 =>
            array (
                'id' => 37,
                'name' => 'п. Комсомольский',
                'fias_id' => 'cb16a8b0-de9c-400d-bb89-4be4aaed9ae4',
            ),
            10 =>
            array (
                'id' => 38,
                'name' => 'с. Малый Атлым',
                'fias_id' => '2efc44e5-26fe-4994-9da0-8f5bf8a1b47e',
            ),
            11 =>
            array (
                'id' => 39,
                'name' => 'д. Нижние Нарыкары',
                'fias_id' => '26bb0b2a-e70d-45da-b011-ebeced0e5423',
            ),
            12 =>
            array (
                'id' => 40,
                'name' => 'д. Чемаши',
                'fias_id' => 'b09a9284-a828-42d5-a1ba-1231b68793f1',
            ),
            13 =>
            array (
                'id' => 41,
                'name' => 'с. Шеркалы',
                'fias_id' => '4c865ee2-9cdf-47e1-8925-e63a22cf4cf8',
            ),
            14 =>
            array (
                'id' => 42,
                'name' => 'г. Покачи',
                'fias_id' => '8bac4b94-1d16-42b5-b5c6-211aa52f3216',
            ),
            15 =>
            array (
                'id' => 43,
                'name' => 'г. Пыть-Ях',
                'fias_id' => '130857a0-7059-4f18-9a13-c17ef6c4f9ca',
            ),
            16 =>
            array (
                'id' => 44,
                'name' => 'г. Радужный',
                'fias_id' => '394a840f-9502-406f-a8be-3a2aa9e8f075',
            ),
            17 =>
            array (
                'id' => 45,
                'name' => 'г. Советский',
                'fias_id' => 'b2487322-b3b1-48fc-a462-cf06c36fac91',
            ),
            18 =>
            array (
                'id' => 46,
                'name' => 'п. Пионерский',
                'fias_id' => '6088030d-af4a-4a0b-b11a-ac81c777fe1b',
            ),
            19 =>
            array (
                'id' => 47,
                'name' => 'п. Малиновский',
                'fias_id' => 'f90773f0-f512-4267-af95-93420b7083b6',
            ),
            20 =>
            array (
                'id' => 48,
                'name' => 'п. Алябьевский',
                'fias_id' => 'd96bfd4b-7e13-4064-b576-814bdbe2a79c',
            ),
            21 =>
            array (
                'id' => 49,
                'name' => 'п. Таежный',
                'fias_id' => '6e2d1272-7671-4502-80b7-ce5f4e3f63e2',
            ),
            22 =>
            array (
                'id' => 50,
                'name' => 'п. Коммунистический',
                'fias_id' => 'fc8c9bca-1787-4586-be9b-87a13c421bb1',
            ),
            23 =>
            array (
                'id' => 51,
                'name' => 'п. Агириш',
                'fias_id' => 'f9b29ac6-b63a-45e7-91a9-5eb35150059c',
            ),
            24 =>
            array (
                'id' => 52,
                'name' => 'п. Зеленоборск',
                'fias_id' => '7fd1a51b-121a-4178-a09e-da0b0ddcc938',
            ),
            25 =>
            array (
                'id' => 53,
                'name' => 'г. Сургут',
                'fias_id' => 'f1eb1809-47d4-4f0b-9a74-fa416e9d3df2',
            ),
            26 =>
            array (
                'id' => 54,
                'name' => 'п.г.т. Белый Яр',
                'fias_id' => '40f0b72c-ddf4-47a1-b6ee-f71cef8934a7',
            ),
            27 =>
            array (
                'id' => 55,
                'name' => 'п.г.т. Барсово',
                'fias_id' => 'c6eaf846-e511-4e3f-8155-297d8be651d7',
            ),
            28 =>
            array (
                'id' => 56,
                'name' => 'п. Солнечный',
                'fias_id' => '38c7b1a9-9c01-440a-8a09-2bafc9a7de50',
            ),
            29 =>
            array (
                'id' => 57,
                'name' => 'с.Сытомино',
                'fias_id' => 'df606358-1f72-42dc-b00e-ac8f00142f94',
            ),
            30 =>
            array (
                'id' => 58,
                'name' => 'д. Сайгатина',
                'fias_id' => '212369b1-5daf-4501-a4be-324cc5ea8848',
            ),
            31 =>
            array (
                'id' => 59,
                'name' => 'с.п. Локосово',
                'fias_id' => 'c79dd30b-5036-4e35-a9cd-fe4a8cac5c18',
            ),
            32 =>
            array (
                'id' => 60,
                'name' => 'п.г.т. Федоровский',
                'fias_id' => '8d8a72c7-bc8f-4d23-b831-89dffeebab16',
            ),
            33 =>
            array (
                'id' => 61,
                'name' => 'п. Нижнесортымский',
                'fias_id' => '2d140a6f-1497-4d96-a243-40cae29badfc',
            ),
            34 =>
            array (
                'id' => 62,
                'name' => 'д. Каюкова',
                'fias_id' => '50d84eec-d3fe-44ac-9a67-3717f6cf3a9d',
            ),
            35 =>
            array (
                'id' => 63,
                'name' => 'п. Тром-Аган',
                'fias_id' => 'a0955b7d-33a7-4903-80ec-59b791d89a13',
            ),
            36 =>
            array (
                'id' => 64,
                'name' => 'д. Русскинская',
                'fias_id' => 'c607ed5c-0cfe-4979-8103-a66ae0b64b88',
            ),
            37 =>
            array (
                'id' => 65,
                'name' => 'п. Ульт-Ягун',
                'fias_id' => 'f5d64a0f-2aa3-4daf-97bd-54d7d8f3643e',
            ),
            38 =>
            array (
                'id' => 66,
                'name' => 'д. Лямина',
                'fias_id' => '5da7b50d-be89-477d-928f-a7e036fb4528',
            ),
            39 =>
            array (
                'id' => 67,
                'name' => 'п. Высокий Мыс',
                'fias_id' => '14f8916e-b8a5-43b0-8ec5-36b5217e799a',
            ),
            40 =>
            array (
                'id' => 68,
                'name' => 'г. Лянтор',
                'fias_id' => 'e7e90d82-aecc-4e9c-a373-3a7afcd5fed3',
            ),
            41 =>
            array (
                'id' => 69,
                'name' => 'с. Угут',
                'fias_id' => '7e7c6fca-ba93-4852-a81c-31580afe0c85',
            ),
            42 =>
            array (
                'id' => 70,
                'name' => 'г. Урай',
                'fias_id' => '610abc14-c127-4d7c-8697-31cb5c7c47f2',
            ),
            43 =>
            array (
                'id' => 71,
                'name' => 'г. Ханты-Мансийск',
                'fias_id' => 'd680d1a9-ff89-42c0-b39f-143d2ffb520a',
            ),
            44 =>
            array (
                'id' => 72,
                'name' => 'с. Батово',
                'fias_id' => 'c641cf36-7142-4e2f-8b20-0760bf288369',
            ),
            45 =>
            array (
                'id' => 73,
                'name' => 'п. Бобровский',
                'fias_id' => '80737993-e5eb-46bd-a5f6-569048a90f3c',
            ),
            46 =>
            array (
                'id' => 74,
                'name' => 'п. Выкатной',
                'fias_id' => '16d3ffe9-864d-4f2f-81a6-be9ef2ea1ffe',
            ),
            47 =>
            array (
                'id' => 75,
                'name' => 'пгт. Горноправдинск',
                'fias_id' => 'a79f66a2-be07-47ae-b63e-c744bf08247a',
            ),
            48 =>
            array (
                'id' => 76,
                'name' => 'с. Елизарово',
                'fias_id' => '90ea7341-f43f-41f5-82f9-28f835d683f4',
            ),
            49 =>
            array (
                'id' => 77,
                'name' => 'п. Кедровый',
                'fias_id' => '4128ab40-c350-4667-950e-535d6f99dc3c',
            ),
            50 =>
            array (
                'id' => 78,
                'name' => 'п. Кирпичный',
                'fias_id' => '6db99080-94ee-417c-884f-6a2503c19b47',
            ),
            51 =>
            array (
                'id' => 79,
                'name' => 'п. Красноленинский',
                'fias_id' => '1e4e558a-c4b7-443a-8e8d-f8e0b8d6f6b3',
            ),
            52 =>
            array (
                'id' => 80,
                'name' => 'с. Кышик',
                'fias_id' => '82d6bcef-de9d-4003-8fd4-12dcf69d15e4',
            ),
            53 =>
            array (
                'id' => 81,
                'name' => 'п. Луговской',
                'fias_id' => '0c038a2f-f700-45b5-bd56-c3c6bcfd26e3',
            ),
            54 =>
            array (
                'id' => 82,
                'name' => 'с. Нялинское',
                'fias_id' => 'd68eba4a-ce3d-4a55-801a-e0f9a6eee396',
            ),
            55 =>
            array (
                'id' => 83,
                'name' => 'с. Селиярово',
                'fias_id' => '9b8da5f3-bc81-456e-9b1e-7a12fd0b1a5e',
            ),
            56 =>
            array (
                'id' => 84,
                'name' => 'п. Сибирский',
                'fias_id' => '392e9e43-02b1-4ec2-835f-4b58c4e32708',
            ),
            57 =>
            array (
                'id' => 85,
                'name' => 'д. Согом',
                'fias_id' => '14e56051-0de7-4155-bd18-3a415666e20a',
            ),
            58 =>
            array (
                'id' => 86,
                'name' => 'с. Троица',
                'fias_id' => '5d547ec2-39a1-428c-b7f1-9c868bf150dd',
            ),
            59 =>
            array (
                'id' => 87,
                'name' => 'с. Цингалы',
                'fias_id' => '39764d2e-c183-4901-9114-a20a42c255c5',
            ),
            60 =>
            array (
                'id' => 88,
                'name' => 'д. Шапша',
                'fias_id' => '781d0e2c-eba1-4184-ac24-cf60cc1ebc06',
            ),
            61 =>
            array (
                'id' => 89,
                'name' => 'д. Белогорье',
                'fias_id' => '95d6dae8-543e-4798-a54a-01e4f768dc92',
            ),
            62 =>
            array (
                'id' => 90,
                'name' => 'п. Пырьях',
                'fias_id' => 'b167b8e8-8166-4cd1-960a-ecb1a682ce92',
            ),
            63 =>
            array (
                'id' => 91,
                'name' => 'с. Реполово',
                'fias_id' => '5b20fabe-357e-4ce2-ad2c-46d84b6821ab',
            ),
            64 =>
            array (
                'id' => 92,
                'name' => 'д. Ягурьях',
                'fias_id' => 'e40779f0-119e-4d4a-aa80-5d8cc3959e7b',
            ),
            65 =>
            array (
                'id' => 93,
                'name' => 'с. Тюли',
                'fias_id' => '49046cd8-8bf5-441a-9156-da6f9e368554',
            ),
            66 =>
            array (
                'id' => 94,
                'name' => 'г. Югорск',
                'fias_id' => 'abb05e81-bd8b-4e44-abf7-384c9eba3407',
            ),
            67 =>
            array (
                'id' => 95,
                'name' => 'г. Белоярский',
                'fias_id' => 'db0b028c-2da0-4fb9-af00-6fed7a7644a0',
            ),
            68 =>
            array (
                'id' => 96,
                'name' => 'п. Сорум',
                'fias_id' => 'b7ff32d4-f904-4acd-b25c-103acba02381',
            ),
            69 =>
            array (
                'id' => 97,
                'name' => 'п. Сосновка',
                'fias_id' => 'ab56c6dd-f8a9-4489-b7d9-e60489e7daf9',
            ),
            70 =>
            array (
                'id' => 98,
                'name' => 'п. Лыхма',
                'fias_id' => '2966ef4e-47cd-4e2c-9c40-4ef6d6492d34',
            ),
            71 =>
            array (
                'id' => 99,
                'name' => 'п. Верхнеказымский',
                'fias_id' => '680690d1-42b3-4cce-9f22-e997ea2846c9',
            ),
            72 =>
            array (
                'id' => 100,
                'name' => 'с. Казым',
                'fias_id' => '9ff51e9f-49a0-4c1b-8fa3-e4bc459a73e7',
            ),
            73 =>
            array (
                'id' => 101,
                'name' => 'с. Полноват',
                'fias_id' => '9562a67c-ac9e-4819-a723-2cf83a3b3859',
            ),
            74 =>
            array (
                'id' => 102,
                'name' => 'с. Ванзеват',
                'fias_id' => '4ca96132-d7ee-46f3-ba00-e2ad69494580',
            ),
            75 =>
            array (
                'id' => 103,
                'name' => 'пгт. Березово',
                'fias_id' => 'e3314064-203c-4313-831c-4343a8090113',
            ),
            76 =>
            array (
                'id' => 104,
                'name' => 'д.Шайтанка',
                'fias_id' => 'a223ecd0-fb8e-4bde-b476-ad6a828b2491',
            ),
            77 =>
            array (
                'id' => 105,
                'name' => 'п. Ванзетур',
                'fias_id' => '5b630481-ff67-4550-9196-bc853aacd164',
            ),
            78 =>
            array (
                'id' => 106,
                'name' => 'пгт. Игрим',
                'fias_id' => 'd4c95a91-c31e-4b58-8181-37fde090ab1d',
            ),
            79 =>
            array (
                'id' => 107,
                'name' => 'с. Няксимволь',
                'fias_id' => 'c099270a-a561-4873-9bba-5c0b684edad4',
            ),
            80 =>
            array (
                'id' => 108,
                'name' => 'с. Саранпауль',
                'fias_id' => '715c061d-16ec-4590-b125-aab0bbee7a1d',
            ),
            81 =>
            array (
                'id' => 109,
                'name' => 'д. Щекурья',
                'fias_id' => '64e80fe0-cb0d-4ac8-b23e-e5617e4c3965',
            ),
            82 =>
            array (
                'id' => 110,
                'name' => 'д. Кимкьясуй',
                'fias_id' => '705781b4-8d2b-4b2d-8d73-a2cffa2f1e79',
            ),
            83 =>
            array (
                'id' => 111,
                'name' => 'с. Сосьва',
                'fias_id' => '947e1f0b-8390-49ee-87cb-11a89c275f04',
            ),
            84 =>
            array (
                'id' => 112,
                'name' => 'п. Светлый',
                'fias_id' => 'f8e990d6-7be9-4b9a-b1f5-478f24f4e54f',
            ),
            85 =>
            array (
                'id' => 113,
                'name' => 'д. Ломбовож',
                'fias_id' => '858608b8-0de0-4bb1-9b23-339c199180dd',
            ),
            86 =>
            array (
                'id' => 114,
                'name' => 'с. Теги',
                'fias_id' => 'ccac3c13-cd79-4792-8b55-1eac07088c60',
            ),
            87 =>
            array (
                'id' => 115,
                'name' => 'д. Хулимсунт',
                'fias_id' => '91c67b16-eb7f-40ce-b00c-9606f0c32fd4',
            ),
            88 =>
            array (
                'id' => 116,
                'name' => 'г. Когалым',
                'fias_id' => '5a08166f-cfaa-4e95-8233-f0d473883bd3',
            ),
            89 =>
            array (
                'id' => 117,
                'name' => 'п. Половинка',
                'fias_id' => '576832c3-a171-4423-8825-29f884cc7f54',
            ),
            90 =>
            array (
                'id' => 118,
                'name' => 'п. Ягодный',
                'fias_id' => 'b407e8dc-cada-4a0c-bbb6-d5c406f99607',
            ),
            91 =>
            array (
                'id' => 119,
                'name' => 'д. Ушья',
                'fias_id' => '9a659986-7484-4fd6-ab0c-fc96dcd39354',
            ),
            92 =>
            array (
                'id' => 120,
                'name' => 'пгт. Междуреченский',
                'fias_id' => 'aa3674a5-c508-4997-96b3-bbb4aa02ebbf',
            ),
            93 =>
            array (
                'id' => 121,
                'name' => 'пгт. Куминский',
                'fias_id' => '6b727d73-125b-45b3-9623-9d7c6fc8e46e',
            ),
            94 =>
            array (
                'id' => 122,
                'name' => 'пгт. Кондинское',
                'fias_id' => '888e75bf-abe4-4111-9847-fea69a7a5833',
            ),
            95 =>
            array (
                'id' => 123,
                'name' => 'пгт. Мортка',
                'fias_id' => 'eff4b71e-fbf7-4431-ad31-7f18b71759b1',
            ),
            96 =>
            array (
                'id' => 124,
                'name' => 'пгт. Луговой',
                'fias_id' => '845a0705-3a03-45da-84b7-f91354187ab7',
            ),
            97 =>
            array (
                'id' => 125,
                'name' => 'с. Болчары',
                'fias_id' => '307a7181-9928-4a9a-b27c-16412e1fc96e',
            ),
            98 =>
            array (
                'id' => 126,
                'name' => 'п. Мулымья',
                'fias_id' => 'd432db10-7469-4104-9e43-30283d0b8f03',
            ),
            99 =>
            array (
                'id' => 127,
                'name' => 'д. Юмас',
                'fias_id' => '5ea03db5-cf2b-4e3e-a3d4-371e683851e4',
            ),
            100 =>
            array (
                'id' => 128,
                'name' => 'д. Шугур',
                'fias_id' => 'd13dd45f-7b95-4327-921f-c60de216f2bf',
            ),
            101 =>
            array (
                'id' => 129,
                'name' => 'с. Леуши',
                'fias_id' => '79924178-2b9c-438a-b99b-6f79aa996714',
            ),
            102 =>
            array (
                'id' => 130,
                'name' => 'с. Алтай',
                'fias_id' => '1c54dd0b-bbb7-4ca7-b5e7-2422fa151187',
            ),
            103 =>
            array (
                'id' => 131,
                'name' => 'с. Чантырья',
                'fias_id' => '6c1c15b6-f980-410d-a16c-01b4b0b5e9b0',
            ),
            104 =>
            array (
                'id' => 132,
                'name' => 'г. Лангепас',
                'fias_id' => '149e651b-5dd3-480f-a372-5174576609f6',
            ),
            105 =>
            array (
                'id' => 133,
                'name' => 'г. Мегион',
                'fias_id' => 'd9c157ca-fd05-4efc-ae0c-16927612a0c8',
            ),
            106 =>
            array (
                'id' => 134,
                'name' => 'г. Нефтеюганск',
                'fias_id' => '45906532-143b-48c2-9af3-f480dc19c7bf',
            ),
            107 =>
            array (
                'id' => 135,
                'name' => 'пгт. Пойковский',
                'fias_id' => 'ad051be5-c8b7-4d98-b7b0-4365e4fdfd7d',
            ),
            108 =>
            array (
                'id' => 136,
                'name' => 'п. Юганская Обь',
                'fias_id' => '5b5b260c-37c1-4bc6-9905-06f5bcdf96eb',
            ),
            109 =>
            array (
                'id' => 137,
                'name' => 'с. Лемпино',
                'fias_id' => 'abb59097-1dbe-4782-a16e-7a6b82cbb8c2',
            ),
            110 =>
            array (
                'id' => 138,
                'name' => 'п. Салым',
                'fias_id' => 'fb5f6c50-a185-431d-aa69-fa84fa8e3f0a',
            ),
            111 =>
            array (
                'id' => 139,
                'name' => 'п. Куть-Ях',
                'fias_id' => '7cdc4ffd-e737-4a9a-863e-852b7a8424d0',
            ),
            112 =>
            array (
                'id' => 140,
                'name' => 'п. Усть-Юган',
                'fias_id' => '8268c326-52f9-4843-9951-0efadf52921f',
            ),
            113 =>
            array (
                'id' => 141,
                'name' => 'с. Чеускино',
                'fias_id' => '9375ee73-fdcc-4136-96e6-84f52caed40b',
            ),
            114 =>
            array (
                'id' => 142,
                'name' => 'п. Сентябрьский',
                'fias_id' => 'bbcff38e-6646-4e0d-80b4-cb16e2a2be69',
            ),
            115 =>
            array (
                'id' => 143,
                'name' => 'п. Сингапай',
                'fias_id' => '016cc7aa-468b-4560-ac0b-2618c04f09f8',
            ),
            116 =>
            array (
                'id' => 144,
                'name' => 'п. Каркатеевы',
                'fias_id' => '50cc3474-0f61-4eff-afa2-9535d6f96a35',
            ),
            117 =>
            array (
                'id' => 145,
                'name' => 'г. Нижневартовск',
                'fias_id' => '0bf0f4ed-13f8-446e-82f6-325498808076',
            ),
            118 =>
            array (
                'id' => 146,
                'name' => 'п. Аган',
                'fias_id' => '7da55fe9-4830-4a1d-8b06-232b118f213a',
            ),
            119 =>
            array (
                'id' => 147,
                'name' => 'с. Большетархово',
                'fias_id' => 'cef36edf-c8f7-474d-a3e6-17573924be26',
            ),
            120 =>
            array (
                'id' => 148,
                'name' => 'д. Вата',
                'fias_id' => '91e27416-360a-4e1a-aef6-be21d69ff97f',
            ),
            121 =>
            array (
                'id' => 149,
                'name' => 'п. Ваховск',
                'fias_id' => 'c757c8e4-5a19-4ef4-9303-4ee144c6f01c',
            ),
            122 =>
            array (
                'id' => 150,
                'name' => 'п. Зайцева Речка',
                'fias_id' => '066da0c0-9b11-43e5-917f-c351e18ce857',
            ),
            123 =>
            array (
                'id' => 151,
                'name' => 'пгт. Излучинск',
                'fias_id' => 'd6c7f92f-3537-4b5d-b4c8-be8dd97101b4',
            ),
            124 =>
            array (
                'id' => 152,
                'name' => 'с. Корлики',
                'fias_id' => 'ee5884c3-4dd9-42dd-9542-e8f704a2c852',
            ),
            125 =>
            array (
                'id' => 153,
                'name' => 'с. Ларьяк',
                'fias_id' => '26fab781-6726-4da3-9b96-07fe3edd74a8',
            ),
            126 =>
            array (
                'id' => 154,
                'name' => 'пгт. Новоаганск',
                'fias_id' => '017d3cdb-0584-4ad3-943f-3cc5eec27411',
            ),
            127 =>
            array (
                'id' => 155,
                'name' => 'с. Охтеурье',
                'fias_id' => 'd77ac5d7-461f-4fde-9bb4-3028366ec592',
            ),
            128 =>
            array (
                'id' => 156,
                'name' => 'с. Покур',
                'fias_id' => '3cfb0a60-f45c-44c5-bd2c-f58fdc87a9d0',
            ),
            129 =>
            array (
                'id' => 157,
                'name' => 'с. Варьеган',
                'fias_id' => '3dcc3e84-518a-4b33-90d2-fb322a084fe6',
            ),
            130 =>
            array (
                'id' => 158,
                'name' => 'д. Чехломей',
                'fias_id' => '18b9ce52-c79f-4133-97a9-c19a0d4b1e0f',
            ),
            131 =>
            array (
                'id' => 159,
                'name' => 'г. Нягань',
                'fias_id' => '06157075-a993-404d-b940-0a103131dc66',
            ),
            132 =>
            array (
                'id' => 160,
                'name' => 'пгт. Приобье',
                'fias_id' => '780f72f3-633b-4899-8af6-c918cab0c006',
            ),
            133 =>
            array (
                'id' => 161,
                'name' => 'пгт. Октябрьское',
                'fias_id' => '1829e55c-c03c-463f-8c44-73f672985596',
            ),
            134 =>
            array (
                'id' => 162,
                'name' => 'п. Приполярный',
                'fias_id' => '9c9f7faa-d69d-4025-b313-2715fbe2c91c',
            ),
            135 =>
            array (
                'id' => 165,
                'name' => 'п. Высокий',
                'fias_id' => 'f80c29a0-09a7-4b9d-9b20-637e9e139430',
            ),
        ));


    }
}
