<?php

namespace App\Helpers;

use App\Models\Tour;

class CartHelper
{
    public static function all()
    {
        return session(CART);
    }

    public static function find($id)
    {
        $item = null;
        $cart = session(CART);
        if ($cart != null) {
            if (array_key_exists($id, $cart)) {
                $item = $cart[$id];
            }
        }
        return $item;
    }

    public static function add($tour, $date, $adult = 1, $child = 0)
    {
        $id = $tour->id;
        $cart = session(CART);

        if (!$cart) { // If cart null
            $cart[$id] = [
                'id' => $tour->id,
                'name' => $tour->name,
                'slug' => $tour->slug,
                'date' => $date,
                'thumbnail' => $tour->thumbnail,
                'adult_price' => $tour->adult_price,
                'child_price' => $tour->child_price,
                'adult_count' => $adult,
                'child_count' => $child
            ];

            session()->put(CART, $cart);
            $message = [
                'status' => true,
                'content' => 'Đã thêm ' . $tour->name . ' vào giỏ'
            ];
        } else {
            if (isset($cart[$id])) {
                $message = [
                    'status' => false,
                    'content' => $tour->name. ' đã có ở trong giỏ hàng'
                ];
            } else {
                $cart[$id] = [
                    'id' => $tour->id,
                    'name' => $tour->name,
                    'slug' => $tour->slug,
                    'date' => $date,
                    'thumbnail' => $tour->thumbnail,
                    'adult_price' => $tour->adult_price,
                    'child_price' => $tour->child_price,
                    'adult_count' => $adult,
                    'child_count' => $child
                ];

                session()->put(CART, $cart);
                $message = [
                    'status' => true,
                    'content' => 'Đã thêm ' . $tour->name . ' vào giỏ'
                ];
            }
        }
        return response()->json($message);
    }

    public static function update($ids, $adult, $child)
    {
        $cart = session(CART);
        if (!CartHelper::check()) {
            $message = [
                'status' => false,
                'content' => 'Giỏ hàng trống'
            ];
        } else {
            for ($i = 0; $i < count($cart); $i++) {
                if ($adult[$i] <= 0 && $child[$i] <= 0) {
                    unset($cart[$ids[$i]]);
                } else {
                    $cart[$ids[$i]]['adult_count'] = $adult[$i];
                    $cart[$ids[$i]]['child_count'] = $child[$i];
                }
            }

            // Save
            session()->put(CART, $cart);
            $message = [
                'status' => true,
                'content' => 'Cập nhật thành công'
            ];
        }
        return response()->json($message);
    }

    public static function remove($id)
    {
        try {
            $cart = session(CART);
            unset($cart[$id]);
            session()->put(CART, $cart);
            return response()->json(['content' => 'Đã xóa Tour khỏi giỏ hàng', 'status' => true]);
        } catch (\Exception $exception) {
            return response()->json(['content' => 'Có lỗi xảy ra', 'status' => false], 500);
        }
    }

    public static function countCart()
    {
        $cart = session(CART);
        if ($cart != null) {
            return count(session(CART)) ?? 0;
        }
        return 0;
    }

    public static function check()
    {
        if (session(CART)) {
            return true;
        }
        return false;
    }

    public static function destroy()
    {
        session()->forget(CART);
    }
}
