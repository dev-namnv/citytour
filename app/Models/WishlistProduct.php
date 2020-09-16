<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistProduct extends Model
{
    protected $table = 'wishlist_product';

    /**
     * Eloquent wishlist product
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
