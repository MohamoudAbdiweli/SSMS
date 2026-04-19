<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Deposit;

class DepositReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $deposit;

    public function __construct(Deposit $deposit)
    {
        $this->deposit = $deposit;
    }

    public function build()
    {
        return $this->subject('Your Deposit Receipt')
            ->view('emails.deposit_receipt');
    }
}
