<?php

namespace App\Helpers;

use App\Models\User;

class UserHelper
{
    public static function countUsers()
    {
        return User::query()->where('role', USER)->get()->count();
    }
}
