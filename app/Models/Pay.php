<?php

namespace App\Models;

use App\Casts\Currency;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $table = 'pays';

    protected $fillable = ['invoice_id', 'type', 'cost', 'url'];

    protected $casts = [
        'cost' => Currency::class
    ];
}
