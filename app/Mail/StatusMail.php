<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $tour;
    protected $users;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tour,$users)
    {
        $this->tour = $tour;
        $this->users = $users;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $users = $this->users;
        $tour = $this->tour;
        return $this->from(env('MAIL_USERNAME'))
            ->subject('[CITY TOURS] Yêu cầu đánh dấu hoàn tất lịch trình trong ngày')
            ->view('mail.scheduleStatus',compact('users','tour'));
    }
}
