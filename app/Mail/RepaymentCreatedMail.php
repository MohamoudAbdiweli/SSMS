<?php

namespace App\Mail;

use App\Models\Repayments;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RepaymentCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $repayment;

    /**
     * Create a new message instance.
     */
    public function __construct(Repayments $repayment)
    {
        $this->repayment = $repayment;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Loan Repayment Received')
            ->markdown('emails.repayments')
            ->with([
                'repayment' => $this->repayment,
            ]);
    }
}
