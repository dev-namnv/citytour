<?php

namespace App\Models;

use App\Casts\Currency;
use App\Casts\Json;
use App\Scopes\ActiveScope;
use App\Scopes\PublishScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Tour extends Model
{
    protected $table = 'tours';

    protected $fillable = [
        'name',
        'slug',
        'address',
        'description',
        'thumbnail',
        'banner',
        'content',
        'adult_price',
        'child_price',
        'google_map',
        'active',
        'category_id'
    ];

    use SoftDeletes;

    /**
     * Add global scope in query
     */
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
        static::addGlobalScope(new PublishScope);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfGuide($query)
    {
        return $query->where('user_id', '=', Auth::id());
    }

    /**
     * TODO: Convert data
     *
     * @var string[]
     */
    protected $casts = [
        'google_map' => Json::class,
        'active' => 'boolean',
        'publish' => 'boolean',
        'adult_price' => Currency::class,
        'child_price' => Currency::class
    ];

    /**
     * Get sale & convert into current
     */
    public function getCurrentPrice()
    {
        if (!$this->price) {
            return $this->adult_price;
        }
        return $this->price;
    }


    /**
     * Eloquent service
     */
    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'relation_tour_service', 'tour_id', 'service_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function album()
    {
        return $this->hasMany('App\Models\Album');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id', 'categories');
    }

    public function batches()
    {
        return $this->hasMany('App\Models\Batch');
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule');
    }

    public function guide()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * TODO: Convert data
     *
     * @return mixed
     * @var integer string
     */
    public function getStatusActive()
    {
        $masterData = config('masterdata')['tour'];
        return $masterData['active'][$this->active];
    }

    public function getStatusDelete()
    {
        return $this->deleted_at === null ? 'Hoạt động' : 'Đã xóa';
    }

    public function getStatusPublish()
    {
        $masterData = config('masterdata')['tour'];
        return $masterData['publish'][$this->publish];
    }
}
