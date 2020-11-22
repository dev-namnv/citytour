<?php

namespace App\Http\Controllers\api;

use App\Helpers\ConvertSlugHelper;
use App\Helpers\ReviewHelper;
use App\Helpers\StorageS3Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\UpdateTourRequest;
use App\Models\Tour;
use App\Scopes\ActiveScope;
use App\Scopes\PublishScope;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TourController extends Controller
{
    /**
     * List tour filter by ADMIN & GUIDE
     *
     * @return JsonResponse
     */
    public function list(Request $request)
    {
        $params = $request->only(['page', 'active', 'publish']);
        if (Auth::user()->role === ADMIN) { // Nếu là ADMIN đăng nhập
            $docs = Tour::query()
                ->withoutGlobalScopes([ActiveScope::class, PublishScope::class])
                ->orderBy('created_at', 'desc');
        } else { // Nếu là GUIDE đăng nhập
            $docs = Tour::query()
                ->withoutGlobalScope(PublishScope::class)
                ->ofGuide()
                ->orderBy('created_at', 'desc');
        }

        foreach ($params as $key => $param) {
            if (is_bool($param) && $key) {
                $docs = $docs->where($key, '=', $param);
            }
        }

        $tours = $docs
            ->with('schedules', 'batches', 'category', 'guide', 'reviews.user')
            ->paginate(PAGINATION_TOUR);

        // Convert data
        foreach ($tours as $tour) {
            $tour->address = Str::limit($tour->address, TOUR_LIMIT_ADDRESS);
            $tour->rating = ReviewHelper::rating($tour->reviews);
        }

        return response()->json($tours);
    }

    /**
     * Create tour
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
//        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:20|max:255',
                'slug' => [
                    'nullable',
                    'unique:tours',
                    'min:10',
                    'max:255',
                    'regex:'.REGEX_SLUG
                ],
                'address' => 'required|string|min:10|max:255',
                'description' => 'required|string|min:100',
                'thumbnail' => 'required|image|mimes:jpeg,jpg,png',
                'banner' => 'required|image|mimes:jpeg,jpg,png',
                'content' => 'required|string|min:100',
                'adult_price' => $request->child_price
                    ? 'required|integer|min:1000|gte:child_price'
                    : 'required|integer|min:1000',
                'child_price' => 'integer|min:1000',
                'google_map' => 'nullable|json',
                'publish' => 'nullable|boolean',
                'category_id' => 'required|exists:categories,id'
            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()], 400);
            }

            $data = $request->only([
                'name',
                'slug',
                'address',
                'description',
                'thumbnail',
                'banner',
                'content',
                'adult_price',
                'child_price',
                'google_map',
                'publish',
                'category_id'
            ]);

            // Make slug
            if (!$request->slug) {
                $data['slug'] = ConvertSlugHelper::toSlug($request->name);
            }

            // Check exist child price
            if (!$request->child_price) {
                $data['child_price'] = $request->adult_price;
            }

            // Guide id


            $tour = new Tour($data);
            $tour->user_id = Auth::id();
            dd($tour);
            $tour->thumbnail = StorageS3Helper::getUrlAfterUpload('tours/'.$tour->id.'/thumbnail', $request->file('thumbnail'));
            $tour->banner = StorageS3Helper::getUrlAfterUpload('tours/'.$tour->id.'/banner', $request->file('banner'));
            $tour->save();

            $doc = Tour::query()->find($tour->id);
            return response()->json($doc, 201);
//        } catch (\Exception $exception) {
//            return response()->json(['message' => HTTP_ERROR_400], 400);
//        }
    }

    /**
     * Edit information tour: GUIDE
     *
     * @param UpdateTourRequest $request
     * @return Response
     */
    public function update(UpdateTourRequest $request)
    {
        $this->middleware('guide');
        try {
            $data = $request->only([
                'id',
                'name',
                'slug',
                'address',
                'description',
                'thumbnail',
                'banner',
                'content',
                'adult_price',
                'child_price',
                'google_map',
                'publish',
                'category_id'
            ]);

            $tour = Tour::query()
                ->withoutGlobalScope(PublishScope::class)
                ->ofGuide()
                ->find($data->id);
            if ($request->hasFile('thumbnail')) {
                $data->thumbnail = StorageS3Helper::getUrlAfterUpload('tours/'.$tour->id.'/thumbnail', $request->file('thumbnail'));
            }

            if ($request->hasFile('banner')) {
                $data->banner = StorageS3Helper::getUrlAfterUpload('tours/'.$tour->id.'/banner', $request->file('banner'));
            }

            $tour->save();
        } catch (\Exception $exception) {
            $tour = null;
        }
        return $tour ? response($tour) : response($tour, 500);
    }

    /**
     * Set active tour: ADMIN
     *
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    protected function setActive(Request $request)
    {
        $this->middleware('admin');
        try {
            $tour = Tour::query()
                ->withoutGlobalScopes([ActiveScope::class, PublishScope::class])
                ->ofGuide()
                ->find($request->id);
            $tour->active = !$tour->active;
            $response = [
                'status' => TOASTR_INFO,
                'title' => $tour->active ? 'Activated' : 'Deactivate',
                'content' => $tour->active ? 'Đã kích hoạt Tour' : 'Đã hủy kích hoạt Tour',
                'id' => $tour->id,
                'active' => $tour->active
            ];

            $tour->save();

            return response()->json($response, 200);
        } catch (\Exception $exception) {
            $response = [
                'status' => TOASTR_ERROR,
                'content' => 'Có lỗi xảy ra'
            ];
            return response($response, 500);
        }
    }

    /**
     * Set publish tour: GUIDE
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    protected function setPublish(Request $request)
    {
        $this->middleware('guide');
        try {
            $tour = Tour::query()->withoutGlobalScope(PublishScope::class)
                ->ofGuide()
                ->find($request->id);
            $tour->publish = !$tour->publish;
            $response = [
                'status' => TOASTR_INFO,
                'title' => $tour->active ? 'Published' : 'Unpublished',
                'content' => $tour->active ? 'Đã công khai Tour' : 'Đã ẩn Tour',
                'id' => $tour->id,
                'publish' => $tour->publish
            ];

            $tour->save();
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
     * Delete tour: ADMIN, GUIDE
     *
     * @param Request $request
     * @return ResponseFactory|JsonResponse|Response
     */
    protected function delete(Request $request)
    {
        $this->middleware('guide');
        try {
            if(Auth::user()->role === ADMIN) {
                $check = Tour::query()
                    ->withoutGlobalScope(ActiveScope::class)
                    ->find($request->id);
            } else {
                $check = Tour::query()
                    ->ofGuide()
                    ->find($request->id);
            }
            if (!$check) {
                $response = [
                    'status' => TOASTR_WARNING,
                    'content' => 'Không tìm thấy Tour'
                ];
            } else {
                $check->delete();
                $response = [
                    'status' => TOASTR_INFO,
                    'content' => 'Đã xóa Tour'
                ];
            }
            return $check ? response($response) : response($response, 404);
        } catch (\Exception $exception) {
            $response = [
                'status' => TOASTR_ERROR,
                'content' => 'Có lỗi xảy ra'
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * View detail tour: ADMIN, GUIDE, USER
     *
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function findBySlug(Request $request) {
        $tour = Tour::query()->where('slug', $request->slug)
            ->with('category', 'guide', 'services', 'batches', 'reviews.user')
            ->first();
        return $tour ? response()->json($tour) : response(null, 404);
    }
}
