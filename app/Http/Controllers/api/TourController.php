<?php

namespace App\Http\Controllers\api;

use App\Helpers\ConvertSlugHelper;
use App\Helpers\ReviewHelper;
use App\Helpers\StorageS3Helper;
use App\Http\Controllers\Controller;
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

class TourController extends Controller
{
    /**
     * List tour
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request)
    {
        $limit = PAGINATION_TOUR;
        if ($request->has('limit') && (int)$request->limit > 0 && (int)$request->limit <= 50) {
            $limit = (int)$request->limit;
        }

        $docs = Tour::query()->orderBy('created_at', 'desc');
        $tours = $docs
            ->with('schedules', 'batches', 'category', 'guide', 'reviews.user')
            ->paginate($limit);

        // Convert data
        foreach ($tours as $tour) {
            $tour->rating = ReviewHelper::rating($tour->reviews);
        }

        return response()->json($tours);
    }

    /**
     * List tour filter by ADMIN & GUIDE
     * Middleware: ADMIN & GUIDE
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function manager(Request $request)
    {
        $limit = PAGINATION_TOUR;
        if ($request->has('limit') && (int)$request->limit > 0 && (int)$request->limit <= 50) {
            $limit = (int)$request->limit;
        }

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
            ->paginate($limit);

        // Convert data
        foreach ($tours as $tour) {
            $tour->rating = ReviewHelper::rating($tour->reviews);
        }

        return response()->json($tours);
    }

    /**
     * Create tour
     * Middleware: GUIDE
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:20|max:255',
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

            $data = $request->only(['content']);

            $tour = new Tour;

            $tour->name = $request->name;
            $tour->slug = ConvertSlugHelper::toSlug($request->name);
            $tour->address = $request->address;
            $tour->description = $request->description;
            $tour->content = $data['content'];
            $tour->adult_price = $request->adult_price;
            $tour->child_price = $request->child_price ? $request->child_price : $request->adult_price;
            $tour->google_map = $request->google_map ?? null;
            $tour->publish = $request->publish ?? false;
            $tour->user_id = Auth::id();
            $tour->thumbnail = StorageS3Helper::getUrlAfterUpload('tours/'.$tour->slug.'/thumbnail', $request->file('thumbnail'));
            $tour->banner = StorageS3Helper::getUrlAfterUpload('tours/'.$tour->slug.'/banner', $request->file('banner'));
            $tour->category_id = (integer)$request->category_id;
            $tour->save();

            return response()->json($tour, 201);
        } catch (\Exception $exception) {
            return response()->json(['message' => HTTP_ERROR_400], 400);
        }
    }

    /**
     * Edit information tour
     * Middleware: GUIDE & ofGuide
     *
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    protected function update(Request $request, $id)
    {
        $this->middleware('guide');
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:20|max:255',
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
                'address',
                'description',
                'content',
                'adult_price',
                'child_price',
                'google_map',
                'publish',
                'category_id'
            ]);

            $tour = Tour::query()
                ->withoutGlobalScopes([ActiveScope::class, PublishScope::class])
                ->find($id);

            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = StorageS3Helper::getUrlAfterUpload('tours/'.$tour->slug.'/thumbnail', $request->file('thumbnail'));
            }
            if ($request->hasFile('banner')) {
                $data['banner'] = StorageS3Helper::getUrlAfterUpload('tours/'.$tour->slug.'/banner', $request->file('banner'));
            }
            $tour->update($data);

            return $tour ? response($tour) : response(['error' => 'Không tìm thấy Tour'], 404);
        } catch (\Exception $exception) {
            return response(['message' => 'Có lỗi xảy ra'], 500);
        }
    }

    /**
     * Set active tour
     * Middleware: ADMIN
     *
     * @param $id
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    protected function setActive($id)
    {
        $this->middleware('admin');
        try {
            $tour = Tour::query()
                ->withoutGlobalScopes([ActiveScope::class, PublishScope::class])
                ->ofGuide()
                ->find($id);
            $tour->active = !$tour->active;
            $response = [
                'title' => $tour->active ? 'Activated' : 'Deactivate',
                'message' => $tour->active ? 'Đã kích hoạt Tour' : 'Đã hủy kích hoạt Tour',
                'id' => $tour->id,
                'active' => $tour->active
            ];

            $tour->save();

            return response()->json($response);
        } catch (\Exception $exception) {
            return response(['message' => 'Có lỗi xảy ra'], 500);
        }
    }

    /**
     * Set publish tour: GUIDE
     * Middleware: GUIDE & ofGuide
     *
     * @param $id
     * @return JsonResponse|Response
     */
    protected function setPublish($id)
    {
        $this->middleware('guide');
        try {
            $tour = Tour::query()->withoutGlobalScope(PublishScope::class)
                ->ofGuide()
                ->find($id);
            $tour->publish = !$tour->publish;
            $response = [
                'title' => $tour->publish ? 'Published' : 'Unpublished',
                'message' => $tour->publish ? 'Đã công khai Tour' : 'Đã ẩn Tour',
                'id' => $tour->id,
                'publish' => $tour->publish
            ];

            $tour->save();
            return response($response);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Có lỗi xảy ra'], 500);
        }
    }

    /**
     * Delete tour: ADMIN, GUIDE
     * Middleware: ADMIN | (GUIDE & ofGuide)
     *
     * @param $id
     * @return ResponseFactory|JsonResponse|Response
     */
    protected function delete($id)
    {
        $this->middleware('guide');
        try {
            $check = Tour::query()
                ->withoutGlobalScopes([ActiveScope::class,PublishScope::class]);
            if(Auth::user()->role === ADMIN) {
                $check = $check->find($id);
            } else {
                $check = $check->ofGuide()->find($id);
            }

            if ($check) {
                $check->delete();
            }
            return $check
                ? response(['message' => 'Đã xóa Tour'])
                : response(['message' => 'Không tìm thấy Tour'], 404);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Có lỗi xảy ra'], 500);
        }
    }

    /**
     * Get detail tour by Slug
     *
     * @param $slug
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function findBySlug($slug)
    {
        $tour = Tour::query()->where('slug', $slug)
            ->with('category', 'guide', 'services', 'batches', 'reviews.user')
            ->first();
        return $tour ? response()->json($tour) : response(['message' => 'Không tìm thấy Tour'], 404);
    }

    /**
     * Get detail tour by ID
     *
     * @param $id
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function findById($id)
    {
        $doc = Tour::query()->withoutGlobalScopes([ActiveScope::class, PublishScope::class]);
        if (Auth::user()->role === GUIDE) { // Nếu là GUIDE đăng nhập
            $doc = $doc->ofGuide();
        }

        $tour = $doc->with('category', 'guide', 'services', 'batches', 'reviews.user')->find($id);
        return $tour ? response()->json($tour) : response(['message' => 'Không tìm thấy Tour'], 404);
    }
}
