<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>Đăng nhập</h3>
    </div>

        <div class="sign-in-wrapper">
            <a href="{{route('social.google')}}" class="social_bt google">Đăng nhập với Google</a>
            <div class="divider"><span>Or</span></div>

            <form class="form-login" method="post" action="{{ route('login') }}">
                @csrf
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
                    <label>Mật khẩu</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autocomplete="current-password">
                    <i class="icon_lock_alt"></i>
                </div>
                <div class="clearfix add_bottom_15">
                    <div class="checkboxes float-left">
                        <input id="remember-me" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember-me">Lưu tài khoản</label>
                    </div>
                    @if (Route::has('password.request'))
                        <div class="float-right"><a id="forgot" href="#">Quên mật khẩu?</a></div>
                    @endif
                </div>
                <div class="text-center"><input type="submit" value="Đăng nhập" class="btn_login"></div>
                <div class="text-center">
                    Bạn chưa có tài khoản? <a href="{{route('register')}}">Đăng ký</a>
                </div>
            </form>

            <form class="form-forgot-password" method="post" action="{{ route('password.email') }}">
                @csrf
                <div id="forgot_pw">
                    <div class="form-group pb-3">
                        <label>Vui lòng xác thực email đăng nhập</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email_forgot" name="email" value="{{ old('email') }}" autocomplete="email">
                        <i class="icon_mail_alt"></i>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <p>Bạn sẽ nhận được một email có chứa liên kết cho phép bạn đặt lại mật khẩu của mình thành mật khẩu mới.</p>
                    <div class="text-center">
                        <button type="submit" class="btn_1">Gửi liên kết</button>
                    </div>
                </div>
            </form>

        </div>
    <!--form -->
</div>
