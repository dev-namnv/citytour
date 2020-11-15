<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function analytic()
    {
        return view('Manager.dashboard.analytic');
    }

    public function sale()
    {
        return view('Manager.dashboard.sale');
    }

    public function profile()
    {
        $profile = User::all();
        return view('Manager.dashboard.profile', ['profile' => $profile]);
    }
    public function detailProfile($id)
    {
        $profile = User::find($id);
        return view('Manager.dashboard.profiledetail', ['profile' => $profile]);
    }
}
