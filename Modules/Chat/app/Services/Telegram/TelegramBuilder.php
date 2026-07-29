<?php

namespace Modules\Chat\Services\Telegram;

class TelegramBuilder
{
    private string $text;
    private array $buttons = [];

    /**
     * Задать заголовок сообщения
     * @param string $text
     * @return $this
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Добавить кнопку в сообщение в новой строке
     * @param string $label
     * @param string|null $callbackData
     * @param string|null $url
     * @param string|null $web_app_url
     * @return $this
     */
    public function addButton(string $label, ?string $callbackData = null, ?string $url = null, ?string $web_app_url = null): self
    {
        $params = ['text' => $label,];

        if (!empty($url)) {
            $params['url'] = $url;
        }
        if (!empty($callbackData)) {
            $params['callback_data'] = $callbackData;
        }

        if (!empty($web_app_url)) {
            $params['web_app'] = ['url' => $web_app_url,];
        }

        $this->buttons[] = [$params];
        return $this;
    }

    /**
     * Добавить новую строку с кнопками ($builder - это новый экземпляр, который содержит кнопки)
     * @param TelegramBuilder $builder
     * @return $this
     */
    public function addButtonsRow(TelegramBuilder $builder): self
    {
        $buttons = $builder->getButtons();

        $this->buttons[] = array_merge(...$buttons);
        return $this;
    }

    /**
     * @return array
     */
    public function getButtons(): array
    {
        return $this->buttons;
    }

    /**
     * Получить данные для отправки в виде массива
     * @return array
     */
    public function get(): array
    {
        return [
            'text' => $this->text,
            'parse_mode' => 'HTML',
            'reply_markup' => ['inline_keyboard' => $this->buttons]
        ];
    }
}
