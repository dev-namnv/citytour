@extends('layouts.main.app')

@section('content')
    <main>
        <section id="hero" class="login">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8">
                        <div id="login">
                            <div class="text-center"><img src="./img/logo.png" alt="Image" data-retina="true" ></div>
                            <hr>
                            <form class="form-login" method="post" action="{{ route('login') }}">
                                @csrf
                                <a href="#0" class="social_bt facebook">Login with Facebook</a>
                                <a href="#0" class="social_bt google">Login with Google</a>
                                <div class="divider"><span>Or</span></div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autocomplete="current-password">
                                </div>
                                <div class="clearfix add_bottom_15">
                                    <div class="checkboxes float-left">
                                        <input id="remember-me" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember-me">Remember Me</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <div class="float-right"><a id="forgot" href="#">Forgot Password?</a></div>
                                    @endif
                                </div>
                                <div class="text-center"><input type="submit" value="Log In" class="btn_login"></div>
                                <div class="text-center">
                                    Don’t have an account? <a href="{{route('register')}}">Sign up</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End main -->
@endsection
