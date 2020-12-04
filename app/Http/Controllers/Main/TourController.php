<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Tour;
use Carbon\Carbon;

class TourController extends Controller
{

    public function index($param = 'lists')
    {
        $tours = Tour::query()->with('category','reviews','schedules')
            ->with(['batches' => function ($q) {
                $q->select()->where('batch','>',date('Y-m-d'));
            }])
            ->orderBy('created_at','desc')
            ->paginate(PAGINATION_TOUR);
        $categories = Category::query()->get();
        if ($param == 'list-grid') {
            return view('Main.tour.list-grid', compact('tours','categories'));
        }
        return view('Main.tour.list', compact('tours','categories'));
    }

    public function show($slug)
    {
        $tour = Tour::query()->with('albums','reviews','category','schedules')
            ->with(['batches'=>function($q){
                $q->where('batch','>',now())->select();
            }])
            ->where('slug',$slug)
            ->first();

        $tour_recommend = Tour::query()->where('category_id',$tour->category->id)
            ->orWhere('origin','like','%'.$tour->origin.'%')
            ->where('id','!=',$tour->id)
            ->limit(8)
            ->orderBy('id','desc')
            ->get();

        $invoices = Invoice::query()->where('tour_id',$tour->id)
            ->where('start_date',$tour->batches->first()->batch)
            ->get(['adult_count','child_count']);
        $customer_total = $invoices->sum('adult_count') + $invoices->sum('child_count');
        return view('Main.tour.detail', compact('tour','customer_total','tour_recommend'));
    }

    public function history()
    {
        $user_id = auth()->user()->id;
        $invoices = Invoice::where('user_id', '=', $user_id)->orderBy('id', 'desc')->get();
        return view('Main.tour.history', compact(['invoices']));
    }



}
