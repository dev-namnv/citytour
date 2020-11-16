<?php

namespace App\Http\Controllers\Manager;

use App\Helpers\BreadcrumbHelper;
use App\Helpers\ReviewHelper;
use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Scopes\ActiveScope;
use App\Scopes\PublishScope;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TourController extends Controller
{
    /**
     * List tour filter by ADMIN & GUIDE
     *
     * @return View
     */
    public function index()
    {
        if (Auth::user()->role === ADMIN) { // Nếu là ADMIN đăng nhập
            $tours = Tour::query()
                ->withoutGlobalScopes([ActiveScope::class, PublishScope::class])
                ->orderBy('active')
                ->paginate(PAGINATION_TOUR);
        } else { // Nếu là GUIDE đăng nhập
            $tours = Tour::query()
                ->withoutGlobalScope(PublishScope::class)
                ->ofGuide()
                ->orderBy('created_at', 'desc')
                ->paginate(PAGINATION_TOUR);
        }

        // Convert data
        foreach ($tours as $tour) {
            $tour->address = Str::limit($tour->address, TOUR_LIMIT_ADDRESS);
            $tour->rating = ReviewHelper::rating($tour->reviews);
        }

        $breadcrumbs = [new BreadcrumbHelper('Tour', \route('tour-list'))];
        return view('manager.tour.list', compact('tours', 'breadcrumbs'));
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

    /**
     * Create tour
     *
     * @param Request $request
     */
    public function store(Request $request)
    {

    }

    /**
     * Edit information tour: GUIDE
     *
     * @param Request $request
     * @return View|void
     */
    public function edit(Request $request)
    {
        if (Auth::user()->role === ADMIN) {
            return abort(403, HTTP_ERROR_403);
        }
        $tour = Tour::query()->withoutGlobalScope(PublishScope::class)->ofGuide()->findOrFail($request->id);
        return view('manager.tour.edit', compact('tour'));
    }

    /**
     * Set active tour: ADMIN
     *
     * @param Request $request
     * @return Response
     */
    public function setActive(Request $request)
    {
        try {
            $this->middleware('admin');
            $tour = Tour::query()->withoutGlobalScopes([ActiveScope::class, PublishScope::class])->findOrFail($request->tour_id);
            if ($tour->active) {
                $tour->active = NOT_ACTIVE;
            } else {
                $tour->active = ACTIVE;
            }
            $response = [
                'status' => TOASTR_INFO,
                'content' => 'Kích hoạt Tour thành công',
                'id' => $tour->id,
                'active' => $tour->active
            ];

            $tour->save();
        } catch (\Exception $exception) {
            $response = [
                'status' => TOASTR_ERROR,
                'content' => 'Kích hoạt Tour không thành công'
            ];
        }

        return response($response);
    }

    /**
     * Set publish tour: GUIDE
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function setPublish(Request $request)
    {
        try {
            $tour = Tour::query()->withoutGlobalScope(PublishScope::class)
                ->where('user_id', Auth::id())
                ->findOrFail($request->id);
            if ($tour->publish) {
                $tour->publish = NOT_PUBLISH;
            } else {
                $tour->publish = PUBLISH;
            }
            $response = [
                'status' => TOASTR_INFO,
                'content' => 'Cập nhật trạng thái thành công',
                'id' => $tour->id,
                'publish' => $tour->publish
            ];

            $tour->save();
            return response($response);
        } catch (\Exception $exception) {
            $response = [
                'status' => TOASTR_ERROR,
                'content' => 'Cập nhật trạng thái không thành công'
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Delete tour: ADMIN, GUIDE
     *
     * @param Request $request
     * @return ResponseFactory|JsonResponse|Response
     */
    protected function delete(Request $request) {
        try {
            if(Auth::user()->role === ADMIN) {
                $check = Tour::query()->withoutGlobalScope(ActiveScope::class)->findOrFail($request->id);
            } else {
                $check = Tour::query()->where('user_id', '=', Auth::id())->findOrFail($request->id);
            }
            if (!$check) {
                $response = [
                    'status' => TOASTR_INFO,
                    'content' => 'Không tìm thấy Tour'
                ];
            } else {
                $check->delete();
                $response = [
                    'status' => TOASTR_INFO,
                    'content' => 'Đã xóa Tour'
                ];
            }
            return response($response);
        } catch (\Exception $exception) {
            $response = [
                'status' => TOASTR_ERROR,
                'content' => 'Có lỗi xảy ra'
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * View detail tour: ADMIN, GUIDE
     *
     * @param Request $request
     * @return View
     */
    public function detail(Request $request) {
        if (Auth::user()->role === ADMIN) {
            $tour = Tour::query()->withoutGlobalScopes([ActiveScope::class, PublishScope::class])
                ->findOrFail($request->id);
        } else {
            $tour = Tour::query()->withoutGlobalScopes([PublishScope::class])
                ->ofGuide()
                ->findOrFail($request->id);
        }
        return view('manager.tour.detail', compact('tour'));
    }
}
