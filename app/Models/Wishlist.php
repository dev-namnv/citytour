<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlistS';

    protected $fillable = [
        'tour_id', 'user_id'
    ];
}
