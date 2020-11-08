<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $table = 'invoice_detail';

    /**
     * Eloquent invoice service
     */
    public function tour()
    {
        return $this->belongsTo('App\Models\Tour');
    }
}
