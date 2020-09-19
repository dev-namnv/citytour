<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
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

        if (Auth::attempt(['username' => $username, 'password' => $password, 'status' => ACTIVE], $remember)) {
            // Authentication passed...
            $message = ['status' => TOASTR_SUCCESS, 'content' => Lang::get('auth.failed')];
            session()->flash(TOASTR, json_encode($message));
            return redirect()->intended('manager');
        } else {
            $message = ['status' => TOASTR_WARNING, 'content' => Lang::get('auth.failed')];
            session()->flash(TOASTR, json_encode($message));
            return redirect()->back()->withInput($request->only('username'));
        }
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

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
