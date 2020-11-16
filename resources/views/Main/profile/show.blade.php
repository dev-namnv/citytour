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
                        <li><a href="#booking"
                               class="icon-booking"><span>@lang('pages.user.profile.label.booking')</span></a>
                        </li>
                        <li><a href="#wishlist"
                               class="icon-wishlist"><span>@lang('pages.user.profile.label.wishlist')</span></a>
                        </li>
                        <li><a href="#authentic"
                               class="icon-settings"><span>@lang('pages.user.profile.label.settings')</span></a>
                        </li>
                        <li><a href="#update-profile"
                               class="icon-profile"><span>@lang('pages.user.profile.label.profile')</span></a>
                        </li>
                    </ul>
                </nav>
                <div class="content">

                    <section id="booking">
                        <div id="tools">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-6">
                                    <div class="styled-select-filters">
                                        <select name="sort_type" id="sort_type">
                                            <option value="" selected>Sort by type</option>
                                            <option value="tours">Tours</option>
                                            <option value="hotels">Hotels</option>
                                            <option value="transfers">Transfers</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-3 col-6">
                                    <div class="styled-select-filters">
                                        <select name="sort_date" id="sort_date">
                                            <option value="" selected>Sort by date</option>
                                            <option value="oldest">Oldest</option>
                                            <option value="recent">Recent</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="strip_booking">
                            <div class="row">
                                <div class="col-lg-2 col-md-2">
                                    <div class="date">
                                        <span class="month">Dec</span>
                                        <span class="day"><strong>23</strong>Sat</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-5">
                                    <h3 class="hotel_booking">Hotel Mariott Paris<span>2 Adults / 2 Nights</span></h3>
                                </div>
                                <div class="col-lg-2 col-md-3">
                                    <ul class="info_booking">
                                        <li><strong>Booking id</strong> 23442</li>
                                        <li><strong>Booked on</strong> Sat. 23 Dec. 2015</li>
                                    </ul>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="booking_buttons">
                                        <a href="#0" class="btn_2">Edit</a>
                                        <a href="#0" class="btn_3">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="strip_booking">
                            <div class="row">
                                <div class="col-lg-2 col-md-2">
                                    <div class="date">
                                        <span class="month">Dec</span>
                                        <span class="day"><strong>27</strong>Fri</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-5">
                                    <h3 class="tours_booking">Louvre Museum<span>2 Adults / 2 Childs</span></h3>
                                </div>
                                <div class="col-lg-2 col-md-3">
                                    <ul class="info_booking">
                                        <li><strong>Booking id</strong> 23442</li>
                                        <li><strong>Booked on</strong> Sat. 20 Dec. 2015</li>
                                    </ul>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="booking_buttons">
                                        <a href="#0" class="btn_2">Edit</a>
                                        <a href="#0" class="btn_3">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="strip_booking">
                            <div class="row">
                                <div class="col-lg-2 col-md-2">
                                    <div class="date">
                                        <span class="month">Dec</span>
                                        <span class="day"><strong>28</strong>Fri</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-5">
                                    <h3 class="tours_booking">Tour Eiffel<span>2 Adults</span></h3>
                                </div>
                                <div class="col-lg-2 col-md-3">
                                    <ul class="info_booking">
                                        <li><strong>Booking id</strong> 23442</li>
                                        <li><strong>Booked on</strong> Sat. 20 Dec. 2015</li>
                                    </ul>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="booking_buttons">
                                        <a href="#0" class="btn_2">Edit</a>
                                        <a href="#0" class="btn_3">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="strip_booking">
                            <div class="row">
                                <div class="col-lg-2 col-md-2">
                                    <div class="date">
                                        <span class="month">Dec</span>
                                        <span class="day"><strong>30</strong>Fri</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-5">
                                    <h3 class="transfers_booking">Orly Airport<span>2 Adults / 2Childs</span></h3>
                                </div>
                                <div class="col-lg-2 col-md-3">
                                    <ul class="info_booking">
                                        <li><strong>Booking id</strong> 23442</li>
                                        <li><strong>Booked on</strong> Sat. 20 Dec. 2015</li>
                                    </ul>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="booking_buttons">
                                        <a href="#0" class="btn_2">Edit</a>
                                        <a href="#0" class="btn_3">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>

                    <section id="wishlist">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="hotel_container">
                                    <div class="img_container">
                                        <a href="single_hotel.html">
                                            <img src="{{ asset('Libraries/Main/img/hotel_1.jpg') }}" width="800"
                                                 height="533" class="img-fluid" alt="Image">
                                            <div class="ribbon top_rated">
                                            </div>
                                            <div class="score">
                                                <span>7.5</span>Good
                                            </div>
                                            <div class="short_info hotel">
                                                From/Per night<span class="price"><sup>$</sup>59</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="hotel_title">
                                        <h3><strong>Park Hyatt</strong> Hotel</h3>
                                        <div class="rating">
                                            <i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                                class="icon-star voted"></i><i class="icon-star voted"></i><i
                                                class="icon-star-empty"></i>
                                        </div>
                                        <!-- end rating -->
                                        <div class="wishlist_close_admin">
                                            -
                                        </div>
                                    </div>
                                </div>
                                <!-- End box tour -->
                            </div>
                            <!-- End col-md-6 -->

                            <div class="col-lg-4 col-md-6 ">
                                <div class="hotel_container">
                                    <div class="img_container">
                                        <a href="single_hotel.html">
                                            <img src="{{ asset('Libraries/Main/img/hotel_2.jpg') }}" width="800"
                                                 height="533" class="img-fluid" alt="Image">
                                            <div class="ribbon top_rated">
                                            </div>
                                            <div class="score">
                                                <span>9.0</span>Superb
                                            </div>
                                            <div class="short_info hotel">
                                                From/Per night<span class="price"><sup>$</sup>45</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="hotel_title">
                                        <h3><strong>Mariott</strong> Hotel</h3>
                                        <div class="rating">
                                            <i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                                class="icon-star voted"></i><i class="icon-star voted"></i><i
                                                class="icon-star-empty"></i>
                                        </div>
                                        <!-- end rating -->
                                        <div class="wishlist_close_admin">
                                            -
                                        </div>
                                    </div>
                                </div>
                                <!-- End box -->
                            </div>
                            <!-- End col-md-6 -->

                            <div class="col-lg-4 col-md-6">
                                <div class="tour_container">
                                    <div class="img_container">
                                        <a href="single_tour.html">
                                            <img src="{{ asset('Libraries/Main/img/tour_box_1.jpg') }}" width="800"
                                                 height="533" class="img-fluid" alt="Image">
                                            <div class="ribbon top_rated">
                                            </div>
                                            <div class="short_info">
                                                <i class="icon_set_1_icon-44"></i>Historic Buildings<span class="price"><sup>$</sup>45</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="tour_title">
                                        <h3><strong>Arc Triomphe</strong> tour</h3>
                                        <div class="rating">
                                            <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i
                                                class="icon-smile voted"></i><i class="icon-smile voted"></i><i
                                                class="icon-smile"></i><small>(75)</small>
                                        </div>
                                        <!-- end rating -->
                                        <div class="wishlist_close_admin">
                                            -
                                        </div>
                                    </div>
                                </div>
                                <!-- End box tour -->
                            </div>
                            <!-- End col-md-6 -->

                            <div class="col-lg-4 col-md-6">
                                <div class="tour_container">
                                    <div class="img_container">
                                        <a href="single_tour.html">
                                            <img src="{{ asset('Libraries/Main/img/tour_box_3.jpg') }}" width="800"
                                                 height="533" class="img-fluid" alt="Image">
                                            <div class="ribbon popular">
                                            </div>
                                            <div class="short_info">
                                                <i class="icon_set_1_icon-44"></i>Historic Buildings<span class="price"><sup>$</sup>45</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="tour_title">
                                        <h3><strong>Versailles</strong> tour</h3>
                                        <div class="rating">
                                            <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i
                                                class="icon-smile voted"></i><i class="icon-smile voted"></i><i
                                                class="icon-smile"></i><small>(75)</small>
                                        </div>
                                        <!-- end rating -->
                                        <div class="wishlist_close_admin">
                                            -
                                        </div>
                                    </div>
                                </div>
                                <!-- End box tour -->
                            </div>
                            <!-- End col-md-6 -->

                            <div class="col-lg-4 col-md-6">
                                <div class="tour_container">
                                    <div class="img_container">
                                        <a href="single_tour.html">
                                            <img src="{{ asset('Libraries/Main/img/tour_box_4.jpg') }}" width="800"
                                                 height="533" class="img-fluid" alt="Image">
                                            <div class="ribbon popular">
                                            </div>
                                            <div class="short_info">
                                                <i class="icon_set_1_icon-30"></i>Walking tour<span
                                                    class="price"><sup>$</sup>45</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="tour_title">
                                        <h3><strong>Pompidue</strong> tour</h3>
                                        <div class="rating">
                                            <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i
                                                class="icon-smile voted"></i><i class="icon-smile voted"></i><i
                                                class="icon-smile"></i><small>(75)</small>
                                        </div>
                                        <!-- end rating -->
                                        <div class="wishlist_close_admin">
                                            -
                                        </div>
                                    </div>
                                </div>
                                <!-- End box tour -->
                            </div>
                            <!-- End col-md-6 -->

                            <div class="col-lg-4 col-md-6">
                                <div class="transfer_container">
                                    <div class="img_container">
                                        <a href="single_transfer.html">
                                            <img src="{{ asset('Libraries/Main/img/transfer_1.jpg') }}" width="800"
                                                 height="533" class="img-fluid" alt="Image">
                                            <div class="ribbon top_rated">
                                            </div>
                                            <div class="short_info">
                                                From/Per person<span class="price"><sup>$</sup>45</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="transfer_title">
                                        <h3><strong>Orly Airport</strong> private</h3>
                                        <div class="rating">
                                            <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i
                                                class="icon-smile voted"></i><i class="icon-smile voted"></i><i
                                                class="icon-smile"></i><small>(75)</small>
                                        </div>
                                        <!-- end rating -->
                                        <div class="wishlist_close_admin">
                                            -
                                        </div>
                                    </div>
                                </div>
                                <!-- End box tour -->
                            </div>
                            <!-- End col-md-6 -->

                        </div>
                        <!-- End row -->
                        <button type="submit" class="btn_1 green">Update wishlist</button>
                    </section>

                    <section id="authentic">
                        <div class="row">
                            <div class="col-md-6 add_bottom_30">
                                <h4>Change your password</h4>
                                <div class="form-group">
                                    <label>Old password</label>
                                    <input class="form-control" name="old_password" id="old_password" type="password">
                                </div>
                                <div class="form-group">
                                    <label>New password</label>
                                    <input class="form-control" name="new_password" id="new_password" type="password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm new password</label>
                                    <input class="form-control" name="confirm_new_password" id="confirm_new_password"
                                           type="password">
                                </div>
                                <button type="submit" class="btn_1 green">Update Password</button>
                            </div>
                            <div class="col-md-6 add_bottom_30">
                                <h4>Change your email</h4>
                                <div class="form-group">
                                    <label>Old email</label>
                                    <input class="form-control" name="old_email" id="old_email" type="email">
                                </div>
                                <div class="form-group">
                                    <label>New email</label>
                                    <input class="form-control" name="new_email" id="new_email" type="email">
                                </div>
                                <div class="form-group">
                                    <label>Confirm new email</label>
                                    <input class="form-control" name="confirm_new_email" id="confirm_new_email"
                                           type="email">
                                </div>
                                <button type="submit" class="btn_1 green">Update Email</button>
                            </div>
                        </div>
                        <!-- End row -->

                        <hr>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>Notification settings</h4>
                                <table class="table table-striped options_cart">
                                    <tbody>
                                    <tr>
                                        <td style="width:10%">
                                            <i class="icon_set_1_icon-33"></i>
                                        </td>
                                        <td style="width:60%">
                                            New Citytours Tours
                                        </td>
                                        <td style="width:35%">
                                            <label class="switch-light switch-ios pull-right">
                                                <input type="checkbox" name="option_1" id="option_1" checked value="">
                                                <span>
													<span>No</span>
													<span>Yes</span>
													</span>
                                                <a></a>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="icon_set_1_icon-6"></i>
                                        </td>
                                        <td>
                                            New Citytours Hotels
                                        </td>
                                        <td>
                                            <label class="switch-light switch-ios pull-right">
                                                <input type="checkbox" name="option_2" id="option_2" value="">
                                                <span>
													<span>No</span>
													<span>Yes</span>
													</span>
                                                <a></a>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="icon_set_1_icon-26"></i>
                                        </td>
                                        <td>
                                            New Citytours Transfers
                                        </td>
                                        <td>
                                            <label class="switch-light switch-ios pull-right">
                                                <input type="checkbox" name="option_3" id="option_3" value="" checked>
                                                <span>
							<span>No</span>
													<span>Yes</span>
													</span>
                                                <a></a>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="icon_set_1_icon-81"></i>
                                        </td>
                                        <td>
                                            New Citytours special offers
                                        </td>
                                        <td>
                                            <label class="switch-light switch-ios pull-right">
                                                <input type="checkbox" name="option_4" id="option_4" value="">
                                                <span>
							<span>No</span>
													<span>Yes</span>
													</span>
                                                <a></a>
                                            </label>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn_1 green">Update notifications settings</button>
                            </div>
                        </div>
                        <!-- End row -->
                    </section>

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
                                            <span>{{ Auth::user()->birthday }}</span>
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
                                    <h4>Edit profile</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First name</label>
                                        <input class="form-control" name="first_name" id="first_name" type="text">
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last name</label>
                                        <input class="form-control" name="last_name" id="last_name" type="text">
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
                                        <label>Phone number</label>
                                        <input class="form-control" name="phone" type="text">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date of birth <small>(dd/mm/yyyy)</small>
                                        </label>
                                        <input class="form-control" name="birthday" type="date">
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
                                    <h4>Edit address</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Street address</label>
                                        <input class="form-control" name="address" type="text">
                                        @error('address')
                                             <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City/Town</label>
                                        <input class="form-control" name="city" type="text">
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
                                        <input class="form-control" name="zipcode" type="text">
                                        @error('zipcode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <select id="country" class="form-control" name="country">
                                            <option class="text-capitalize"
                                                    value="{{Auth::user()->country}}">{{Auth::user()->country}}</option>
                                            <option class="text-capitalize" value="korean">Korean</option>
                                            <option class="text-capitalize" value="japan">Japan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h4>Upload profile photo</h4>
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
                            <button type="submit" class="btn_1 green">Update Profile</button>
                        </form>
                    </section>
                    <!-- End section 4 -->

                </div>
                <!-- End content -->
            </div>
            <!-- End tabs -->
        </div>
        <!-- end container -->
    </main>
@endsection
