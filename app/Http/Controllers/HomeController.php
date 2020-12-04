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
        $tour = Tour::where('active', '=', 1)->limit(13)->get();
        $tour1 = Tour::where('active', '=', 1)->count();
        $tour=  $tour->chunk(9);
        return view('home',['main' => $tour[0], 'tour' => $tour[1], 'tour1' => $tour1]);
    }


}
