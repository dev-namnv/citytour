<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuideLog extends Model
{
    protected $table = 'guide_logs';

    protected $fillable = [
        'guide_id',
        'tour_id',
        'busy_start_at',
        'busy_end_at'
    ];
}
