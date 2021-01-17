<?php

namespace App\Http\Controllers\Manager;

use App\Helpers\ConvertSlugHelper;
use App\Helpers\StorageS3Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\TourCreateRequest;
use App\Http\Requests\Tour\TourUpdateRequest;
use App\Models\Album;
use App\Models\Batch;
use App\Models\Category;
use App\Models\Schedule;
use App\Models\Tour;
use App\Scopes\ActiveScope;
use App\Scopes\PublishScope;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
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
     * @return Application|Factory|RedirectResponse|View
     */
    public function create()
    {
        if (Auth::user()->role !== GUIDE) {
            return redirect()->back();
        }
        $categories = Category::query()->get()->toArray();
        return view('Manager.tour.create',compact('categories'));
    }

    public function store(TourCreateRequest $request)
    {
        $user = Auth::id();
        $tours = Tour::query()->withoutGlobalScopes()->where('guide_id',$user)
            ->with(['batches'=>function ($q){
                $q->select()->where('batch','>=',date('Y-m-d'));
            }])
            ->with('schedules')->get();
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
            'origin' => $request->origin,
        ]);
        //album
        if (!empty($request->slide)){
            foreach ($request->slide as $key => $slide){
                Album::query()->create([
                    'image' => StorageS3Helper::getUrlAfterUpload('tours/'.$tour_slug.'/slider', $slide),
                    'sort_order' => $key,
                    'tour_id' => $tour->id,
                ]);
            }
        }
        // schedule
        foreach ($request->schedule as $schedule){
            Schedule::query()->create([
                'description' => $schedule,
                'tour_id' => $tour->id,
            ]);
        }
        // batches
        $batches = '';
        foreach ($request->batches as $batch){
            if ($this->checkStartTime($tours, $batch,count($request->schedule)) === 0) {
                Batch::query()->create([
                    'batch' => $batch,
                    'tour_id' => $tour->id,
                ]);
            }else{
                $batches .= ' + ' . Carbon::parse($batch)->format('d-m-Y');
            }
        }
        if ($batches != '') {
            $batches = trim($batches, ' + ');
            return redirect(route('tour-edit',$tour->slug))
                ->with('message',"Ngày khởi hành ".$batches." đã bị trùng.");
        }
        return redirect(route('tour-list'))
            ->with('success',"Tour được tạo thành công");
    }

    /**
     * Edit information tour: GUIDE
     *
     * @return View
     */
    public function edit($slug)
    {
        $categories = Category::query()->get()->toArray();
        if (Auth::user()->role === GUIDE){
            $tour = Tour::query()->withoutGlobalScopes([ActiveScope::class, PublishScope::class])
                ->where('slug',$slug)
                ->where('guide_id', Auth::id())
                ->with('schedules','albums')
                ->with(['batches'=>function ($q){
                    $q->select()->where('batch','>=',date('Y-m-d'));
                }])
                ->firstOrFail();
        }else{
            return redirect()->route('Main.tour.show', $slug);
        }
        return view('Manager.tour.edit', compact('tour','categories'));
    }

    public function update(TourUpdateRequest $request)
    {
        try {
            if (Auth::user()->role !== GUIDE) {
                return redirect()->back();
            }
            $tour_slug = $request->slug;
            $tour_data = $request->all();
            $tour_data['publish'] = empty($request->publish) ? '0':'1';
            if (!empty($request->thumbnail)){
                $tour_data['thumbnail'] = StorageS3Helper::getUrlAfterUpload('tours/'.$tour_slug.'/thumbnail', $request->file('thumbnail'));
            }
            if (!empty($request->banner)){
                $tour_data['banner'] = StorageS3Helper::getUrlAfterUpload('tours/'.$tour_slug.'/banner', $request->file('banner'));
            }
            Tour::query()->withoutGlobalScopes([ActiveScope::class, PublishScope::class])->find($request->id)->update($tour_data);

            //album
            if (!empty($request->slide)){
                foreach ($request->slide as $key => $slide){
                    Album::query()->updateOrCreate([
                        'tour_id' => $request->id,
                        'sort_order' => $request->slide_key[$key] ?? '999',
                    ],[
                        'image' => StorageS3Helper::getUrlAfterUpload('tours/'.$tour_slug.'/slider', $slide),
                    ]);
                }
            }
            // schedule
            foreach ($request->schedule as $key => $schedule){
                Schedule::query()->updateOrCreate([
                    'tour_id' => $request->id,
                    'id' => $request->schedule_id[$key] ?? null,
                ],[
                    'description' => $schedule,
                ]);
            }
            // batches
            foreach ($request->batches ??[] as $key => $batch){
                Batch::query()->updateOrCreate([
                    'tour_id' => $request->id,
                    'id' => $request->batch_id[$key] ?? null,
                ],[
                    'batch' => $batch,
                ]);
            }

            return redirect(route('tour-list'))
                ->with('success',"Tour cập nhật thành công");
        } catch (\Exception $e) {
            return redirect(route('tour-list'))
                ->with('message',"Tour update thất bại");
        }
    }

    /**
     * Detail tour
     *
     * @return View
     */
    public function detail($id) {
        $tour = Tour::query()->withoutGlobalScope(new ActiveScope)->findOrFail($id);
        return view('Manager.tour.detail', compact('tour'));
    }

    public function checkStartTime($tours, $batch,$schedules)
    {
        $batch = Carbon::parse($batch)->timestamp;
        $results = 0;
        for ($i=0; $i<count($tours); $i++) {
            for ($j=0; $j<count($tours[$i]->batches);$j++) {
                $startDate = Carbon::parse($tours[$i]->batches[$j]->batch)->timestamp;
                $endDate = Carbon::parse($tours[$i]->batches[$j]->batch)
                    ->addDays($tours[$i]->schedules->count())->timestamp;
                $endBatch = Carbon::parse($batch)
                    ->addDays($schedules)->timestamp;
                if (($batch >= $startDate && $batch <= $endDate) || ($endBatch >= $startDate && $endBatch <= $endDate)) {
                    $results = $results + 1;
                }
            }
        }
        return $results;
    }
}
