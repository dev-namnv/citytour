<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelationProductCategory extends Model
{
    protected $table = 'relation_product_category';

    protected $fillable = [
        'product_id', 'category_id'
    ];
}
