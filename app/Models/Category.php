<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 'icon', 'description', 'sort_order'
    ];

    /**
     * TODO: Convert data
     *
     * @var string[]
     */
    protected $casts = [
        //
    ];

    /**
     * Relation
     */
    public function tours()
    {
        return $this->hasMany('App\Models\Tour');
    }
}
