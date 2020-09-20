<?php

namespace App\Models;

use App\Casts\Currency;
use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Service extends Model
{
    protected $table = 'services';

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
        'adult_price' => Currency::class,
        'children_price' => Currency::class
    ];

    /**
     * Ownership scope
     */
    public function scopeOwnershipServices($query)
    {
        return $query->where('partner_id', '=', Auth::user()->getPartner()->id);
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

    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
    }

    /**
     * TODO: Convert data
     *
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
