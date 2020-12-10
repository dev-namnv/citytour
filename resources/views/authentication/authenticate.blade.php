@extends('layouts.authentication.app')

@section('title', 'Authenticate')

@section('extra-js')
    <script>
        @if($errors->any())
            swal.fire({
                text: '{!! implode('', $errors->all(':message')) !!}',
                icon: "warning",
                buttonsStyling: false,
                confirmButtonText: "Ok, tôi hiểu rồi!",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                }
            }).then(function() {
                KTUtil.scrollTop();
            });
        @endif

        @if(session()->has('forgotPassword') && session('forgotPassword') !== '')
            swal.fire({
                text: '{{ session('forgotPassword') }}',
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, tôi hiểu rồi!",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                }
            }).then(function() {
                KTUtil.scrollTop();
            });
        @endif

        @if(session()->has('register'))
        swal.fire({
            text: '{{ session('register')['message'] }}',
            icon: '{{ session('register')['status'] === true ? "success" : "error" }}',
            buttonsStyling: false,
            confirmButtonText: "Ok, tôi hiểu rồi!",
            customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary"
            }
        }).then(function() {
            KTUtil.scrollTop();
        });
        @endif
    </script>
@endsection
@isset($register)
    @dd($register)
@endisset
@section('content')
    <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background-image: url({{ asset('Libraries/Manager/media/bg/bg-2.jpg') }});">
            <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                <div class="d-flex flex-center mb-15">
                    <a href="#">
                        <img src="{{ asset('Libraries/Main/img/logo.png') }}" class="max-h-75px" alt="" />
                    </a>
                </div>
                <div class="login-signin">
                    <div class="mb-20">
                        <h3 class="opacity-40 font-weight-normal">Đăng nhập vào Quản trị</h3>
                        <p class="opacity-40">Điền thông tin của bạn vào biểu mẫu đăng nhập:</p>
                    </div>
                    <form class="form" id="kt_login_signin_form" method="post" action="{{ route('authenticate') }}">
                        @csrf
                        <div class="form-group">
                            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="Username" name="username" autocomplete="off" value="{{ old('username') }}" />
                        </div>
                        <div class="form-group">
                            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="password" placeholder="Password" name="password" />
                        </div>
                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8 opacity-60">
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                                    <input type="checkbox" name="remember" />
                                    <span></span>Lưu đăng nhập</label>
                            </div>
                            <a href="javascript:;" id="kt_login_forgot" class="text-white font-weight-bold">Quên mật khẩu</a>
                        </div>
                        <div class="form-group text-center mt-10">
                            <button id="kt_login_signin_submit" type="submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">Đăng nhập</button>
                        </div>
                    </form>
                    <div class="mt-10">
                        <span class="opacity-40 mr-4">Bạn chưa có tài khoản ?</span>
                        <a href="javascript:;" id="kt_login_signup" class="text-white opacity-30 font-weight-normal">Đăng ký làm Hướng dẫn viên</a>
                    </div>
                </div>
                <!--end::Login Sign in form-->
                <!--begin::Login Sign up form-->
                <div class="login-signup">
                    <div class="mb-20">
                        <h3 class="opacity-40 font-weight-normal">Đăng ký</h3>
                        <p class="opacity-40">Nhập thông tin tài khoản đăng ký</p>
                    </div>
                    <form class="form text-center" id="kt_login_signup_form" action="{{ route('register-guide') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8 @error('first_name') is-invalid @enderror" type="text" placeholder="Tên" name="first_name" value="{{ old('first_name') }}" />
                        </div>
                        <div class="form-group">
                            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8 @error('email') is-invalid @enderror" type="text" placeholder="Địa chỉ email" name="email" autocomplete="off" value="{{ old('email') }}" />
                        </div>
                        <div class="form-group">
                            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8 @error('username') is-invalid @enderror" type="text" placeholder="Tên tài khoản đăng nhập" name="username" autocomplete="off" value="{{ old('username') }}" />
                        </div>
                        <div class="form-group">
                            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8 @error('password') is-invalid @enderror" type="password" placeholder="Mật khẩu" name="password" />
                        </div>
                        <div class="form-group">
                            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8 @error('password_confirm') is-invalid @enderror" type="password" placeholder="Nhập lại mật khẩu" name="password_confirm" />
                        </div>
                        <div class="form-group text-left px-8">
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-outline checkbox-white opacity-60 text-white m-0 @error('agree') is-invalid @enderror">
                                    <input type="checkbox" name="agree" />
                                    <span></span>Tôi đồng ý với
                                    <a href="#" class="text-white font-weight-bold ml-1">các điều khoản và điều kiện</a>.</label>
                            </div>
                            <div class="form-text text-muted text-center"></div>
                        </div>
                        <div class="form-group">
                            <button id="kt_login_signup_submit" type="submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3 m-2">Đăng ký</button>
                            <button id="kt_login_signup_cancel" class="btn btn-pill btn-outline-white opacity-70 px-15 py-3 m-2">Hủy</button>
                        </div>
                    </form>
                </div>
                <!--end::Login Sign up form-->
                <!--begin::Login forgot password form-->
                <div class="login-forgot">
                    <div class="mb-20">
                        <h3 class="opacity-40 font-weight-normal">Quên mật khẩu?</h3>
                        <p class="opacity-40">Nhập địa chỉ email của bạn để lấy lại mật khẩu</p>
                    </div>
                    <form class="form" id="kt_login_forgot_form" method="post" action="{{ route('recovery') }}">
                        @csrf
                        <div class="form-group mb-10">
                            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}" />
                        </div>
                        <div class="form-group">
                            <button id="kt_login_forgot_submit" type="submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3 m-2">Gửi yêu cầu</button>
                            <button id="kt_login_forgot_cancel" class="btn btn-pill btn-outline-white opacity-70 px-15 py-3 m-2">Hủy</button>
                        </div>
                    </form>
                </div>
                <!--end::Login forgot password form-->
            </div>
        </div>
    </div>
@endsection
