<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';

    protected $fillable = [
        'title', 'heading', 'image', 'description', 'button', 'frame', 'sort_order', 'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    /**
     * Add active scope in query
     */
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }
}
