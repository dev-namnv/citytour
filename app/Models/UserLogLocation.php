<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLogLocation extends Model
{
    protected $table = 'user_log_location';
    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'ip'
    ];

    /**
     * Eloquent user log
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
