<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
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
}
