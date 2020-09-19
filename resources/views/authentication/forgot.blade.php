@extends('layouts.authentication.app')

@section('title', 'Password Recovery')

@section('content')
    <div class="form-content">

        <h1 class="">Password Recovery</h1>
        <p class="signup-link">Enter your email and instructions will sent to you!</p>
        <form class="text-left form-forgot-password" method="post" action="{{ route('recovery') }}">
            @csrf
            <div class="form">

                <div id="email-field" class="field-wrapper input">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-at-sign">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
                    </svg>
                    <input id="email" name="email" type="text"
                           class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                           placeholder="Email" autocomplete="email">
                    @error('email')
                        <span id="password-error" class="is-invalid invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-sm-flex justify-content-between">
                    <div class="field-wrapper">
                        <button type="submit" class="btn btn-primary" value="">Reset</button>
                    </div>
                </div>

            </div>
        </form>
        <p class="terms-conditions">© 2019 All Rights Reserved. <a href="index-2.html">CORK</a> is a product of
            Designreset. <a href="javascript:void(0);">Cookie Preferences</a>, <a href="javascript:void(0);">Privacy</a>,
            and <a href="javascript:void(0);">Terms</a>.</p>

    </div>
@endsection
