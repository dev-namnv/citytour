@extends('Manager.account.index')

@section('title', 'Cài đặt tài khoản')

@section('extra-js')
    <script src="{{ asset('Libraries/Manager/js/pages/custom/profile/profile.js') }}"></script>
    <script src="{{ asset('Libraries/Manager/js/pages/widgets.js') }}}"></script>
    <script>
        FormValidation.formValidation(
            document.getElementById('js-form-update-account'),
            {
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'Tên đăng nhập không được để trống'
                            },
                            regexp: {
                                regexp: /(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/,
                                message: 'Định dạng tên tài khoản không hợp lệ'
                            }
                        }
                    },

                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Tên không được để trống'
                            },
                            emailAddress: {
                                message: 'Định dạng email không hợp lệ'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                }
            }
        );
    </script>
@endsection

@section('account-content')
    <div class="flex-row-fluid ml-lg-8">
        <form class="form" id="js-form-update-account" action="{{ route('account.update') }}" method="post">
            <div class="card card-custom">
                <div class="card-header py-3">
                    <div class="card-title align-items-start flex-column">
                        <h3 class="card-label font-weight-bolder text-dark">Thông tin tài khoản</h3>
                        <span class="text-muted font-weight-bold font-size-sm mt-1">Thay đổi cài đặt tài khoản</span>
                    </div>
                    <div class="card-toolbar">
                        <button type="submit" class="btn btn-success mr-2">Lưu thay đổi</button>
                        <button type="reset" class="btn btn-secondary">Hủy bỏ</button>
                    </div>
                </div>
                @csrf
                <input type="hidden" name="type" value="update-account-information">
                <div class="card-body">
                    <!--begin::Heading-->
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mb-6">Tài khoản:</h5>
                        </div>
                    </div>
                    <!--begin::Form Group-->
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Username</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="spinner-sm spinner-success spinner-right">
                                <input class="form-control form-control-lg form-control-solid @error('username') is-invalid @enderror" id="username" name="username" type="text" value="{{ old('username') ? old('username') : Auth::user()->username }}" />
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--begin::Form Group-->
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Địa chỉ email</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-at"></i>
                                    </span>
                                </div>
                                <input type="text" name="email" class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" value="{{ old('email') ? old('email') : Auth::user()->email }}" placeholder="Email" />
                            </div>
                            <span class="form-text text-muted">Email sẽ không được hiển thị công khai.
                                <a href="#" class="font-weight-bold">Đọc thêm</a>.</span>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <!--begin::Form Group-->
                    <div class="separator separator-dashed my-5"></div>
                    <!--begin::Form Group-->
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mb-6">Security:</h5>
                        </div>
                    </div>
                    <!--begin::Form Group-->
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Login verification</label>
                        <div class="col-lg-9 col-xl-6">
                            <button type="button" class="btn btn-light-primary font-weight-bold btn-sm">Setup login verification</button>
                            <p class="form-text text-muted pt-2">After you log in, you will be asked for additional information to confirm your identity and protect your account from being compromised.
                                <a href="#" class="font-weight-bold">Learn more</a>.</p>
                        </div>
                    </div>
                    <!--begin::Form Group-->
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Password reset verification</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="checkbox-inline">
                                <label class="checkbox m-0">
                                    <input type="checkbox" />
                                    <span></span>Require personal information to reset your password.</label>
                            </div>
                            <p class="form-text text-muted py-2">For extra security, this requires you to confirm your email or phone number when you reset your password.
                                <a href="#" class="font-weight-boldk">Learn more</a>.</p>
                            <button type="button" class="btn btn-light-danger font-weight-bold btn-sm">Deactivate your account ?</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
