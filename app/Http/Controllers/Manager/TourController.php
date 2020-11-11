<?php

namespace App\Http\Controllers\Manager;

use App\Helpers\ReviewHelper;
use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Scopes\ActiveScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::query()->withoutGlobalScopes()->paginate(PAGINATION_TOUR);

        if (Auth::user()->role === GUIDE) {
            $tours = Tour::query()->withoutGlobalScope(ActiveScope::class)->paginate(PAGINATION_TOUR);
        }

        // Convert data
        foreach ($tours as $tour) {
            $tour->address = Str::limit($tour->address, TOUR_LIMIT_ADDRESS);
            $tour->rating = ReviewHelper::rating($tour->reviews);
        }

        return view('manager.tour.list', compact('tours'));
    }

    public function create()
    {
        return view('manager.tour.create');
    }

    public function store(Request $request)
    {

    }

    public function edit(Request $request)
    {
        $tour = Tour::query()->withoutGlobalScope(ActiveScope::class)->findOrFail($request->id);
        return view('manager.tour.edit', compact('tour'));
    }

    public function setActive(Request $request)
    {
        try {
            $tour = Tour::query()->withoutGlobalScopes()->findOrFail($request->tour_id);
            if ($tour->active) {
                $tour->active = NOT_ACTIVE;
            } else {
                $tour->active = ACTIVE;
            }
            $response = [
                'status' => TOASTR_INFO,
                'content' => 'Cập nhật trạng thái thành công',
                'id' => $tour->id,
                'active' => $tour->active
            ];

            $tour->save();
        } catch (\Exception $exception) {
            $response = [
                'status' => TOASTR_ERROR,
                'content' => 'Cập nhật trạng thái không thành công'
            ];
        }

        return response($response);
    }

    public function confirm()
    {
        if (Auth::user()->role === GUIDE) {
            $tours = Tour::query()->withoutGlobalScopes()
                ->with('category','guide')
                ->where('user_id',Auth::id())
                ->where('publish',0)
                ->orderBy('created_at','DESC')
                ->paginate(PAGINATION_TOUR);
        } else {
            $tours = Tour::query()->withoutGlobalScopes()
                ->with('category','guide')
                ->where('active',0)
                ->orderBy('created_at','DESC')
                ->paginate(PAGINATION_TOUR);
        }
        return view('Manager.tour.confirm', compact('tours'));
    }

}
