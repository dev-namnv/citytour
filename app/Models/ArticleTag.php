<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    protected $table = 'article_tags';

    /**
     * Add active scope in query
     */
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }
}
