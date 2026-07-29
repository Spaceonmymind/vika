<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ChatIntentHandlersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        \DB::table('chat_intent_handlers')->delete();

        \DB::table('chat_intent_handlers')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => 'default',
                'name' => 'Стандартный',
                'class' => 'Modules\\Chat\\IntentHandlers\\DefaultChatHandler',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => 'actirovki',
                'name' => 'С ответом для актировок в чат',
                'class' => 'Modules\\Chat\\IntentHandlers\\ActirovkiChatHandler',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => 'llm',
                'name' => 'С формированием ответа в LLM',
                'class' => 'Modules\\Chat\\IntentHandlers\\AnswerFromLLMChatHandler',
            ),
            3 =>
            array (
                'id' => 4,
                'code' => 'llm_with_prompt',
                'name' => 'С формированием ответа в LLM из документа',
                'class' => 'Modules\\Chat\\IntentHandlers\\AnswerFromLLMWithPromptChatHandler',
            ),
        ));
        Schema::enableForeignKeyConstraints();

    }
}
