@extends('Manager.account.index')

@section('title', 'Thông tin cá nhân')

@section('extra-js')
    <script src="{{ asset('Libraries/Manager/js/pages/custom/profile/profile.js') }}"></script>
    <script>
        FormValidation.formValidation(
            document.getElementById('js-form-update-profile'),
            {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Địa chỉ email là bắt buộc'
                            },
                            emailAddress: {
                                message: 'Định dạng email không hợp lệ'
                            }
                        }
                    },

                    first_name: {
                        validators: {
                            notEmpty: {
                                message: 'Tên không được để trống'
                            }
                        }
                    },

                    last_name: {
                        validators: {
                            notEmpty: {
                                message: 'Tên không được để trống'
                            }
                        }
                    },

                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'Số điện thoại không được để trống'
                            }
                        }
                    },

                    avatar: {
                        validators: {
                            file: {
                                extension: 'jpeg,jpg,png',
                                type: 'image/jpeg,image/png',
                                maxSize: 2097152,   // 2048 * 1024
                                message: 'File không hợp lệ'
                            }
                        }
                    }
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
        <!--begin::Card-->
        <form class="form" action="{{ route('account.update') }}" method="post" id="js-form-update-profile" enctype="multipart/form-data">
            <div class="card card-custom card-stretch">
                <!--begin::Header-->
                <div class="card-header py-3">
                    <div class="card-title align-items-start flex-column">
                        <h3 class="card-label font-weight-bolder text-dark">Thông tin cá nhân</h3>
                        <span
                            class="text-muted font-weight-bold font-size-sm mt-1">Cập nhật thông tin cá nhân của bạn</span>
                    </div>
                    <div class="card-toolbar">
                        <button type="submit" class="btn btn-success mr-2">Lưu thay đổi</button>
                        <button type="reset" class="btn btn-secondary">Hủy bỏ</button>
                    </div>
                </div>
                @csrf
                <input type="hidden" name="type" value="update-personal-information">
                <div class="card-body">
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mb-6">Thông tin của bạn</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="image-input image-input-outline" id="kt_profile_avatar"
                                 style="background-image: url({{ asset('Libraries/Manager/media/users/blank.png') }})">
                                <div class="image-input-wrapper"
                                     style="background-image: url({{ Auth::user()->avatar }})"></div>
                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Đổi avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg"/>
                                    <input type="hidden" name="profile_avatar_remove"/>
                                </label>
                                <span
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                <span
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                            </div>
                            <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                        </div>
                        @error('avatar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Thẻ căn cước (CMND)</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="image-input image-input-outline" id="kt_identity_front_image"
                                 style="background-image: url({{ asset('Libraries/Manager/media/users/blank.png') }})">
                                <div class="image-input-wrapper"
                                     style="background-image: url({{ Auth::user()->identity->front_image ?? '' }})"></div>
                                <label
                                    class="btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change"
                                    >
                                </label>

                            </div>
{{--                            <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>--}}

                            <div class="image-input image-input-outline ml-5" id="kt_identity_back_image"
                                 style="background-image: url({{ asset('Libraries/Manager/media/users/blank.png') }})">
                                <div class="image-input-wrapper"
                                     style="background-image: url({{ Auth::user()->identity->back_image ?? '' }})"></div>
                                <label
                                    class="btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change"
                                >
                                </label>
                            </div>
                            <input type="file" class="form-control mt-3" name="identity_images[]" accept="image/*" multiple>
                            <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                        </div>
                        @error('identity_images')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        @error('back_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Tên</label>
                        <div class="col-lg-9 col-xl-6">
                            <input name="first_name" class="form-control form-control-lg form-control-solid @error('first_name') is-invalid @enderror" type="text"
                                   value="{{ old('first_name') ? old('first_name') : Auth::user()->first_name }}"/>
                            @error('first_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Họ và tên đệm</label>
                        <div class="col-lg-9 col-xl-6">
                            <input name="last_name" class="form-control form-control-lg form-control-solid @error('last_name') is-invalid @enderror" type="text"
                                   value="{{ old('last_name') ? old('last_name') : Auth::user()->last_name }}"/>
                            @error('last_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mt-10 mb-6">Thông tin liên hệ</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Số điện thoại</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-phone"></i>
                                            </span>
                                </div>
                                <input type="text" name="phone" class="form-control form-control-lg form-control-solid @error('phone') is-invalid @enderror"
                                       value="{{ old('phone') ? old('phone') : Auth::user()->phone }}" placeholder="Phone"/>
                            </div>
                            <span class="form-text text-muted">Chúng tôi sẽ không bao giờ chia sẻ email của bạn với bất kỳ ai khác.</span>
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Địa chỉ Email</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-at"></i>
                                            </span>
                                </div>
                                <input type="text" name="email" class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                       value="{{ old('email') ? old('email') : Auth::user()->email }}" placeholder="Email"/>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
