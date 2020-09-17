<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'active' => 'boolean'
    ];

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
}
