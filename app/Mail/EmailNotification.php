<?php

namespace App\Mail;

use App\Http\Retail\Notification\Dto\EmailNotificationDto;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class EmailNotification extends Mailable
{
    use Queueable, SerializesModels;
    private $emailNotificationDto=null;

    /**
     * Create a new message instance.
     *
     * @param EmailNotificationDto $emailNotificationDto
     */
    public function __construct(EmailNotificationDto $emailNotificationDto)
    {
        $this->emailNotificationDto=$emailNotificationDto;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.email')->subject($this->emailNotificationDto->getSub());
    }
}
