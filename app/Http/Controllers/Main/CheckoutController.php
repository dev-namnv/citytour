<?php

namespace App\Http\Controllers\Main;

use App\Helpers\CartHelper;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Tour;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function overview($id)
    {
//        CartHelper::destroy();
        $tour = CartHelper::find($id);
        if (!$tour) {
            return abort(404);
        }

        return view('Main.checkout.overview', compact('tour'));
    }

    public function detail($slug, $date)
    {
        return view('Main.checkout.detail');
    }
}
