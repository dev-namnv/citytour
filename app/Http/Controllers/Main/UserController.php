<?php

namespace App\Http\Controllers\Main;

use App\Helper\StorageS3Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('Main.profile.show');
    }

    public function editProfile(ProfileRequest $request)
    {
        try {
            $user = User::query()->findOrFail(Auth::id());

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone = $request->phone;
            $user->birthday = $request->birthday;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->zipcode = $request->zipcode;
            $user->country = $request->country;

            if ($request->hasFile('avatar')) {
                $urlImage = StorageS3Helper::getUrlAfterUpload('images/avatar', $request->avatar);
                $user->avatar = $urlImage;
            }

            $user->save();
            session()->flash(TOASTR, json_encode(['status' => TOASTR_SUCCESS,'content' => 'Cập nhật thông tin thành công']));
        } catch (\Exception $exception) {
            session()->flash(TOASTR, json_encode(['status' => TOASTR_ERROR,'content' => 'Có lỗi xảy ra']));
        }
        return redirect()->back();
    }
}
