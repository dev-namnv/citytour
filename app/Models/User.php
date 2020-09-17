<?php

namespace App\Models;

use App\Scopes\ActiveScope;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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

    /**
     * Eloquent staff partner
     */
    public function partner()
    {
        return $this->belongsToMany('App\Models\Partner', 'staffs', 'user_id', 'partner_id');
    }

    public function getPartner()
    {
        return $this->partner[0];
    }
}
