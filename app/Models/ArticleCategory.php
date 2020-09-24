<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $table = 'article_categories';

    protected $fillable = ['name', 'slug', 'active'];

    /**
     * TODO: Convert data
     *
     * @var string[]
     */
//    protected $casts = [
//        'active' => 'boolean'
//    ];

    /**
     * Add global scope in query
     */
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }

    public function getStatus()
    {
        $masterData = config('masterdata')['active'];
        return $masterData[$this->active];
    }
}
