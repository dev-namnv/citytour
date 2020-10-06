<?php

namespace App\Http\Controllers\Main;

use App\Helper\StorageS3Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('layouts/main/profile');
    }
    public function editProfile(Request $request, $id)
    {
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->zipcode = $request->zipcode;
        $user->country = $request->country;
        $urlImage = StorageS3Helper::getUrlAfterUpload('images/avatar', $request->image);
        dd($urlImage);
        $user->avatar = $urlImage;
        $user->save();


        return redirect()->back();
    }
}
