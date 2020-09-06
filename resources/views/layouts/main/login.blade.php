<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>Sign In</h3>
    </div>
    <form class="form-login" method="post" action="{{ route('login') }}">
        @csrf
        <div class="sign-in-wrapper">
            <a href="#0" class="social_bt facebook">Login with Facebook</a>
            <a href="#0" class="social_bt google">Login with Google</a>
            <div class="divider"><span>Or</span></div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                <i class="icon_mail_alt"></i>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autocomplete="current-password">
                <i class="icon_lock_alt"></i>
            </div>
            <div class="clearfix add_bottom_15">
                <div class="checkboxes float-left">
                    <input id="remember-me" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember-me">Remember Me</label>
                </div>
                @if (Route::has('password.request'))
                    <div class="float-right"><a id="forgot" href="#{{--{{ route('password.request') }}--}}">Forgot Password?</a></div>
                @endif
            </div>
            <div class="text-center"><input type="submit" value="Log In" class="btn_login"></div>
            <div class="text-center">
                Don’t have an account? <a href="javascript:void(0);">Sign up</a>
            </div>
            <div id="forgot_pw">
                <form method="post" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <label>Please confirm login email below</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                               id="email_forgot" value="{{ old('email') }}" autocomplete="email" autofocus>
                        <i class="icon_mail_alt"></i>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
                    <div class="text-center">
                        <button type="submit" class="btn_1">Reset Password</button>
{{--                        <input type="submit" value="Reset Password" class="btn_1">--}}
                    </div>
                </form>
            </div>
        </div>
    </form>
    <!--form -->
</div>
