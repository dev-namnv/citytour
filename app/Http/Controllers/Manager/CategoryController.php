<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $icons = [
        0 => ['name' => 'Tham quan thành phố', 'icon' => 'icon_set_1_icon-3'],
        1 => ['name' => 'Tham quan bảo tàng', 'icon' => 'icon_set_1_icon-4'],
        2 => ['name' => 'Tòa nhà lịch sử', 'icon' => 'icon_set_1_icon-44'],
        3 => ['name' => 'Những tour đi bộ', 'icon' => 'icon_set_1_icon-37'],
        4 => ['name' => 'Ăn uống', 'icon' => 'icon_set_1_icon-14'],
        5 => ['name' => 'Wifi miễn phí', 'icon' => 'icon_set_1_icon-86'],
        6 => ['name' => 'Churces', 'icon' => 'icon_set_1_icon-43'],
        7 => ['name' => 'Chuyến tham quan đường chân trời ', 'icon' => 'icon_set_1_icon-28']
    ];

    public function list()
    {
        return view('Manager.category.list');
    }

    public function delete($id)
    {
        try {
            $check = Category::query()->find($id);

            if ($check) {
                $check->delete();
            }
            return $check
                ? response(['message' => 'Đã xóa danh mục'])
                : response(['message' => 'Không tìm thấy danh mục'], 404);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Có lỗi xảy ra'], 500);
        }
    }

    public function edit($id)
    {
        $category = Category::query()->findOrFail($id);
        $icons = $this->icons;
        return view('Manager.category.form', compact('category', 'icons'));
    }

    public function create()
    {
        $icons = $this->icons;
        return view('Manager.category.form', compact('icons'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->only('name', 'icon', 'description');
            Category::query()->create($data)->save();
        } catch (\Exception $exception) {
        }
        return redirect()->route('category.list');
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $data = $request->only('name', 'icon', 'description');
            Category::query()->findOrFail($id)->update($data);
        } catch (\Exception $exception) {
        }
        return redirect()->route('category.list');
    }
}
