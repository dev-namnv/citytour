<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {

            $google_account = Socialite::driver('google')->with(['access_type' => 'offline'])->user();
            $user = User::query()
                ->where('google_id', $google_account->id)
                ->orWhere('email', $google_account->email)
                ->first();

            if($user){

                Auth::login($user);

                return redirect()->route('home');

            }else{
                $newUser = User::create([
                    'first_name' => $google_account->name,
                    'last_name' => $google_account->name,
                    'email' => $google_account->email,
                    'google_id'=> $google_account->id,
                    'password' => encrypt('123456dummy')
                ]);
                Auth::login($newUser);

                return redirect()->route('home');
            }
        } catch (Exception $e) {
            \Log::info($e->getMessage());
        }
    }
}
