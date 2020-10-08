<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $table = 'product_reviews';

    protected $fillable = [
        'content', 'star', 'active', 'user_id'
    ];

    /**
     * Add active scope in query
     */
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }

    /**
     * Eloquent product review
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
