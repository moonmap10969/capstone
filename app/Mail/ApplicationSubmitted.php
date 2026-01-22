<?php

namespace App\Mail;

use App\Models\Admission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $admission;

    /**
     * Create a new message instance.
     */
    public function __construct(Admission $admission)
    {
        $this->admission = $admission;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Your FUMCES Application has been Submitted')
            ->view('emails.application_submitted');
    }
}
