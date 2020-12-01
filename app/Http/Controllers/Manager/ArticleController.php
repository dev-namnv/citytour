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
//        dd($articles[0]->tags->pluck('id'));
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
                $tags = json_decode($request->tags);
                $tag_ids = [];

                foreach ($tags as $key => $tag) {
                    $slugTag = ConvertSlugHelper::convert_slug($tag->value);
                    $newTag = ArticleTag::create([
                        'name' => $tag->value,
                        'slug' => $slugTag,
                    ]);
                    $tag_ids[$key] = $newTag->id;
                }

                $article->tags()->attach($tag_ids);
                $article->categories()->attach($request->category_ids);
            }

            return redirect()->route('articles.index')->with('flash_message', 'Tạo bài viết thành công')->with('status', 'success');
        } catch (\Exception $e) {
            return redirect()->route('articles.index')->with('flash_message', 'lỗi khi tạo bài viết')->with('status', 'danger');
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
            $tags = json_decode($request->tags);
            $tag_ids = [];

            foreach ($article->tags as $article_tag) {
                $article_tag->delete();
            }

            foreach ($tags as $key => $tag) {
                $slugTag = ConvertSlugHelper::convert_slug($tag->value);
                $newTag = ArticleTag::create([
                    'name' => $tag->value,
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
            return redirect()->route('articles.index')->with('flash_message', 'Cập nhật bài viết thành công')->with('status', 'success');
        } catch (\Exception $e) {
            return redirect()->route('articles.index')->with('flash_message', 'Cập nhật bài viết thất bại')->with('status', 'danger');
        }



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
            ArticleTag::whereIn('id', $article->tags->pluck('id'))->delete();
            $article->tags()->detach();
            $article->comments()->delete();
            $article->delete();
            return redirect()->back()->with('flash_message', 'Xóa bài viết thành công')->with('status', 'success');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message', "Xóa bài viết không thành công")->with('status', 'danger');
        }
    }
}
