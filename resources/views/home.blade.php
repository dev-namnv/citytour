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
                        <div class="ribbon_3 popular"><span>Popular</span></div>
                        <div class="img_container">
                            <a href="single_tour.html">
                                <img src="{{$item['thumbnail']}}" width="800" height="533" class="img-fluid" alt="Image">
                                <div class="short_info">
                                    <span class="price">{{$item['adult_price']['formatted']}}</span>
                                </div>
                            </a>
                        </div>
                        <div class="tour_title">
                            <h3><strong>{{$item['name']}}</strong> tour</h3>
                            <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                            </div><!-- End wish list-->
                        </div>
                    </div><!-- End box tour -->
                </div><!-- End col -->
            @endforeach
            </div><!-- End row -->

            <p class="text-center nopadding">
                <a href="#" class="btn_1 medium"><i class="icon-eye-7"></i>View all tours (144) </a>
            </p>
        </div><!-- End container -->

        <div class="white_bg">
            <div class="container margin_60">
                <!-- End row -->

                <div class="banner colored">
                    <h4>Discover our Top tours <span>from $34</span></h4>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in.
                    </p>
                    <a href="single_tour.html" class="btn_1 white">Read more</a>
                </div>

                <div class="row">
                    @foreach($tour as $item)
                    <div class="col-lg-3 col-md-6 wow zoomIn" data-wow-delay="0.2s">
                        <div class="tour_container">
                            <div class="ribbon_3 popular"><span>Popular</span></div>
                            <div class="img_container">
                                <a href="single_tour.html">
                                    <img src="{{$item['thumbnail']}}" width="800" height="533" class="img-fluid" alt="Image">
                                    <div class="badge_save">Save<strong>30%</strong></div>
                                    <div class="short_info">
                                        <span class="price">{{$item['adult_price']['formatted']}}</span>
                                    </div>
                                </a>
                            </div>
                            <div class="tour_title">
                                <h3><strong>{{$item['name']}}</strong> tour</h3>
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
                <h2>Some <span>good</span> reasons</h2>
                <p>
                    Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.
                </p>
            </div>

            <div class="row">

                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.2s">
                    <div class="feature_home">
                        <i class="icon_set_1_icon-41"></i>
                        <h3><span>+120</span> Premium tours</h3>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
                        </p>
                        <a href="about.html" class="btn_1 outline">Read more</a>
                    </div>
                </div>

                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.4s">
                    <div class="feature_home">
                        <i class="icon_set_1_icon-30"></i>
                        <h3><span>+1000</span> Customers</h3>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
                        </p>
                        <a href="about.html" class="btn_1 outline">Read more</a>
                    </div>
                </div>

                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="feature_home">
                        <i class="icon_set_1_icon-57"></i>
                        <h3><span>H24 </span> Support</h3>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
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
