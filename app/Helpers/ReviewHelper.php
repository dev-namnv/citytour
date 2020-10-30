<?php

namespace App\Helpers;

class ReviewHelper
{
    public static function rating($value)
    {
        $total = 0;
        foreach ($value as $item) {
            $total += $item->star;
        }

        return $total !== 0 ? round($total/count($value), 2) . '⭐' : 'NaN';
    }
}
