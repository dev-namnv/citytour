<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = 'user_logs';

    /**
     * Eloquent user log
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
