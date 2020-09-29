<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    protected $table = 'article_tags';

    protected $fillable = ['name', 'slug'];
    /**
     * Add active scope in query
     */
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }

    public function articles()
    {
        return $this->belongsToMany('App\Model\Article', 'relation_article_tag', 'tag_id', 'article_id');
    }
}
