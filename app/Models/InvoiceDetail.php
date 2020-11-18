<?php

namespace App\Models;

use App\Casts\Currency;
use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $table = 'invoice_detail';

    /**
     * Convert data
     */
    protected $casts = [
        'schedule' => Json::class,
        'adult_price' => Currency::class,
        'child_price' => Currency::class
    ];

    /**
     * Eloquent invoice service
     */
    public function tour()
    {
        return $this->belongsTo('App\Models\Tour');
    }
}
