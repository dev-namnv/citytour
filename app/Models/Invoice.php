<?php

namespace App\Models;

use App\Casts\Currency;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'name',
        'sub_cost',
        'vat_cost',
        'total_cost',
        'address',
        'email',
        'message',
        'status',
        'payment_type',
        'payment_status'
    ];

    /**
     * TODO: Convert data
     *
     * @return mixed
     * @var integer string
     */

    public function getStatus()
    {
        $masterData = config('masterdata')['invoice'];
        return $masterData['status'][$this->status];
    }

    public function getPaymentStatus()
    {
        $masterData = config('masterdata')['invoice'];
        return $masterData['status'][$this->payment_status];
    }

    /**
     * TODO: Convert data
     *
     * @var string[]
     */
    protected $casts = [
        'sub_cost' => Currency::class,
        'vat_cost' => Currency::class,
        'total_cost' => Currency::class
    ];

    /**
     * Eloquent invoice
     */
    public function invoice_detail()
    {
        return $this->hasOne('App\Models\InvoiceDetail');
    }


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
