<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class IncomeAddedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $income;

    public function __construct($income)
    {
        $this->income = $income;
    }

    public function build()
    {
        return $this->subject('New Income Added')
            ->view('emails.income_added');
    }
}
