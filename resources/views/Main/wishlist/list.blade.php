@extends('layouts.main.app')

@section('title', 'Wishlist')

@section('extra-css')
    <link href="{{asset('libraries/main/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="libraries/main/img/home_bg_1.jpg"
             data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Danh sách yêu thích</h1>
            </div>
        </div>
    </section>
    <main style="margin-bottom: 355px;">
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">Trang chủ</a>
                    </li>

                    <li>Danh sách yêu thích</li>
                </ul>
            </div>
        </div>
        <!-- Position -->

{{--        {{dd(auth()->user()->wishlists)}}--}}

        <div class="container margin_60">
            <div class="row">
                <div class="col-lg-9">
                    @if(count(auth()->user()->wishlists) > 0)
                        @foreach(auth()->user()->wishlists->reverse() as $key => $tour)
                            <div class="strip_all_tour_list wow fadeIn" id="tour_{{$tour->id}}" data-wow-delay="0.1s"
                                 style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="wishlist_close">
                                            <a onclick="Main.removeTourInWishlist({{$tour->id}})" href="javascript:void(0);" class="tooltip_flip tooltip-effect-1">-<span class="tooltip-content-flip"><span class="tooltip-back">Xóa khỏi danh mục yêu thích</span></span></a>
                                        </div>
                                        <div class="img_list">
                                            <a href="#">
                                                <img src="{{$tour->thumbnail}}" alt="Image">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="tour_list_desc">
                                            <div class="rating"><i class="icon-smile voted"></i><i
                                                    class="icon-smile  voted"></i><i class="icon-smile  voted"></i><i
                                                    class="icon-smile  voted"></i><i class="icon-smile"></i><small>({{count($tour->reviews)}})</small>
                                            </div>
                                            <h3><strong>{{$tour->name}}</strong></h3>
                                            <p>{{$tour->description}}</p>
{{--                                            <ul class="add_info">--}}
{{--                                                <li>--}}
{{--                                                    <div class="tooltip_styled tooltip-effect-4">--}}
{{--                                                        <span class="tooltip-item"><i class="icon_set_1_icon-83"></i></span>--}}
{{--                                                        <div class="tooltip-content">--}}
{{--                                                            <h4>Schedule</h4>--}}
{{--                                                            <strong>Monday to Friday</strong> 09.00 AM - 5.30 PM--}}
{{--                                                            <br>--}}
{{--                                                            <strong>Saturday</strong> 09.00 AM - 5.30 PM--}}
{{--                                                            <br>--}}
{{--                                                            <strong>Sunday</strong> <span--}}
{{--                                                                class="label label-danger">Closed</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <div class="tooltip_styled tooltip-effect-4">--}}
{{--                                                        <span class="tooltip-item"><i class="icon_set_1_icon-41"></i></span>--}}
{{--                                                        <div class="tooltip-content">--}}
{{--                                                            <h4>Address</h4> Musée du Louvre, 75058 Paris - France--}}
{{--                                                            <br>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <div class="tooltip_styled tooltip-effect-4">--}}
{{--                                                        <span class="tooltip-item"><i class="icon_set_1_icon-97"></i></span>--}}
{{--                                                        <div class="tooltip-content">--}}
{{--                                                            <h4>Languages</h4> English - French - Chinese - Russian - Italian--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <div class="tooltip_styled tooltip-effect-4">--}}
{{--                                                        <span class="tooltip-item"><i class="icon_set_1_icon-27"></i></span>--}}
{{--                                                        <div class="tooltip-content">--}}
{{--                                                            <h4>Parking</h4> 1-3 Rue Elisée Reclus--}}
{{--                                                            <br> 76 Rue du Général Leclerc--}}
{{--                                                            <br> 8 Rue Caillaux 94923--}}
{{--                                                            <br>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <div class="tooltip_styled tooltip-effect-4">--}}
{{--                                                        <span class="tooltip-item"><i class="icon_set_1_icon-25"></i></span>--}}
{{--                                                        <div class="tooltip-content">--}}
{{--                                                            <h4>Transport</h4>--}}
{{--                                                            <strong>Metro: </strong>Musée du Louvre station (line 1)--}}
{{--                                                            <br>--}}
{{--                                                            <strong>Bus:</strong> 21, 24, 27, 39, 48, 68, 69, 72, 81, 95--}}
{{--                                                            <br>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="price_list">
                                            <div><span style="font-size: 20px">{{$tour->adult_price}}</span><span class="normal_price_list"></span><small>* trên 1 người</small>
                                                <p><a href="{{route('Main.tour.show', $tour->slug)}}" class="btn_1">Details</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End strip -->
                        @endforeach
                    @else
                        <h2>Mục yêu thích của bạn đang trống</h2>
                    @endif
                    <hr>


                </div>
                <!-- End col lg-9 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </main>
@endsection
