<?php

namespace App\Mail;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $invoice;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @param Invoice $invoice
     * @param User $user
     */
    public function __construct(User $user, Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoice = $this->invoice;
        $user = $this->user;
        return $this->from(env('MAIL_USERNAME'))
            ->subject('[CITY TOURS] City Tours gửi bạn thông tin hóa đơn')
            ->view('Main.invoice.detail', compact('invoice', 'user'));
    }
}
