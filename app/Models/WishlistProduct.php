<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistProduct extends Model
{
    protected $table = 'wishlist_product';

    protected $fillable = [
        'product_id', 'user_id'
    ];

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
