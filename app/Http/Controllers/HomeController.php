<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contacts\SendContactRequest;
use App\Models\Tour;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tour = Tour::where('active', '=', 1)->limit(13)->get()->toArray();
        $tour = array_chunk($tour,9);
        return view('home',['main' => $tour[0],'tour' => $tour[1]]);
    }


}
