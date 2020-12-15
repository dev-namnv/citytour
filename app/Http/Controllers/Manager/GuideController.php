<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function list()
    {
        $guides = User::withoutGlobalScopes()->where('role', '=', GUIDE)->paginate(5);
        return view('Manager.guide.list', compact(['guides']));
    }

    public function updateStatus(Request $request, $id)
    {
            $guide = User::findOrFail($id);

            $guide->update([
                'status' => $request->status
            ]);

            return response()->json(['flash_message' => 'Cập nhật trạng thái thành công', 'status' => $guide->status]);
    }

    public function updateBehaviorScore(Request $request, $id)
    {
        $this->validate($request, [
            'behavior_score' => 'required|numeric|min:0'
        ]);

        $guide = User::findOrFail($id);

        $guide->update([
            'behavior_score' => $request->behavior_score
        ]);

        return response()->json(['flash_message' => 'Cập nhật điểm hành vi thành công', 'behavior_score' => $guide->behavior_score]);
    }

    public function remove($id)
    {
        $guide = User::findOrFail($id);
        $guide->delete();
        return response()->json(['flash_message' => 'Xóa hướng dẫn viên thành công', 'id' => $id]);
    }
}
