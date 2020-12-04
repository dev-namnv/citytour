@extends('layouts.main.app')

@section('title', 'Welcome')

@section('content')
    <main>
        <div id="search_container_2">
            <div id="search_2">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tours">
                        <form>
                            <div class="row no-gutters custom-search-input-2">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Where..." id="autocomplete">
                                        <i class="icon_pin_alt"></i>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input class="form-control date-pick" type="text" name="dates" placeholder="When..">
                                        <i class="icon_calendar"></i>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <input type="submit" class="btn_search" value="Search">
                                </div>
                            </div>
                            <!-- /row -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End search_container -->
        <div class="container margin_60">

            <div class="main_title">
                <h2>Paris <span>Top</span> Tours</h2>
                <p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
            </div>

            <div class="row">
            @foreach($main as $item)
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                    <div class="tour_container">
                        <div class="img_container">
                            <a href="{{route('Main.tour.show',['slug'=> $item->slug])}}">
                                <img src="{{$item->thumbnail}}" width="800" height="533" class="img-fluid" alt="Image">
                                <div class="short_info">
                                    <i class="icon_set_1_icon-44"></i>{{$item->category->name}}<span class="price">{{$item->adult_price}}</span>
                                </div>
                            </a>
                        </div>
                        <div class="tour_title">
                            <h3><strong>{{$item['name']}}</strong> tour</h3>
                            <div class="rating">
                                <small>(75)</small>
                            </div><!-- end rating -->
                            <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                            </div><!-- End wish list-->
                        </div>
                    </div><!-- End box tour -->
                </div><!-- End col -->
            @endforeach
            </div><!-- End row -->

            <p class="text-center nopadding">
                <a href="{{route('Main.tour.index')}}" class="btn_1 medium"><i class="icon-eye-7"></i>Toàn bộ tours ({{$tour1}}) </a>
            </p>
        </div><!-- End container -->

        <div class="white_bg">
            <div class="container margin_60">
                <!-- End row -->

                <div class="banner colored">
                    <h3 style="font-size: 28px; color: white">Bạn sẽ đi đâu nếu chỉ có 1.000.000VNĐ</h3>
                    <p>
                        Sẽ có rất nhiều hình thức du lịch siêu tiết kiệm, cũng như rất là an toàn và đem lại trải nghiệm khó quên
                    </p>
                    <a href="single_tour.html" class="btn_1 white">Read more</a>
                </div>

                <div class="row">
                    @foreach($tour as $item)
                    <div class="col-lg-3 col-md-6 wow zoomIn" data-wow-delay="0.2s">
                        <div class="tour_container">
                            <div class="img_container">
                                <a href="{{route('Main.tour.show',['slug'=> $item->slug])}}">
                                    <img src="{{$item->thumbnail}}" width="800" height="533" class="img-fluid" alt="Image">
                                    <div class="short_info">
                                        <i class="{{$item->category->icon}}"></i>{{$item->category->name}}<span class="price">{{$item->adult_price}}</span>
                                    </div>
                                </a>
                            </div>
                            <div class="tour_title">
                                <h3><strong>{{$item->name}}</strong> tour</h3>
                                <div class="wishlist">
                                    <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                                </div><!-- End wish list-->
                            </div>
                        </div><!-- End box tour -->
                    </div><!-- End col -->
                    @endforeach
                </div>
                <!-- End row -->

            </div>
            <!-- End container -->
        </div>

        <div class="container margin_60">

            <div class="main_title">
                <h2>CITY TOURS CÓ GÌ?</h2>
            </div>

            <div class="row">

                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.2s">
                    <div class="feature_home">
                        <i class="icon_set_1_icon-41"></i>
                        <h3><span>+120</span> Tours</h3>
                        <p>
                            Chúng tôi luôn có những tours 'xịn xò' nhất dành cho khách hàng.
                        </p>
                        <a href="about.html" class="btn_1 outline">Read more</a>
                    </div>
                </div>

                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.4s">
                    <div class="feature_home">
                        <i class="icon_set_1_icon-30"></i>
                        <h3><span>+1000</span> Khách hàng</h3>
                        <p>
                            Khách hàng khi đến với City Tours, đều ra về với những khuôn mặt tười cười cùng với tâm trạng thoải mái.
                        </p>
                        <a href="about.html" class="btn_1 outline">Read more</a>
                    </div>
                </div>

                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="feature_home">
                        <i class="icon_set_1_icon-57"></i>
                        <h3><span>24/7 </span> Hỗ trợ</h3>
                        <p>
                            City Tours luôn mong muốn có thể hỗ trợ khách hàng nhanh, kịp thời.
                        </p>
                        <a href="about.html" class="btn_1 outline">Read more</a>
                    </div>
                </div>

            </div>
            <!--End row -->

            <hr>
        </div>
        <!-- End container -->
    </main>
@endsection
