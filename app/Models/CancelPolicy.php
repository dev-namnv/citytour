<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CancelPolicy extends Model
{
    protected $table = 'cancel_policies';

    protected $fillable = [
        'name',
        'refunds',
        'behavioral_points_deduction'
    ];
}
