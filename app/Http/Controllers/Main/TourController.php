<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{

    public function index($param = 'lists')
    {
        $tours = Tour::query()->with('category','reviews','schedules')
            ->with(['batches' => function ($q) {
                $q->select()->where('batch','>',date('Y-m-d'));
            }])
            ->paginate(PAGINATION_TOUR);
        $categories = Category::query()->get();
        if ($param == 'list-grid') {
            return view('Main.tour.list-grid', compact('tours','categories'));
        }
        return view('Main.tour.list', compact('tours','categories'));
    }

    public function show($slug)
    {
        $service = Tour::query()->with('album','reviews')
            ->where('slug',$slug)
            ->first();
//        dd($service->schedule);
        return view('Main.tour.detail', compact('service'));
    }

}
