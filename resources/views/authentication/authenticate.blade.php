@extends('layouts.authentication.app')

@section('title', 'Authenticate')

@section('content')
    <div class="form-content">

        <h1 class="pb-lg-4">Log In to <a href="#"><span class="brand-name">CORK</span></a></h1>
        <form class="text-left form-login" method="post" action="{{ route('authenticate') }}">
            @csrf
            <div class="form">
                <div id="username-field" class="field-wrapper input">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <input id="username" name="username" type="text"
                           class="form-control @error('username') is-invalid @enderror" autocomplete="username"
                           autofocus placeholder="Username" value="{{ old('username') }}">
                    @error('username')
                        <span id="password-error" class="is-invalid invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div id="password-field" class="field-wrapper input mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-lock">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input id="password" name="password" type="password" class="form-control"
                           autocomplete="current-password" placeholder="Password" data-minlength>
                </div>
                <div class="d-sm-flex justify-content-between">
                    <div class="field-wrapper toggle-pass">
                        <p class="d-inline-block">Show Password</p>
                        <label class="switch s-primary">
                            <input type="checkbox" id="toggle-password" class="d-none">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="field-wrapper">
                        <button type="submit" class="btn btn-primary btn-login" value="">Log In</button>
                    </div>

                </div>

                <div class="field-wrapper text-center keep-logged-in">
                    <div class="n-chk new-checkbox checkbox-outline-primary">
                        <label class="new-control new-checkbox checkbox-outline-primary">
                            <input type="checkbox" class="new-control-input" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="new-control-indicator"></span>Keep me logged in
                        </label>
                    </div>
                </div>

                <div class="field-wrapper">
                    <a href="{{ route('forgot-password') }}" class="forgot-pass-link">Forgot Password?</a>
                </div>

            </div>
        </form>
        <p class="terms-conditions">© 2019 All Rights Reserved. <a href="{{ route('home') }}">CORK</a> is a product
            of Designreset. <a href="javascript:void(0);">Cookie Preferences</a>, <a
                href="javascript:void(0);">Privacy</a>, and <a href="javascript:void(0);">Terms</a>.</p>

    </div>
@endsection
