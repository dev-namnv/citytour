<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Article extends Model
{
    use SoftDeletes;

    protected $table = 'articles';

    /**
     * TODO: Convert data
     *
     * @var string[]
     */
    protected $casts = [
        'active' => 'boolean'
    ];

    /**
     * Add global scope in query
     */
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }

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

    public function  getContentLimitAttribute()
    {
        return Str::limit($this->content, ARTICLES_LIMIT_CONTENT );
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }
}
