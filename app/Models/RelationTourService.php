<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelationTourService extends Model
{
    protected $table = 'relation_tour_service';

    protected $fillable = [
        'tour_id', 'service_id'
    ];
}
