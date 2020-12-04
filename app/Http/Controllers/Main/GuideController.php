<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function detail($guide_id)
    {
        $guide = User::findOrFail($guide_id);

        // Đoạn plunk này sẽ lấy ra tất cả các id của các tour mà thằng guide này tạo ra
        // sau đó sẽ random ra 4 bản ghi
        $reviews = Review::with(['user'])->whereIn('tour_id', $guide->tours->pluck('id'))->inRandomOrder()->limit(4)->get();

        // Vì ngoài view chia ra 2 row nên phải chunk (cắt ra) thành 2 mảng. Xem ngoài view detail để thấy rõ hơn nhé
        $chunkReviews = $reviews->chunk(2);

        if ($guide->role != GUIDE) {
            // Đoạn này đưa về 404 mà chưa có view của 404 :v
            abort(404);
        }

        return view("Main.guide.detail", compact(['guide', 'chunkReviews']));
    }
}
