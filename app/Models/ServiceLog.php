<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceLog extends Model
{
    protected $table = 'service_logs';

    /**
     * Relation service log
     */
    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
