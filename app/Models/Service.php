<?php

namespace App\Models;

use App\Casts\Currency;
use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'name',
        'slug',
        'address',
        'thumbnail',
        'banner',
        'description',
        'content',
        'schedule',
        'origin_price',
        'price',
        'type',
        'google_map',
        'active',
        'service_category_id'
    ];

    use SoftDeletes;

    /**
     * TODO: Convert data
     *
     * @var string[]
     */
    protected $casts = [
        'schedule' => Json::class,
        'google_map' => Json::class,
        'active' => 'boolean',
        'origin_price' => Currency::class,
        'price' => Currency::class
    ];

    /**
     * Get sale & convert into current
     */
    public function getCurrentPrice()
    {
        if (!$this->price) {
            return $this->origin_price;
        }
        return $this->price;
    }

    /**
     * Type service scope
     */
    public function scopeTours($query)
    {
        return $query->where('type', '=', SERVICE_TOUR);
    }

    public function scopeHotels($query)
    {
        return $query->where('type', '=', SERVICE_HOTEL);
    }

    public function scopeTransfers($query)
    {
        return $query->where('type', '=', SERVICE_TRANSFER);
    }

    public function scopeRestaurants($query)
    {
        return $query->where('type', '=', SERVICE_RESTAURANT);
    }

    /**
     * Eloquent service
     */
    public function facilities()
    {
        return $this->belongsToMany('App\Models\Facility', 'relation_service_facility', 'service_id', 'facility_id');
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
        return $this->belongsTo('App\Models\ServiceCategory', 'service_category_id', 'id', 'service_categories');
    }

    /**
     * TODO: Convert data
     *
     * @return mixed
     * @var integer string
     */
    public function getServiceType()
    {
        $masterData = config('masterdata')['service'];
        return $masterData['type'][$this->type];
    }

    public function getStatus()
    {
        $masterData = config('masterdata')['service'];
        return $masterData['status'][$this->active];
    }
}
