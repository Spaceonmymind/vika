<?php

namespace Modules\Admin\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordChanged extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct() {
        $this->subject('Пароль учетной записи был изменён');
    }


    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->view('admin::mails.password-changed');
    }
}
