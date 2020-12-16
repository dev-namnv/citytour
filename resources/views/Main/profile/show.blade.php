@extends('layouts.main.app')

@section('extra-css')
    <link href="{{ asset('Libraries/Main/css/admin.css') }}" rel="stylesheet">
    <style>
        .invalid-feedback {
            display: block !important;
        }
    </style>
@endsection

@section('extra-js')
    <script src="{{ asset('Libraries/Main/js/tabs.js') }}"></script>
    <script>
        new CBPFWTabs(document.getElementById('tabs'));
    </script>
    <script>
        $('.wishlist_close_admin').on('click', function (c) {
            $(this).parent().parent().parent().fadeOut('slow', function (c) {
            });
        });
    </script>
@endsection

@section('content')
    <section class="parallax-window" data-parallax="scroll"
             data-image-src="{{ asset('Libraries/Main/img/admin_top.jpg') }}" data-natural-width="1400"
             data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Xin chào {{ Auth::user()->getFullName() }}!</h1>
                <p>@lang('pages.user.profile.desc')</p>
            </div>
        </div>
    </section>

    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">@lang('pages.home.name')</a></li>
                    <li>@lang('pages.user.profile.label.name')</li>
                </ul>
            </div>
        </div>

        <div class="margin_60 container">
            <div id="tabs" class="tabs">
                <nav>
                    <ul>
                        <li><a href="#update-profile"
                               class="icon-profile"><span>@lang('pages.user.profile.label.profile')</span></a>
                        </li>
                    </ul>
                </nav>
                <div class="content">

                    <section id="update-profile">
                        <form method="post" action="{{ route('profile.edit') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Your profile</h4>
                                    <ul id="profile_summary">
                                        <li>@lang('pages.user.profile.label.first_name')
                                            <span>{{ Auth::user()->first_name }}</span>
                                        </li>
                                        <li>@lang('pages.user.profile.label.last_name')
                                            <span>{{ Auth::user()->last_name }}</span>
                                        </li>
                                        <li>@lang('pages.user.profile.label.phone')
                                            <span>{{ Auth::user()->phone }}</span>
                                        </li>
                                        <li>@lang('pages.user.profile.label.birthday')
                                            <span>{{ \Carbon\Carbon::parse(Auth::user()->birthday)->format('d-m-Y') }}</span>
                                        </li>
                                        <li>@lang('pages.user.profile.label.address')
                                            <span>{{ Auth::user()->address }}</span>
                                        </li>
                                        <li>@lang('pages.user.profile.label.city')<span>{{ Auth::user()->city }}</span>
                                        </li>
                                        <li>@lang('pages.user.profile.label.zipcode')
                                            <span>{{ Auth::user()->zipcode }}</span>
                                        </li>
                                        <li>@lang('pages.user.profile.label.country')
                                            <span>{{ Auth::user()->country }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <img src="{{ Auth::user()->avatar }}" alt="Image"
                                             class="img-fluid styled profile_pic">
                                    </p>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Cập nhật thông tin cá nhân</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input class="form-control" name="first_name" id="first_name" type="text" value="{{ auth()->user()->first_name }}">
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Họ và tên đệm</label>
                                        <input class="form-control" name="last_name" id="last_name" type="text" value="{{ auth()->user()->last_name }}">
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input class="form-control" name="phone" type="text" value="{{ auth()->user()->phone }}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ngày sinh <small>(dd/mm/yyyy)</small>
                                        </label>
                                        <input class="form-control" name="birthday" type="date" value="{{ \Carbon\Carbon::parse(auth()->user()->birthday)->format('d/m/Y') }}">
                                        @error('birthday')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Địa chỉ</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Đường</label>
                                        <input class="form-control" name="address" type="text" value="{{ auth()->user()->address }}">
                                        @error('address')
                                             <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Thành phố/Thị trấn</label>
                                        <input class="form-control" name="city" type="text" value="{{ auth()->user()->city }}">
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Zip code</label>
                                        <input class="form-control" name="zipcode" type="text" value="{{ auth()->user()->zipcode }}">
                                        @error('zipcode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quốc gia</label>
                                        @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <select id="country" class="form-control" name="country">
                                            <option class="text-capitalize"
                                                    value="{{Auth::user()->country}}">{{Auth::user()->country}}</option>
                                            <option value="vi">Việt Nam</option>
                                            <option class="text-capitalize" value="korean">Korean</option>
                                            <option class="text-capitalize" value="japan">Japan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h4>Cập nhật avatar</h4>
                            <div class="form-inline upload_1">
                                <div class="form-group">
                                    <input type="file" name="avatar" id="js-upload-files" multiple>
                                    @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn_1 green">Cập nhật</button>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </main>
@endsection
