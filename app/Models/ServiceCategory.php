<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'service_categories';

    protected $fillable = [
        'name', 'slug', 'sort_order'
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
    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }
}
