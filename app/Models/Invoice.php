<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    /**
     * TODO: Convert data
     *
     * @var integer string
     */
    public function getType()
    {
        $masterData = config('masterdata')['invoice'];
        return $masterData['type'][$this->type];
    }

    /**
     * Eloquent invoice
     */
    public function service_detail()
    {
        return $this->hasMany('App\Models\InvoiceService');
    }

    public function product_detail()
    {
        return $this->hasMany('App\Models\InvoiceProduct');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
