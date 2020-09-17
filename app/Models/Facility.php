<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facilities';

    /**
     * Eloquent facility
     */
    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'relation_service_facility', 'facility_id', 'service_id');
    }
}
