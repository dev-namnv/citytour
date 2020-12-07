<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function list()
    {
        return view('Main.wishlist.list');
    }

    public function addItem($id)
    {
        $tour = Tour::find($id);
        $tourInWishlist = Wishlist::where([
            ['tour_id', '=', $id],
            ['user_id', '=', auth()->user()->id]
        ])->first();

        if (empty($tourInWishlist) && !empty($tour)) {
            auth()->user()->wishlists()->attach($id);
            return response()->json([
                'content' => 'Thêm tour vào danh sách yêu thích thành công',
                'status' => 'success'
            ]);
        }

        return response()->json([
            'content' => "Tour đã tồn tại trong danh sách yêu thích",
            'status' => 'error'
        ], 404);
    }

    public function removeItem($id)
    {
        $removeTour = auth()->user()->wishlists()->detach($id);

        if ($removeTour == 0) {
            return response()->json()->status(404);
        }

        return response()->json(['tour_id' => $id]);
    }
}
