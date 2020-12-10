<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\ArticleComment;
use App\Models\Service;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $comments = ArticleComment::query()->inRandomOrder()->limit(4)->get();
        $services = Service::all()->chunk(2);

        return view('Main.about.index', compact('comments', 'services'));
    }
}
