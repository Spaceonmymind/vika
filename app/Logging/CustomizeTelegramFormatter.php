<?php

namespace App\Logging;

use Monolog\Formatter\FormatterInterface;
use Monolog\LogRecord;

class CustomizeTelegramFormatter implements FormatterInterface
{
    private array $emojis = [
        'DEBUG' => '🐞',
        'INFO' => 'ℹ️',
        'NOTICE' => '📌',
        'WARNING' => '⚠️',
        'ERROR' => '❗️️',
        'CRITICAL' => '💀',
        'ALERT' => '🛎️',
        'EMERGENCY' => '🚨',
    ];

    private string $dateFormat = "Y-m-d H:i:s";

    public function format(LogRecord $record): string
    {
        $br = '&#10;&#10;'; //<br> не воспринимается телегой, выдаёт ошибку, поэтому вставляю код
        $emoji = $this->emojis[$record['level_name']] ?? $this->emojis['DEFAULT'] ?? '🐞';
        $formattedDate = $record['datetime']->format($this->dateFormat);

        $text = "$emoji <b>$formattedDate</b>  {$record['channel']}.{$record['level_name']} {$record['message']}" . $br;

        // Дополнительно обработайте контекстные данные, если они есть
        if (isset($record['context']['dataset_url'])) {
            $text .= "<b>URL:</b> {$record['context']['dataset_url']}" . $br;
        }
        if (isset($record['context']['class'])) {
            $text .= "<b>Класс:</b> {$record['context']['class']}" . $br;
        }
        if (isset($record['context']['error'])) {
            $text .= "❌ <b>Ошибка:</b> {$record['context']['error']}  $br";
        }
        if (isset($record['context']['status_code'])) {
            if ($record['context']['status_code'] == 200 || $record['context']['status_code'] == 201) {
                $statusEmoji = '✅';
            } else {
                $statusEmoji = '❌';
            }
            $text .= "$statusEmoji <b>Статус-код:</b> {$record['context']['status_code']}  $br";
        }
        if (isset($record['context']['response'])) {
            $text .= "<b>Ответ сервиса:</b> {$record['context']['response']} . $br";
        }
        //Контекст из AbstractSourceHandler
        if (isset($record['context']['errors'])) {
            $text .= "❌ <b>Ошибки:</b> {$record['context']['errors']} . $br";
        }
        // Вернёт весь набор данных, где произошла ошибка
//        if (isset($record['context']['dataSet'])) {
//            $text .= "<b>Датасет:</b> {$record['context']['dataSet']} . $br";
//        }
        if (isset($record['context']['newFields'])) {
            $text .= implode(', ', $record['context']['newFields']) . $br;
        }
        if (isset($record['context']['row'])) {
            $text .= "<b>Строка номер:</b> {$record['context']['row']} . $br";
        }
        if (isset($record['context']['handler'])) {
            $text .= "<b>Обработчик:</b> {$record['context']['handler']} . $br";
        }

        //Для табеля
        if (isset($record['context']['organization_global_id'])) {
            $text .= "<b>GUID организации:</b> {$record['context']['organization_global_id']} . $br";
        }

        if (isset($record['context']['organization_name'])) {
            $text .= "<b>Наименование организации:</b> {$record['context']['organization_name']} . $br";
        }
        return $text;
    }

    public function formatBatch(array $records): string
    {
        $result = '';
        foreach ($records as $record) {
            $result .= $this->format($record) . "\n";
        }
        return $result;
    }
}
