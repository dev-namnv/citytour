<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelationArticleCategory extends Model
{
    protected $table = 'relation_article_category';

    protected $fillable = [
        'article_id', 'category_id'
    ];
}
