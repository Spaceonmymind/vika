<?php

namespace Modules\Chat\Services\Max;

class MaxMessageBuilder
{
    private string $text = '';
    private array $buttons = [];

    public function addWebAppButton(string $text, ?string $payload = null): self
    {
        $this->buttons[] = [
            [
                'type' => 'open_app',
                'text' => $text,
                'web_app' => config('services.max.web_app_base_url'),
                'payload' => $payload,
            ],
        ];
        return $this;
    }

    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function addLinkButton(string $text, ?string $url): self
    {
        $this->buttons[] = [
            [
                'type' => 'link',
                'text' => $text,
                'url' => $url,
            ],
        ];
        return $this;
    }

    public function get(): array
    {
        $result['text'] = $this->text;
        if (!empty($this->buttons)) {
            $result['attachments'] = [
                [
                    'type' => 'inline_keyboard',
                    'payload' => ['buttons' => $this->buttons],
                ],
            ];
        }
        $result['format'] = 'html';
        return $result;
    }
}
