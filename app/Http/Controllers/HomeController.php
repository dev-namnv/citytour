<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Http\Requests\Mails\ContactRequest;
use App\Jobs\sendContact;
use Illuminate\Http\Request;
=======
>>>>>>> develop

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
        return view('home');
    }


}
