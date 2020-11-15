<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class ConvertSlugHelper
{
    public static function convert_slug($title)
    {
        return Str::slug($title). '-' . uniqid('', true);
    }
}
