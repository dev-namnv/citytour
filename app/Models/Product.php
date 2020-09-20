<?php

namespace App\Models;

use App\Casts\Currency;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    /**
     * TODO: Convert data
     *
     * @var string[]
     */
    protected $casts = [
        'active' => 'boolean',
        'origin_price' => Currency::class,
        'price' => Currency::class
    ];

    /**
     * Get sale & convert into current
     */
    public function getCurrentPrice()
    {
        if (!$this->price) {
            return $this->origin_price;
        }
        return $this->price;
    }

    /**
     * Add active scope in query
     */
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }

    /**
     * Eloquent product
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\ProductCategory', 'relation_product_category', 'product_id', 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\ProductReview');
    }

    public function partner()
    {
        return $this->belongsTo('App\Models\Partner', 'partner_id', 'id');
    }
}
