<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    protected $table = 'invoice_product_detail';

    /**
     * Eloquent invoice product
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
