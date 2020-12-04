@extends('Manager.account.index')

@section('title', 'Cài đặt thông báo')

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
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Cài đặt email</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Thay đổi cài đặt email</span>
                </div>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-success mr-2">Lưu thay đổi</button>
                    <button type="reset" class="btn btn-secondary">Hủy bỏ</button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form">
                <div class="card-body">
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mb-6">Cài đặt email thông báo</h5>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label class="col-xl-3 col-lg-3 col-form-label font-weight-bold text-left text-lg-right">Email thông báo</label>
                        <div class="col-lg-9 col-xl-6">
                            <span class="switch switch-sm">
                                <label>
                                    <input type="checkbox" checked="checked"
                                           name="email_notification_1"/>
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label class="col-xl-3 col-lg-3 col-form-label font-weight-bold text-left text-lg-right">Send
                            Copy To Personal Email</label>
                        <div class="col-lg-9 col-xl-6">
                            <span class="switch switch-sm">
                                <label>
                                    <input type="checkbox" name="email_notification_2"/>
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mb-6">Email liên quan đến hoạt động:</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label font-weight-bold text-left text-lg-right">Khi nào gửi email</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="checkbox-list">
                                <label class="checkbox">
                                    <input type="checkbox"/>
                                    <span></span>Khi bạn có thông báo mới</label>
                                <label class="checkbox checkbox-primary">
                                    <input type="checkbox"/>
                                    <span></span>Theo đơn đặt hàng mới</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
@endsection
