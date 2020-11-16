<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceService extends Model
{
    protected $table = 'invoice_service_detail';

    protected $fillable = [
        'invoice_id', 'service_id', 'amount_of_people'
    ];

    /**
     * Eloquent invoice service
     */
    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }
}
