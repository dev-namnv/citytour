<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\CancelPolicy;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Review;
use App\Models\Tour;
use App\Scopes\GuideBehaviorScope;
use App\Scopes\GuideBusyScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder;

class TourController extends Controller
{

    public function index(Request $request)
    {
//        try {
            // Param query
            $price = $request->get('price');
            $ranking = $request->get('ranking');
            $where = $request->get('where');
            $when = $request->get('when');
            $query_category = $request->get('category');
            $keyword = $request->get('keyword');
            $range = $request->get('range');

            $categories = Category::query()->orderBy('sort_order', 'asc')->get();
            $category = null;
            $tours = Tour::query()
                ->withGlobalScope('GuideBehaviorScope', new GuideBehaviorScope)
                ->with('category','reviews','schedules')
                ->whereHas('batches',function ($query){
                    $query->where('batch','>',date('Y-m-d'));
                })
                ->with(['batches' => function ($q) {
                    $q->select()->where('batch','>',date('Y-m-d'));
                }]);

            // Keyword
            if ($keyword) {
                $tours = $tours->where('name', 'like', '%'.$keyword.'%')
                    ->orWhere('slug', 'like', '%'.$keyword.'%')
                    ->orWhere('address', 'like', '%'.$keyword.'%')
                    ->orWhereHas('category', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%'.$keyword.'%');
                    });
            }

            // Category
            if ($query_category) {
                $category = Category::query()->where('slug', $query_category)->first();
                $tours = $tours->whereHas('category', function ($q) use ($query_category) {
                    $q->where('slug', '=', $query_category);
                });
            }

            // Where
            if ($where) {
                $tours = $tours->where('address', 'like', '%'.$where.'%');
            }
            // Where
            if ($when) {
                $tours = $tours->whereHas('batches', function ($q) use ($when) {
                    $q->where('batch', '=', Carbon::parse($when)->format('Y-m-d'));
                });
            }

            // Price
            if ($range) {
                list($min, $max) = explode(';', $range);
                $tours = $tours->where('adult_price', '>=', $min)
                    ->where('adult_price', '<=', $max);
            }

            // Sort price
            if ($price) { // Theo giá
                if ($price === 'lower') {
                    $tours = $tours->orderBy('adult_price', 'asc');
                }
                if ($price === 'higher') {
                    $tours = $tours->orderBy('adult_price', 'desc');
                }
            }
            // Sort rank
            if ($ranking) { // Theo đánh giá
                if ($ranking === 'lower') {
                    $tours = $tours->withCount(['reviews as rating' => function ($q) {
                        $q->select(DB::raw('coalesce(avg(star),0)'));
                    }])->orderBy('rating', 'asc');
                }
                if ($ranking === 'higher') {
                    $tours = $tours->withCount(['reviews as rating' => function ($q) {
                        $q->select(DB::raw('coalesce(avg(star),0)'));
                    }])->orderBy('rating', 'desc');
                }
            }
            $tours = $tours->paginate(PAGINATION_TOUR);
            if ($request->get('view') === 'list-grid') {
                return view('Main.tour.list-grid', compact('tours','categories', 'category'));
            }
            return view('Main.tour.list', compact('tours','categories', 'category'));
        /*} catch (\Exception $exception) {
            return view('Main.tour.list', compact(['tours' => [], 'categories' => [], 'category' => null]));
        }*/
    }

    public function show($slug)
    {
        $tour = Tour::query()
            ->withGlobalScope('GuideBehaviorScope', new GuideBehaviorScope)
            ->whereHas('batches',function ($query){
                $query->where('batch','>',date('Y-m-d'));
            })
            ->with('albums','reviews','category','schedules')
            ->with(['batches'=>function($q){
                $q->where('batch','>',now())->select();
            }])
            ->where('slug',$slug)
            ->firstOrFail();

        $tour_recommend = Tour::query()->where('category_id',$tour->category->id)
            ->whereHas('batches',function ($query){
                $query->where('batch','>',date('Y-m-d'));
            })
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
    public function printPdf($slug) {
        $tour = Tour::query()
            ->withGlobalScope('GuideBehaviorScope', new GuideBehaviorScope)
            ->with('albums','reviews','category','schedules')
            ->with(['batches'=>function($q){
                $q->where('batch','>',now())->select();
            }])
            ->where('slug',$slug)
            ->firstOrFail();
        return view('Main.tour.printpdf', compact('tour'));
    }
    public function history()
    {
        $user_id = auth()->user()->id;
        $invoices = Invoice::query()->where('user_id', '=', $user_id)
            ->with('tour', 'refund')
            ->orderBy('id', 'desc')
            ->get();
        $cancel_policies = CancelPolicy::query()->orderBy('date', 'desc')->get();
        return view('Main.tour.history', compact('invoices', 'cancel_policies'));
    }

    public function review(Request $request)
    {
        Review::query()->updateOrCreate([
            'tour_id' => $request->id,
            'user_id' => Auth::id(),
        ],[
            'content' => $request->review_text,
            'star' => $request->star,
        ]);
        session()->flash(TOASTR, json_encode(['status' => TOASTR_SUCCESS, 'title' => ' Gửi Review thành công !']));
        return redirect()->back();
    }

}
