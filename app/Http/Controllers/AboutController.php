<?php

namespace App\Http\Controllers;

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

        return view('about.index', compact('comments'));
    }
}
