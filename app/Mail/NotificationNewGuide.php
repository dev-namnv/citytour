<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationNewGuide extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user= $this->user;
        return $this->from(env('MAIL_USERNAME'))
            ->subject('[CITY TOURS] Ghi nhận có người đăng ký làm hướng dẫn viên')
            ->view('mail.notifyNewGuide', compact('user'));
    }
}
