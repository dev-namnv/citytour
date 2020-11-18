<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourLog extends Model
{
    protected $table = 'tour_logs';

    protected $fillable = [
        'tour_id', 'user_id'
    ];

    /**
     * Relation service log
     */
    public function tour()
    {
        return $this->belongsTo('App\Models\Tour');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
