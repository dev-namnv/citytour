<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistService extends Model
{
    protected $table = 'wishlist_service';

    protected $fillable = [
        'service_id', 'user_id'
    ];

    /**
     * Eloquent wishlist product
     */
    public function services()
    {
        return $this->belongsTo('App\Models\Services');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
