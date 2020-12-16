<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $profile = User::query()->paginate(10);
        return view('Manager.profile.profile', ['profile' => $profile]);
    }
    public function detailProfile($id)
    {
        $profile = User::find($id);
        return view('Manager.profile.profiledetail', ['profile' => $profile]);
    }
}
