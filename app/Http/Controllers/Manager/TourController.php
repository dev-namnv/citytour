<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * List tour filter by ADMIN & GUIDE
     *
     * @return View
     */
    public function list()
    {
        return view('Manager.tour.list');
    }

    /**
     * Screen create tour
     *
     * @return View
     */
    public function create()
    {
        return view('manager.tour.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Edit information tour: GUIDE
     *
     * @return View
     */
    public function edit()
    {
        return view('Manager.tour.edit');
    }

    /**
     * Detail tour
     *
     * @return View
     */
    public function detail() {
        return view('Manager.tour.detail');
    }
}
