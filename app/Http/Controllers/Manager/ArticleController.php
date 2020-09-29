<?php

namespace App\Http\Controllers\Manager;


use App\Helpers\ConvertSlugHelper;
use App\Helpers\StorageS3Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreArticle;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('user')->orderBy('id', 'desc')->paginate(PAGINATION_ARTICLE);
        return view('Manager.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article_categories = ArticleCategory::all();
        return view('Manager.articles.create', compact(['article_categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
        try {
            $urlImage = StorageS3Helper::getUrlAfterUpload('images/articles', $request->image);
            $article = Article::create([
                'title' => $request->title,
                'heading' => $request->heading,
                'slug' => ConvertSlugHelper::convert_slug($request->title),
                'content' => $request->get('content'),
                'image' => $urlImage,
                'user_id' => auth()->id()
            ]);

            if ($article) {
                $tags = explode(',', $request->tags);
                $tag_ids = [];

                foreach ($tags as $key => $tag) {
                    $slugTag = ConvertSlugHelper::convert_slug($tag);
                    $newTag = ArticleTag::create([
                        'name' => $tag,
                        'slug' => $slugTag,
                    ]);
                    $tag_ids[$key] = $newTag->id;
                }

                $article->tags()->attach($tag_ids);
                $article->categories()->attach($request->category_ids);
            }
        } catch (\Exception $e) {
            $message = ['status' => TOASTR_ERROR, 'content' => 'Article Create Failed'];
            session()->flash(TOASTR, json_encode($message));
            return redirect()->route('articles.index');
        }

        $message = ['status' => TOASTR_SUCCESS, 'content' => 'Article Created Successfully'];
        session()->flash(TOASTR, json_encode($message));
        return redirect()->route('articles.index');
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
        $article_categories = ArticleCategory::all();
        $tags = [];
        $category_ids = [];

        foreach ($article->tags as $key => $tag) {
            $tags[$key] = $tag->name;
        }

        foreach ($article->categories as $key => $category) {
            $category_ids[$key] = $category->id;
        }

        return view('Manager.articles.edit', compact(['article', 'article_categories', 'tags', 'category_ids']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticle $request, $id)
    {
        try {
            $article = Article::findOrFail($id);
            $tags = explode(',', $request->tags);
            $tag_ids = [];

            foreach ($article->tags as $article_tag) {
                $article_tag->delete();
            }

            foreach ($tags as $key => $tag) {
                $slugTag = ConvertSlugHelper::convert_slug($tag);
                $newTag = ArticleTag::create([
                    'name' => $tag,
                    'slug' => $slugTag,
                ]);
                $tag_ids[$key] = $newTag->id;
            }

            $article->tags()->sync($tag_ids);
            $article->categories()->sync($request->get('category_ids'));

            $dataUpdate = [
                'title' => $request->get('title'),
                'heading' => $request->get('heading'),
                'content' => $request->get('content')
            ];

            if ($request->get('title') !== $article->title) {
                $dataUpdate['slug'] = ConvertSlugHelper::convert_slug($request->get('title'));
            }

            if ($request->image) {
                $dataUpdate['image'] = StorageS3Helper::getUrlAfterUpload('images/articles', $request->image);
                StorageS3Helper::delete($article->image);
            }

            $article->update($dataUpdate);
        } catch (\Exception $e) {
            $message = ['status' => TOASTR_ERROR, 'content' => 'Article Update Failed'];
            session()->flash(TOASTR, json_encode($message));
            return redirect()->route('articles.index');
        }

        $message = ['status' => TOASTR_SUCCESS, 'content' => 'Article Updated Successfully'];
        session()->flash(TOASTR, json_encode($message));
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
        try {
            $article = Article::findOrFail($id);
            $article->categories()->detach();
            $article->tags()->detach();
            $article->comments()->delete();
            $article->delete();
        } catch (\Exception $e) {
            $message = ['status' => TOASTR_ERROR, 'content' => 'Article Delete Failed'];
            session()->flash(TOASTR, json_encode($message));
            return redirect()->back();
        }

        $message = ['status' => TOASTR_SUCCESS, 'content' => 'Article Deleted Successfully'];
        session()->flash(TOASTR, json_encode($message));
        return redirect()->back();
    }
}
