<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'avatar',
        'birthday',
        'address',
        'city',
        'zipcode',
        'country',
        'google_map',
        'status',
        'behavior_score',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean'
    ];


    /**
     * Get full name
     *
     * @return string
     */
    public function getFullName()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getRole()
    {
        $masterData = config('masterdata')['role'];
        return $masterData[$this->role];
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comment()
    {
        return $this->hasOne(ArticleComment::class, 'user_id');
    }

    public function wishlists()
    {
        return $this->belongsToMany('App\Models\Tour', 'wishlists', 'user_id', 'tour_id');
    }

    public function tours()
    {
        return $this->hasMany('App\Models\Tour', 'guide_id');
    }

    public function busyTime()
    {
        return $this->hasMany('App\Models\GuideLog', 'guide_id');
    }

    public function identity()
    {
        return $this->hasOne(IdentityImage::class, 'guide_id');
    }
}
