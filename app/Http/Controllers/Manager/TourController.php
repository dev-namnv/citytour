<?php

namespace App\Http\Controllers\Manager;

use App\Helpers\ConvertSlugHelper;
use App\Helpers\StorageS3Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\TourCreateRequest;
use App\Models\Album;
use App\Models\Batch;
use App\Models\Category;
use App\Models\Schedule;
use App\Models\Tour;
use Illuminate\Support\Facades\Auth;
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
        $categories = Category::query()->get()->toArray();
        return view('manager.tour.create',compact('categories'));
    }

    public function store(TourCreateRequest $request)
    {
        $tour_slug = ConvertSlugHelper::toSlug($request->tour_name);
        $tour = Tour::query()->create([
            'name' => $request->tour_name,
            'slug' => $tour_slug,
            'address' => $request->tour_address,
            'description' => $request->tour_description,
            'thumbnail' => StorageS3Helper::getUrlAfterUpload('tours/'.$tour_slug.'/thumbnail', $request->file('thumbnail')),
            'banner' => StorageS3Helper::getUrlAfterUpload('tours/'.$tour_slug.'/banner', $request->file('banner')),
            'adult_price' => $request->price_adult,
            'child_price' => $request->price_child,
            'publish' => empty($request->publish) ? '0':'1',
            'active' => 0,
            'category_id' => $request->tour_category,
            'note' => $request->tour_note,
            'guide_id' => Auth::id(),
        ]);
        //album
        foreach ($request->slide as $key => $slide){
            Album::query()->create([
                'image' => StorageS3Helper::getUrlAfterUpload('tours/'.$tour_slug.'/slider', $slide),
                'sort_order' => $key,
                'tour_id' => $tour->id,
            ]);
        }
        // schedule
        foreach ($request->schedule as $schedule){
            Schedule::query()->create([
                'description' => $schedule,
                'tour_id' => $tour->id,
            ]);
        }
        // batches
        foreach ($request->batches as $batch){
            Batch::query()->create([
                'batch' => $batch,
                'tour_id' => $tour->id,
            ]);
        }

        return redirect(route('tour-list'));
    }

    /**
     * Edit information tour: GUIDE
     *
     * @return View
     */
    public function edit($slug)
    {
        $categories = Category::query()->get()->toArray();
        if (Auth::user()->role === ADMIN){
            $tour = Tour::query()->where('slug',$slug)->firstOrFail();
        }else{
            $tour = Tour::query()->where('slug',$slug)
                ->where('guide_id', Auth::id())
                ->firstOrFail();
        }
        return view('Manager.tour.edit', compact('tour','categories'));
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
