<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function list()
    {
        $articles = Article::with('user', 'tags')->orderBy('id', 'desc')->paginate(5);
        $article_categories = ArticleCategory::orderBy('id', 'desc')->get();
        $article_tags = ArticleTag::orderBy('id', 'desc')->limit(10)->get();
        $recent_articles = Article::recentArticles()->get();
        return view('Main.articles.list', compact(['articles', 'article_categories', 'article_tags', 'recent_articles']));
    }

    public function detail($slug)
    {
        $article = Article::with('user', 'tags', 'categories')->findBySlug($slug);
        $article_categories = ArticleCategory::orderBy('id', 'desc')->get();
        $article_tags = ArticleTag::orderBy('id', 'desc')->limit(10)->get();
        $recent_articles = Article::recentArticles()->get();
        return view('Main.articles.detail', compact(['article', 'article_categories', 'article_tags', 'recent_articles']));
    }
}
