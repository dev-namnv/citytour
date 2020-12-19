@extends('layouts.main.app')
@section('title','Đăng Nhập')
@section('content')
    <main>
        <section id="hero" class="login">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8">
                        <div id="login">
                            <div class="text-center"><img src="{{ asset('/Libraries/Main/img/logo_sticky.png') }}" alt="Image" data-retina="true" ></div>
                            <hr>
                            <form class="form-login" method="post" action="{{ route('login') }}">
                                @csrf
                                <a href="{{ route('social.google') }}" class="social_bt google">Đăng nhập với Google</a>
                                <div class="divider"><span>Or</span></div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autocomplete="current-password">
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End main -->
@endsection
