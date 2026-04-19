<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Saving;

class SavingCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $saving;

    /**
     * Create a new message instance.
     *
     * @param Saving $saving
     */
    public function __construct(Saving $saving)
    {
        $this->saving = $saving;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('SACCO Saving Account Created')
            ->view('emails.saving_receipt');
    }
}
