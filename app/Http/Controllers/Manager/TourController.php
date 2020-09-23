<?php

namespace App\Http\Controllers\Manager;

use App\Helpers\ReviewHelper;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TourController extends Controller
{
    public function index()
    {
        // Get all record type is tour and without global scope
        $tours = Service::query()->withoutGlobalScopes()->paginate(PAGINATION_TOUR);

        // Filter service if is Partner or Employee
        if (Auth::user()->role === PARTNER || Auth::user()->role === EMPLOYEE) {
            $tours = Service::ownershipServices()->tours()->paginate(PAGINATION_TOUR);
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
    {}

    public function edit(Request $request)
    {
        $tour = Service::query()->withoutGlobalScopes()->findOrFail($request->id);
        return view('manager.tour.edit', compact('tour'));
    }
}
