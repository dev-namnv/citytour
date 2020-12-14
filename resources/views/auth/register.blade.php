@extends('layouts.main.app')

@section('content')
    <main>
        <section id="hero" class="login">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8">
                        <div id="login">
                            <div class="text-center"><img src="/Libraries/Main/img/logo_sticky.png" alt="Image" data-retina="true" ></div>
                            <hr>
                            <form class="form-login" method="post" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"  placeholder="Tên" name="first_name" >
                                </div>
                                <div class="form-group">
                                    <label>Họ</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"  placeholder="Họ" name="last_name">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password1" name="password" placeholder="Mật khẩu">
                                </div>
                                <div class="form-group">
                                    <label>Xác nhận lại mật khẩu</label>
                                    <input type="password" class=" form-control" id="password2" name="password_confirmation" placeholder="Xác nhận lại mật khẩu">
                                </div>
                                <div id="pass-info" class="clearfix"></div>
                                <input type="submit" class="btn_full" value="Đăng ký">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End main -->
@endsection
