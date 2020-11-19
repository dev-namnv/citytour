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
        'deposit_cost',
        'vat_cost',
        'total_cost',
        'address',
        'email',
        'message',
        'status',
        'payment_type',
        'payment_status',
        'tour_id',
        'guide_id',
        'user_id',
        'start_date',
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

    public function getColor()
    {
        $masterData = config('masterdata')['invoice'];
        return$masterData['color'][$this->status];
    }

    /**
     * Eloquent invoice
     */
    public function invoice_detail()
    {
        return $this->hasOne('App\Models\InvoiceDetail');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function guide()
    {
        return $this->belongsTo('App\Models\User','guide_id');
    }

    public function tour()
    {
        return $this->belongsTo('App\Models\Tour','tour_id');
    }
}
