<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\App;
use Cknow\Money\Money;

class Currency implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, $key, $value, $attributes)
    {
        $currency = Money::USD($value);

        if (App::getLocale() === 'vi') {
            $currency = Money::VND($value);
        }

        return $currency;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}
