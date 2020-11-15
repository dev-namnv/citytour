<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    protected $table = 'article_comments';

    /**
     * TODO: Convert data
     *
     * @var string[]
     */
    protected $casts = [
        'active' => 'boolean'
    ];

    /**
     * Add active scope in query
     */
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }

    /**
     * Eloquent article comment
     */
    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
