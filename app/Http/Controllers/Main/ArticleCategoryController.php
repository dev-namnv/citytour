<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
    public function show ($slug)
    {
        $article_categories = ArticleCategory::all();
        $article_category = ArticleCategory::where('slug', '=', $slug)->first();
        $articles = $article_category->articles()->paginate(10);
        $recent_articles = Article::recentArticles()->get();
        return view('Main.article_category.show', compact(['article_categories', 'article_category', 'articles', 'recent_articles']));
    }
}
