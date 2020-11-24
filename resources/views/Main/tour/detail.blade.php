@extends('layouts.main.app')

@section('title','Danh sách tour')

@section('extra-css')
    <style>
        div#single_tour_feat {
            overflow: hidden;
            overflow-x: scroll;
        }
        #single_tour_feat::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        #single_tour_feat::-webkit-scrollbar
        {
            height: 6px;
            background-color: #F5F5F5;
        }

        #single_tour_feat::-webkit-scrollbar-thumb
        {
            background-color: #e04f67;
        }
    </style>
@endsection

@section('extra-js')
    <script src="{{asset('Libraries/Main/js/jquery.sliderPro.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function ($) {
            $('#Img_carousel').sliderPro({
                width: 960,
                height: 500,
                fade: true,
                arrows: true,
                buttons: false,
                fullScreen: false,
                smallSize: 500,
                startSlide: 0,
                mediumSize: 1000,
                largeSize: 3000,
                thumbnailArrows: true,
                autoplay: false
            });
        });
    </script>

    <!-- Date and time pickers -->
    <script>
        $('input.date-pick').datepicker('setDate', 'today');
        $('input.time-pick').timepicker({
            minuteStep: 15,
            showInpunts: false
        })
    </script>


@endsection

@section('content')

    <section class="parallax-window" data-parallax="scroll" data-image-src="{{ $tour->banner }}" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1>{{$tour->name}}</h1>
                        <span>{{ $tour->address }}</span>
                        <div class="rating">
                            @for($i=1; $i<=5; $i++)
                                @if($i <= $tour->reviews->avg('star'))
                                    <i class="icon-smile voted"></i>
                                @else
                                    <i class="icon-smile"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="price_single_main">
                            <span>{{ $tour->getCurrentPrice() }}</span>
                            <i>/người </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End section -->
    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li>
                        <a href="#">Trang chủ</a>
                    </li>
                    <li>
                        <a href="#">{{ $tour->category->name }}</a>
                    </li>
                    <li>{{ $tour->name }}</li>
                </ul>
            </div>
        </div>
        <!-- End Position -->


        <div class="container margin_60">
            <div class="row">
                <div class="col-lg-8" id="single_tour_desc">
{{--                    <div id="single_tour_feat">--}}
{{--                        <ul>--}}
{{--                            @foreach($tour->facilities as $facility)--}}
{{--                                <li>--}}
{{--                                    <i class="{{ $facility->icon }}"></i>--}}
{{--                                    {{ $facility->name }}--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}

                    <div id="Img_carousel" class="slider-pro">
                        <div class="sp-slides">
                            @foreach($tour->album as $image)
                            <div class="sp-slide">
                                <img alt="Image" class="sp-image" src="{{asset('Libraries/Main/css/images/blank.gif')}}" data-src="{{ $image->image }}" data-small="{{ $image->image }}" data-medium="{{ $image->image }}" data-large="{{ $image->image }}" data-retina="{{ $image->image }}">
                            </div>
                            @endforeach
                        </div>
                        <div class="sp-thumbnails">
                            @foreach($tour->album as $thumbnail)
                                <img alt="Image" class="sp-thumbnail" src="{{ $thumbnail->image }}">
                            @endforeach
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-3">
                            <h3>Mô tả</h3>
                        </div>
                        <div class="col-lg-9">
                            {{ $tour->description }}
                            <!-- End row  -->
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3">
                            <h3>Lịch trình</h3>
                        </div>
                        <div class="col-lg-9">
                           @if(count($tour->schedules) > 1)
                                @foreach($tour->schedules as $key => $schedule)
                                    <div class="row">
                                        <h4><strong>Ngày {{ $key + 1 }}</strong></h4>
                                        {{ $schedule->description }}
                                    </div>
                                    <hr/>
                                @endforeach
                            @else
                            <div class="row">
                                <h4><strong>Đi trong ngày</strong></h4>
                                {{ $tour->schedules->first()->description }}
                            </div>
                           @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3">
                            <h3>Reviews </h3>
                            <a href="#" class="btn_1 add_bottom_30" data-toggle="modal" data-target="#myReview">Leave a review</a>
                        </div>
                        <div class="col-lg-9">
                            <div id="general_rating">{{ $tour->reviews->count() }} Reviews
                                <div class="rating">
                                    @for($i=1; $i<=5; $i++)
                                        @if($i <= $tour->reviews->avg('star'))
                                            <i class="icon-smile voted"></i>
                                        @else
                                            <i class="icon-smile"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <!-- End general_rating -->
                            <hr>
                            @foreach($tour->reviews as $review)
                                <div class="review_strip_single">
                                    <img src="{{ $review->user->avatar }}" alt="Image" class="rounded-circle">
                                    <small> {{ $review->created_at }}</small>
                                    <h4>{{ $review->user->last_name }}</h4>
                                    <p>
                                        "{{ $review->content }}"
                                    </p>
                                    <div class="rating">
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $review->star)
                                                <i class="icon-smile voted"></i>
                                            @else
                                                <i class="icon-smile"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <!-- End review strip -->
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--End  single_tour_desc-->

                <aside class="col-lg-4">
                    <div class="box_style_1 expose">
                        <h3 class="inner">- Booking -</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <span>Khởi hành : </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="form-control">
                                        <option value="0">01/11/2020</option>
                                        <option value="0">03/11/2020</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <span>Nơi khởi hành : </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <b>Hà Nội</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <span>Số chỗ còn nhận : </span>
                            </div>
                            <div class="col-sm-6">
                                <b>5 </b>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Người lớn</label>
                                    <div class="numbers-row">
                                        <input type="text" value="1" id="adults" class="qty2 form-control" name="quantity">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Trẻ em</label>
                                    <div class="numbers-row">
                                        <input type="text" value="0" id="children" class="qty2 form-control" name="quantity">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table class="table table_summary">
                            <tbody>
                            <tr>
                                <td>
                                    Người lớn
                                </td>
                                <td class="text-right">
                                    2
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Trẻ em
                                </td>
                                <td class="text-right">
                                    0
                                </td>
                            </tr>
                            <tr class="total">
                                <td>
                                    Tổng tiền
                                </td>
                                <td class="text-right">
                                    999.999.999 đ
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <a class="btn_full" href="cart.html">Đặt ngay</a>
                        <a class="btn_full_outline" href="#"><i class=" icon-heart"></i> Yêu thích</a>
                    </div>
                    <!--/box_style_1 -->

