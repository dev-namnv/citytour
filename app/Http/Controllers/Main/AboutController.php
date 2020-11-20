<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\ArticleComment;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $comments = ArticleComment::join('users', 'users.id', '=', 'article_comments.user_id')
            ->select('*')
            ->orderByDesc('article_comments.id')
            ->limit(4)
            ->get();

        return view('Main.about.index', compact('comments'));
    }
}
