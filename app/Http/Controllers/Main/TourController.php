<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{

    public function index($param = 'lists')
    {
        $tours = Tour::query()->with('category','services')
            ->paginate(PAGINATION_TOUR);
        $categories = Category::query()->get();
        if ($param == 'list-grid') {
            return view('Main.tour.list-grid', compact('tours','categories'));
        }
        return view('Main.tour.list', compact('tours','categories'));
    }

    public function show($slug)
    {
        $tour = Tour::query()->with('album','reviews','category','schedules')
            ->with(['batches'=>function($q){
                $q->where('batch','>',now())->select();
            }])
            ->where('slug',$slug)
            ->first();
        $invoices = Invoice::query()->where('tour_id',$tour->id)
            ->where('start_date',$tour->batches->first()->batch)
            ->get(['adult_count','child_count']);
        $customer_total = $invoices->sum('adult_count') + $invoices->sum('child_count');
        return view('Main.tour.detail', compact('tour','customer_total'));
    }

}
