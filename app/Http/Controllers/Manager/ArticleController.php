<?php

namespace App\Http\Controllers\Manager;


use App\Helpers\StorageS3Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreArticle;
use App\Http\Requests\Article\UpdateArticle;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('user')->orderBy('id', 'desc')->get();
        return view('Manager.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Manager.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
        $urlImage = StorageS3Helper::getUrlAfterUpload('images/articles', $request->image);
        $article = Article::create([
            'title' => $request->title,
            'heading' => $request->heading,
            'slug' => Str::slug($request->title) . '-' . uniqid('', true),
            'content' => $request->get('content'),
            'image' => $urlImage,
            'user_id' => auth()->id()
        ]);

        if ($article) {
            return redirect()->route('articles.index');
        }
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
        $article = Article::findOrFail($id);
        return view('Manager.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticle $request, $id)
    {
        $article = Article::findOrFail($id);
        $dataUpdate = [
            'title' => $request->get('title'),
            'heading' => $request->get('heading'),
            'content' => $request->get('content')
        ];

        if ($request->get('title') !== $article->title) {
            $dataUpdate['slug'] = Str::slug($request->get('title')) . '-' . uniqid('', true);
        }

        if ($request->image) {
            $dataUpdate['image'] = StorageS3Helper::getUrlAfterUpload('images/articles', $request->image);
            StorageS3Helper::delete($article->image);
        }

        $article->update($dataUpdate);
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->back();
    }
}
