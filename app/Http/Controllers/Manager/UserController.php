<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLogLocation;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $profile = User::where('role', '=', \USER)->paginate(5);
        return view('Manager.profile.profile', ['profile' => $profile]);
    }
    public function detailProfile($id)
    {
        $profile = User::find($id);
        return view('Manager.profile.profiledetail', ['profile' => $profile]);
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'status' => $request->status
        ]);

        return response()->json(['flash_message' => 'Cập nhật trạng thái thành công', 'status' => $user->status]);
    }

    public function locationLogs()
    {
        $logs = UserLogLocation::query()->orderBy('id','desc')
            ->with('user')
            ->paginate(25);
        return view('Manager.log.log-location',compact('logs'));
    }
}
