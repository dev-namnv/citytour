<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RefundPayment extends Mailable
{
    use Queueable, SerializesModels;

    protected $pay;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pay)
    {
        $this->pay = $pay;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pay = $this->pay;
        return $this->from(env('MAIL_USERNAME'))
            ->subject('[CITY TOURS] Người dùng yêu cầu hoàn tiền')
            ->view('mail.refundPayment', compact('pay'));
    }
}
