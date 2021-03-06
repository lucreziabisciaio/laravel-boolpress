<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSiteContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $newContactInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_newContactInfo)
    {
        $this->newContactInfo = $_newContactInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Nuovo contatto da " . $this->newContactInfo->name)
        ->view('mails.newSiteContact');
    }
}
