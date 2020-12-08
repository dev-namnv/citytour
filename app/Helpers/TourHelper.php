<?php

namespace App\Helpers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourHelper
{
    public static function searchParams(Request $request, $disable = []) {
        $params = $request->only(['keyword', 'price', 'where', 'when', 'range', 'ranking', 'category', 'page', 'view']);
        foreach ($params as $key => $value) {
            foreach ($disable as $d) {
                if ($key === $d) {
                    unset($params[$key]);
                }
            }
        }

        $searchParams = '';
        foreach ($params as $key => $value) {
            if (array_key_exists($key, $params) && $value) {
                $searchParams .= $key . '=' . $value . '&';
            }
        }

        return rtrim($searchParams, '&');
    }

    public static function count()
    {
        return Tour::all()->count();
    }

    public static function countOfCategory($category_id)
    {
        return Tour::query()->whereHas('category', function ($q) use ($category_id) {
            $q->where('id', $category_id);
        })->get()->count();
    }
}
