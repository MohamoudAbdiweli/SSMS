<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class WithdrawalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $withdrawal;

    public function __construct($withdrawal)
    {
        $this->withdrawal = $withdrawal;
    }

    public function build()
    {
        return $this->subject('Withdrawal Receipt')
            ->view('emails.withdrawal');
    }
}
