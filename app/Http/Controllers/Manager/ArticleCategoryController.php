<?php

namespace App\Http\Controllers\Manager;

use App\Helpers\ConvertSlugHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCategory\StoreArticleCategory;
use App\Models\ArticleCategory;
use App\Scopes\ActiveScope;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article_categories = ArticleCategory::orderBy('id', 'desc')->withoutGlobalScopes([ActiveScope::class])->get();
        return view('Manager.article_categories.index', compact(['article_categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Manager.article_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleCategory $request)
    {
    $article_category = ArticleCategory::create([
        'name' => $request->get('name'),
        'slug' => ConvertSlugHelper::convert_slug($request->get('name'))
    ]);
        return redirect()->route('article_category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article_category = ArticleCategory::withoutGlobalScopes([ActiveScope::class])->findOrFail($id);
        return view('Manager.article_categories.edit', compact(['article_category']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article_category = ArticleCategory::withoutGlobalScopes([ActiveScope::class])->findOrFail($id);
        $dataUpdate = [
            'active' => $request->get('active')
        ];

        if ($request->get('name') !== $article_category->name) {
            $dataUpdate['name'] = $request->get('name');
            $dataUpdate['slug'] = ConvertSlugHelper::convert_slug($request->get('name'));
        }

        $article_category->update($dataUpdate);

        return redirect()->route('article_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article_category = ArticleCategory::withoutGlobalScopes([ActiveScope::class])->findOrFail($id);

        foreach ($article_category->articles as $key => $article) {
            $article->tags()->detach();
            $article->comments()->delete();
        }

        $article_category->articles()->detach();
        $article_category->delete();
        return redirect()->back();
    }
}
