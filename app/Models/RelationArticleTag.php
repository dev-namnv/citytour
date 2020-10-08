<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelationArticleTag extends Model
{
    protected $table = 'relation_article_tag';

    protected $fillable = [
        'article_id', 'tag_id'
    ];
}
