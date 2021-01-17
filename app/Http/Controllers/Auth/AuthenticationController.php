<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\StorageS3Helper;
use App\Http\Controllers\Controller;
use App\Mail\NotificationNewGuide;
use App\Mail\RegisterGuide;
use App\Models\IdentityImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class AuthenticationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('authentication.authenticate');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->username;
        $password = $request->password;
        $remember = $request->remember;

        return Auth::attempt(['username' => $username, 'password' => $password, 'status' => ACTIVE], $remember)
            ? redirect()->intended('manager')
            : redirect()->back()->withErrors(['username' => Lang::get('auth.failed')]);
    }

    public function forgot()
    {
        return view('authentication.forgot');
    }

    public function recovery(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT){
            session()->flash('forgotPassword', 'Chúng tôi đã gửi email tới bạn, vui lòng kiểm tra email.');
            return back();
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }

    public function registerGuide(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^(0[0-9]{9})$/',
            'username' => 'required|unique:users|regex:'.REGEX_USERNAME,
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'agree' => 'accepted',
            'images' => 'required|array|min:2|max:2',
            'images.*' => 'required|mimes:jpeg,bmp,png,jpg,gif,svg|max:2000'
        ]);

        $user = new User;
        $user->first_name = $request->first_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->last_name = '';
        $user->role = GUIDE;
        $user->status = 0;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        $pathSaveIdentityImages = 'images/identity';
        $urlFrontImage = StorageS3Helper::getUrlAfterUpload($pathSaveIdentityImages, $request->images[0]);
        $urlBackImage = StorageS3Helper::getUrlAfterUpload($pathSaveIdentityImages, $request->images[1]);
        IdentityImage::create([
            'front_image' => $urlFrontImage,
            'back_image' => $urlBackImage,
            'guide_id' => $user->id
        ]);

        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NotificationNewGuide($user));
        Mail::to($request->email)->send(new RegisterGuide($user));

        session()->flash('register', ['status' => true, 'message' => 'Đăng ký thành công, vui lòng đợi xác thực đăng ký từ chúng tôi.']);

        return redirect()->back();
    }
}
