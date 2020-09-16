<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staffs';

    /**
     * Eloquent
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