{{--                    <div class="box_style_4">--}}
{{--                        <a href="tel://004542344599" class="phone">--}}
{{--                            <i class="icon_set_1_icon-90"></i>--}}
{{--                            <h4>Liên hệ trực tiếp</h4>--}}
{{--                            +45 423 445 99--}}
{{--                        </a>--}}
{{--                    </div>--}}

                </aside>
            </div>
            <!--End row -->
        </div>
        <!--End container -->

        <div id="overlay"></div>
        <!-- Mask on input focus -->
    </main>

    <div id="toTop"></div><!-- Back to top button -->

    <!-- Search Menu -->
    <div class="search-overlay-menu">
        <span class="search-overlay-close"><i class="icon_set_1_icon-77"></i></span>
        <form role="search" id="searchform" method="get">
            <input value="" name="q" type="search" placeholder="Search..." />
            <button type="submit"><i class="icon_set_1_icon-78"></i>
            </button>
        </form>
    </div><!-- End Search Menu -->

    <!-- Sign In Popup -->
    <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
        <div class="small-dialog-header">
            <h3>Sign In</h3>
        </div>
        <form>
            <div class="sign-in-wrapper">
                <a href="#0" class="social_bt facebook">Login with Facebook</a>
                <a href="#0" class="social_bt google">Login with Google</a>
                <div class="divider"><span>Or</span></div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                    <i class="icon_mail_alt"></i>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" id="password" value="">
                    <i class="icon_lock_alt"></i>
                </div>
                <div class="clearfix add_bottom_15">
                    <div class="checkboxes float-left">
                        <input id="remember-me" type="checkbox" name="check">
                        <label for="remember-me">Remember Me</label>
                    </div>
                    <div class="float-right"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
                </div>
                <div class="text-center"><input type="submit" value="Log In" class="btn_login"></div>
                <div class="text-center">
                    Don’t have an account? <a href="javascript:void(0);">Sign up</a>
                </div>
                <div id="forgot_pw">
                    <div class="form-group">
                        <label>Please confirm login email below</label>
                        <input type="email" class="form-control" name="email_forgot" id="email_forgot">
                        <i class="icon_mail_alt"></i>
                    </div>
                    <p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
                    <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
                </div>
            </div>
        </form>
        <!--form -->
    </div>
    <!-- /Sign In Popup -->

    <!-- Modal Review -->
    <div class="modal fade" id="myReview" tabindex="-1" role="dialog" aria-labelledby="myReviewLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myReviewLabel">Write your review</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div id="message-review">
                    </div>
                    <form method="post" action="assets/review_tour.php" name="review_tour" id="review_tour">
                        <input name="tour_name" id="tour_name" type="hidden" value="Paris Arch de Triomphe Tour">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="name_review" id="name_review" type="text" placeholder="Your name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="lastname_review" id="lastname_review" type="text" placeholder="Your last name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- End row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="email_review" id="email_review" type="email" placeholder="Your email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- End row -->
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Position</label>
                                    <select class="form-control" name="position_review" id="position_review">
                                        <option value="">Please review</option>
                                        <option value="Low">Low</option>
                                        <option value="Sufficient">Sufficient</option>
                                        <option value="Good">Good</option>
                                        <option value="Excellent">Excellent</option>
                                        <option value="Superb">Super</option>
                                        <option value="Not rated">I don't know</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tourist guide</label>
                                    <select class="form-control" name="guide_review" id="guide_review">
                                        <option value="">Please review</option>
                                        <option value="Low">Low</option>
                                        <option value="Sufficient">Sufficient</option>
                                        <option value="Good">Good</option>
                                        <option value="Excellent">Excellent</option>
                                        <option value="Superb">Super</option>
                                        <option value="Not rated">I don't know</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <select class="form-control" name="price_review" id="price_review">
                                        <option value="">Please review</option>
                                        <option value="Low">Low</option>
                                        <option value="Sufficient">Sufficient</option>
                                        <option value="Good">Good</option>
                                        <option value="Excellent">Excellent</option>
                                        <option value="Superb">Super</option>
                                        <option value="Not rated">I don't know</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quality</label>
                                    <select class="form-control" name="quality_review" id="quality_review">
                                        <option value="">Please review</option>
                                        <option value="Low">Low</option>
                                        <option value="Sufficient">Sufficient</option>
                                        <option value="Good">Good</option>
                                        <option value="Excellent">Excellent</option>
                                        <option value="Superb">Super</option>
                                        <option value="Not rated">I don't know</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End row -->
                        <div class="form-group">
                            <textarea name="review_text" id="review_text" class="form-control" style="height:100px" placeholder="Write your review"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" id="verify_review" class=" form-control" placeholder="Are you human? 3 + 1 =">
                        </div>
                        <input type="submit" value="Submit" class="btn_1" id="submit-review">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal review -->
@endsection
