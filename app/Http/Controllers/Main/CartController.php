<?php

namespace App\Http\Controllers\Main;

use App\Helpers\CartHelper;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Tour;

class CartController extends Controller
{
    public function add($id, $date)
    {
        try {
            $tour = Tour::query()->findOrFail($id);

            $batch = Batch::query()
                ->where('tour_id', $tour->id)
                ->where('batch', $date)->first();
            CartHelper::add($tour, $batch->batch);

            if ($tour && $batch) {
                $response = [
                    'content' => 'Đã thêm Tour vào giỏ hàng',
                    'status' => true
                ];
            } else {
                $response = [
                    'content' => 'Không tìm thấy Tour',
                    'status' => false
                ];
            }

            return response()->json($response);
        } catch (\Exception $exception) {
            return response()->json(['content' => 'Có lỗi xảy ra', 'status' => false], 500);
        }

    }

    public function remove($id)
    {
        return CartHelper::remove($id);
    }

    public function all()
    {
        return CartHelper::all();
    }
}
