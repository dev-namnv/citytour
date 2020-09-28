<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = [
        'id','reply_for','subject','full_name','email','message','geoip','status'
    ];
    /**
     * TODO: Convert data
     *
     * @var integer string
     */
    public function getStatus()
    {
        $masterData = config('masterdata')['contact'];
        return $masterData['status'][$this->status];
    }

    public function getColor()
    {
        $masterData = config('masterdata')['contact'];
        return $masterData['color'][$this->status];
    }
}
