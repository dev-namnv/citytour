<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'name', 'icon', 'description'
    ];

    /**
     * Eloquent service
     */
    public function tours()
    {
        return $this->belongsToMany('App\Models\Tour', 'relation_tour_service', 'service_id', 'tour_id');
    }
}
