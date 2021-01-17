<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckStatus extends Model
{
    protected $table = 'checked';

    public function status() {
        return $this->belongsTo('App\Models\Schedule','schedule_id','id');
    }
}
