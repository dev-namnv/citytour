<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    protected $table = 'partners';

    use SoftDeletes;

    /**
     * Eloquent partner
     */
    public function employees()
    {
        return $this->belongsToMany('App\Models\User', 'staffs', 'partner_id', 'user_id');
    }
}
