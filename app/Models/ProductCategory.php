<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    /**
     * TODO: Convert data
     *
     * @var string[]
     */
    protected $casts = [
        'active' => 'boolean'
    ];

    /**
     * Add active scope in query
     */
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }
}
