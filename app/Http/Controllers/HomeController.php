<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contacts\SendContactRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tour;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @return Renderable
     */
    public function index()
    {
        $tours = Tour::query()
            ->withCount(['populars as top' => function ($q) {
                $q->select(DB::raw("COUNT('payment_log.id') AS top"));
            }])->orderBy('top', 'desc')
            ->withCount(['reviews as rating' => function ($q) {
                $q->select(DB::raw('coalesce(avg(star),0)'));
            }])->orderBy('rating', 'desc')->limit(9)->get();
        $categories = Category::all()->chunk(3);

        $tour_min = Tour::query()
            ->withCount(['reviews as rating' => function ($q) {
                $q->select(DB::raw('coalesce(avg(star),0)'));
            }])->orderBy('rating', 'desc')
            ->orderBy('adult_price', 'asc')->first();

        $articles = Article::query()->inRandomOrder()->limit(4)->get();

        return view('home', compact('tours', 'categories', 'tour_min', 'articles'));
    }


}
