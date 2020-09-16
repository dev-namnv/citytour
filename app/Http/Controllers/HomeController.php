<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleComment;
use App\Models\ArticleTag;
use App\Models\Contact;
use App\Models\Facility;
use App\Models\Faq;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\InvoiceService;
use App\Models\Partner;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use App\Models\UserLog;
use App\Models\WishlistProduct;
use App\Models\WishlistService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $result = WishlistProduct::find(4);
//        $partner = $result->partner[0];
        dd($result->user);
        return view('home');
    }
}
