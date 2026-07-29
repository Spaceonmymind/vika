<?php

namespace Modules\Admin\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $email;
    public string $token;

    /**
     * Create a new message instance.
     */
    public function __construct(string $email, string $token) {
        $this->email = $email;
        $this->token = $token;
        $this->subject('Ссылка для сброса пароля');
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->view('admin::mails.reset-password');
    }
}
