@extends('Manager.account.index')

@section('title', 'Bảo mật')

@section('extra-js')
    <script src="{{ asset('Libraries/Manager/js/pages/custom/profile/profile.js') }}"></script>
    <script src="{{ asset('Libraries/Manager/js/pages/widgets.js') }}}"></script>
    <script>
        form = document.getElementById('js-form-update-account');
        FormValidation.formValidation(form,
            {
                fields: {
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng nhập mật khẩu hiện tại'
                            }
                        }
                    },

                    new_password: {
                        validators: {
                            notEmpty: {
                                message: 'Mật khẩu mới là bắt buộc'
                            },
                            stringLength: {
                                min: 8,
                                message: 'Mật khẩu tối thiểu 8 ký tự'
                            }
                        }
                    },
                    confirm_password: {
                        validators: {
                            notEmpty: {
                                message: 'Xác thực mật khẩu là bắt buộc'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="new_password"]').value;
                                },
                                message: 'Xác thực mật khẩu mới không trùng khớp'
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

        // Revalidate the confirmation password when changing the password
        form.querySelector('[name="new_password"]').addEventListener('input', function() {
            fv.revalidateField('confirm_password');
        });
    </script>
@endsection

@section('account-content')
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <form class="form" action="{{ route('account.update') }}" id="js-form-update-account" method="post">
            @csrf
            <input type="hidden" name="type" value="change-password">
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header py-3">
                    <div class="card-title align-items-start flex-column">
                        <h3 class="card-label font-weight-bolder text-dark">Bảo mật</h3>
                        <span class="text-muted font-weight-bold font-size-sm mt-1">Thay đổi mật khẩu tài khoản</span>
                    </div>
                    <div class="card-toolbar">
                        <button type="submit" class="btn btn-success mr-2">Lưu thay đổi</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                    <div class="card-body">
                        <!--begin::Alert-->
                        {{--@if(session()->has('alert'))
                            <div class="alert alert-custom alert-light-danger fade show mb-10" role="alert">
                                <div class="alert-icon">
                                    <span class="svg-icon svg-icon-3x svg-icon-danger">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Info-circle.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             width="24px" height="24px" viewBox="0 0 24 24"
                                             version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none"
                                               fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <circle fill="#000000" opacity="0.3" cx="12"
                                                        cy="12" r="10"/>
                                                <rect fill="#000000" x="11" y="10" width="2"
                                                      height="7" rx="1"/>
                                                <rect fill="#000000" x="11" y="7" width="2"
                                                      height="2" rx="1"/>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <div class="alert-text font-weight-bold">
                                    Thao tác này sẽ thay đổi mật khẩu tài khoản của bạn.
                                    Bạn có chắc muốn đổi mật khẩu?
                                </div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="ki ki-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @endif--}}
                        @error('password')
                            <div class="alert alert-custom alert-light-danger fade show mb-10" role="alert">
                                <div class="alert-icon">
                                    <span class="svg-icon svg-icon-3x svg-icon-danger">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Info-circle.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             width="24px" height="24px" viewBox="0 0 24 24"
                                             version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none"
                                               fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <circle fill="#000000" opacity="0.3" cx="12"
                                                        cy="12" r="10"/>
                                                <rect fill="#000000" x="11" y="10" width="2"
                                                      height="7" rx="1"/>
                                                <rect fill="#000000" x="11" y="7" width="2"
                                                      height="2" rx="1"/>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <div class="alert-text font-weight-bold">
                                    {{ $message }}
                                </div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="ki ki-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @enderror
                        <!--end::Alert-->
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-alert">Mật khẩu hiện tại</label>
                            <div class="col-lg-9 col-xl-6">
                                <input type="password" name="password" class="form-control form-control-lg form-control-solid mb-2"
                                       placeholder="Current password"/>
                                <a href="#" class="text-sm font-weight-bold">Quên mật khẩu ?</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-alert">Mật khẩu mới</label>
                            <div class="col-lg-9 col-xl-6">
                                <input type="password" name="new_password" class="form-control form-control-lg form-control-solid" value=""
                                       placeholder="New password"/>
                                @error('new_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-alert">Xác thực lại</label>
                            <div class="col-lg-9 col-xl-6">
                                <input type="password" name="confirm_password" class="form-control form-control-lg form-control-solid" value=""
                                       placeholder="Verify password"/>
                                @error('confirm_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                <!--end::Form-->
            </div>
        </form>
    </div>
@endsection
