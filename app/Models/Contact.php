<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

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
}
