<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentityImage extends Model
{
    protected $table = 'identity_images';
    protected $fillable = ['front_image', 'back_image', 'guide_id'];

    public function guide()
    {
        return $this->belongsTo(User::class, 'guide_id');
    }
}
