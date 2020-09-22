<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Article extends Model
{
    use SoftDeletes;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'heading',
        'slug',
        'content',
        'image',
        'user_id'
    ];

    /**
     * TODO: Convert data
     *
     * @var string[]
     */
    protected $casts = [
        'active' => 'boolean'
    ];

    /**
     * Eloquent article
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\ArticleCategory', 'relation_article_category', 'article_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\ArticleTag', 'relation_article_tag', 'article_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\ArticleComment');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
