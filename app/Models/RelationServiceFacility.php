<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelationServiceFacility extends Model
{
    protected $table = 'relation_service_facility';

    protected $fillable = [
        'service_id', 'facility_id'
    ];
}
