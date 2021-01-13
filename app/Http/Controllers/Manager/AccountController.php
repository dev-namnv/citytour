<?php

namespace App\Http\Controllers\Manager;

use App\Helpers\BreadcrumbHelper;
use App\Helpers\StorageS3Helper;
use App\Http\Controllers\Controller;
use App\Models\IdentityImage;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * Overview
     *
     * @return Application|Factory|View
     */
    public function overview()
    {
        $breadcrumbs = [
            new BreadcrumbHelper('Tài khoản', \route('account')),
            new BreadcrumbHelper('Overview', route('account.overview'))
        ];
        return view('Manager.account.overview', compact('breadcrumbs'));
    }

    /**
     * Thông tin cá nhân
     *
     * @return Application|Factory|View
     */
    public function personalInformation()
    {
        $breadcrumbs = [
            new BreadcrumbHelper('Tài khoản', \route('account')),
            new BreadcrumbHelper('Thông tin cá nhân', route('account.personal-information'))
        ];
        return view('Manager.account.personalInformation', compact('breadcrumbs'));
    }

    /**
     * Cài đặt tài khoản
     *
     * @return Application|Factory|View
     */
    public function accountInformation()
    {
        $breadcrumbs = [
            new BreadcrumbHelper('Tài khoản', \route('account')),
            new BreadcrumbHelper('Cài đặt tài khoản', route('account.account-information'))
        ];
        return view('Manager.account.accountInformation', compact('breadcrumbs'));
    }

    /**
     * Đổi mật khẩu
     *
     * @return Application|Factory|View
     */
    public function changePassword ()
    {
        session()->flash('alert', true);
        $breadcrumbs = [
            new BreadcrumbHelper('Tài khoản', \route('account')),
            new BreadcrumbHelper('Bảo mật', route('account.change-password'))
        ];
        return view('Manager.account.changePassword', compact('breadcrumbs'));
    }

    /**
     * Cài đặt email thông báo
     *
     * @return Application|Factory|View
     */
    public function emailSetting ()
    {
        $breadcrumbs = [
            new BreadcrumbHelper('Tài khoản', \route('account')),
            new BreadcrumbHelper('Cài đặt thông báo', route('account.email-setting'))
        ];
        return view('Manager.account.emailSetting', compact('breadcrumbs'));
    }

    /**
     * Cập nhật tất cả thông tin
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateInformation(Request $request)
    {
        if ($request->type === 'update-personal-information') {
            $request->validate([
                'first_name' => 'required|string|min:5',
                'last_name' => 'required|string',
                'phone' => 'required',
                'email' => [
                    'required',
                    $request->email !== Auth::user()->email
                        ? Rule::unique('users')->where(function ($query) use($request){
                        $query->where('email', '=',  $request->email);
                    })
                        : ''
                ],
                'avatar' => 'nullable|image|mimes:jpeg,jpg,png',
                'identity_images' => 'array|min:2|max:2',
                'identity_images.*' => 'mimes:jpeg,bmp,png,jpg,gif,svg|max:2000'
            ]);

            $user_id = auth()->user()->id;
            $checkIdentityExist = IdentityImage::where('guide_id', '=', $user_id)->first();

            if ($request->hasFile('identity_images')) {
                $urlFrontImage = StorageS3Helper::getUrlAfterUpload('images/identity', $request->identity_images[0]);
                $urlBackImage = StorageS3Helper::getUrlAfterUpload('images/identity', $request->identity_images[1]);

                if (!$checkIdentityExist) {
                    IdentityImage::create([
                        'front_image' => $urlFrontImage,
                        'back_image' => $urlBackImage,
                        'guide_id' => $user_id
                    ]);
                } else {
                    $checkIdentityExist->update([
                        'front_image' => $urlFrontImage,
                        'back_image' => $urlBackImage
                    ]);
                }
            }

            $data = $request->only(['first_name', 'last_name', 'phone', 'email']);

            $user = User::query()->findOrFail(Auth::id());
            if ($request->hasFile('avatar')) {
                $data['avatar'] = StorageS3Helper::getUrlAfterUpload('user/avatar', $request->file('avatar'));
                Auth::user()->avatar = $data['avatar'];
            }
            $user->update($data);

            Auth::user()->first_name = $user->first_name;
            Auth::user()->last_name = $user->last_name;
            Auth::user()->phone = $user->phone;
            Auth::user()->email = $user->email;

            return redirect()->back();
        } elseif ($request->type === 'update-account-information') {
            $request->validate([
                'username' => [
                    'required',
                    'min:8',
                    'max:20',
                    'regex:/(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/',
                    $request->username !== Auth::user()->username
                        ? Rule::unique('users')->where(function ($query) use($request){
                        $query->where('username', '=',  $request->username);
                    })
                        : ''
                ],
                'email' => [
                    'required',
                    $request->email !== Auth::user()->email
                        ? Rule::unique('users')->where(function ($query) use($request){
                        $query->where('email', '=',  $request->email);
                    })
                        : ''
                ]
            ]);
            $data = $request->only(['username', 'email']);

            $user = User::query()->findOrFail(Auth::id());

            $user->update($data);

            Auth::user()->username = $user->username;
            Auth::user()->email = $user->email;

            return redirect()->back();
        } elseif ($request->type === 'change-password') {
            $request->validate([
                'password' => [
                    'required'
                ],
                'new_password' => [
                    'required',
                    'min:8'
                ],
                'confirm_password' => [
                    'required',
                    'same:new_password'
                ]
            ]);
            if (! Hash::check($request->password, $request->user()->password)) {
                return back()->withErrors([
                    'password' => 'Mật khẩu được cung cấp không khớp với hồ sơ của chúng tôi.'
                ]);
            }

            $user = User::query()->findOrFail(Auth::id());
            $user->password = Hash::make($request->new_password);
            $user->save();
            Auth::logout();

            return redirect()->route('authentication');
        } else {
            return redirect()->back();
        }

    }
}
