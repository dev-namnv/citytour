<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class ConvertSlugHelper
{
    public static function convert_slug($title)
    {
        return Str::slug($title). '-' . uniqid('', true);
    }

    /**
     * Convert to slug
     *
     * @param $value
     * @param false $withNumber
     * @return string
     */
    public static function toSlug($value, $withNumber = false)
    {
        $slug = Str::slug($value).'-'.uniqid();
        if ($withNumber) {
            $slug .= rand(99, 999);
        }
        return $slug;
    }
}
