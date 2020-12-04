@extends('layouts.main.app')

@section('title','Danh sách tour')

@section('extra-js')
    <!-- Cat nav mobile -->
    <script src="{{asset('Libraries/Main/js/cat_nav_mobile.js')}}"></script>
    <script>
        $('#cat_nav').mobileMenu();
    </script>

    <!-- Check box and radio style iCheck -->
    <script>
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-grey',
            radioClass: 'iradio_square-grey'
        });
    </script>
@endsection

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="{{asset('Libraries/Main/img/home_bg_1.jpg')}}" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Paris tours</h1>
                <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>
            </div>
        </div>
    </section>
    <!-- End section -->

    <main>

        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">Home</a>
                    </li>
                    <li><a href="#">Tours</a>
                    </li>
                    <li>All</li>
                </ul>
            </div>
        </div>
        <!-- Position -->

        <div class="collapse" id="collapseMap">
            <div id="map" class="map"></div>
        </div>
        <!-- End Map -->


        <div class="container margin_60">

            <div class="row">
                <aside class="col-lg-3">
                    <p>
                        <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
                    </p>

                    <div class="box_style_cat">
                        <ul id="cat_nav">
                            <li>
                                <a href="{!! route('Main.tour.index') !!}" id="active"><i class="icon_set_1_icon-51"></i>All tours <span>(141)</span></a>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <a href="#"><i class="{!! $category->icon !!}"></i>{!! $category->name !!}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div id="filters_col">
                        <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt"><i class="icon_set_1_icon-65"></i>Filters</a>
                        <div class="collapse show" id="collapseFilters">
                            <div class="filter_type">
                                <h6>Price</h6>
                                <input type="text" id="range" name="range" value="">
                            </div>
                            <div class="filter_type">
                                <h6>Rating</h6>
                                <ul>
                                    <li>
                                        <label>
                                            <input type="checkbox"><span class="rating">
											<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i>
											</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox"><span class="rating">
											<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i>
											</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox"><span class="rating">
											<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i>
											</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox"><span class="rating">
											<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i>
											</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox"><span class="rating">
											<i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i>
											</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="filter_type">
                                <h6>Facility</h6>
                                <ul>
                                    <li>
                                        <label>
                                            <input type="checkbox">Pet allowed
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">Groups allowed
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">Tour guides
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox">Access for disabled
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--End collapse -->
                    </div>
                    <!--End filters col-->
                    <div class="box_style_2">
                        <i class="icon_set_1_icon-57"></i>
                        <h4>Need <span>Help?</span></h4>
                        <a href="tel://{!! __('info.hotline') !!}" class="phone">{!! __('info.hotline') !!}</a>
                        <small>{!! __('info.opening') !!}</small>
                    </div>
                </aside>
                <!--End aside -->
                <div class="col-lg-9">

                    <div id="tools">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-6">
                                <div class="styled-select-filters">
                                    <select name="sort_price" id="sort_price">
                                        <option value="" selected>Sort by price</option>
                                        <option value="lower">Lowest price</option>
                                        <option value="higher">Highest price</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-6">
                                <div class="styled-select-filters">
                                    <select name="sort_rating" id="sort_rating">
                                        <option value="" selected>Sort by ranking</option>
                                        <option value="lower">Lowest ranking</option>
                                        <option value="higher">Highest ranking</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-4 d-none d-sm-block text-right">
                                <a href="{!! route('Main.tour.index',['param'=>'list-grid']) !!}" class="bt_filters"><i class="icon-th"></i></a>
                                <a href="{!! route('Main.tour.index',['param'=>'list']) !!}" class="bt_filters"><i class=" icon-list"></i></a>
                            </div>

                        </div>
                    </div>
                    <!--/tools -->

                    @foreach($tours as $index => $tour)
                        <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.{!! ++$index !!}s">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="ribbon_3 popular"><span>{!! __('POPULAR') !!}</span>
                                    </div>
                                    <div class="wishlist">
                                        <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">{!! __('Add to wishlist') !!}</span></span></a>
                                    </div>
                                    <div class="img_list">
                                        <a href="{{route('Main.tour.show',['slug'=> $tour->slug])}}"><img src="{!! $tour->thumbnail !!}" alt="Image">
                                            <div class="short_info"><i class="{!! $tour->category->icon !!}"></i>{!! $tour->category->name !!} </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="tour_list_desc">
                                        <div class="rating">
                                            <i class="icon-smile voted"></i>
                                            <i class="icon-smile  voted"></i>
                                            <i class="icon-smile  voted"></i>
                                            <i class="icon-smile  voted"></i>
                                            <i class="icon-smile"></i>
                                            <small>(75)</small>
                                        </div>
                                        <h3><strong>{!! $tour->name !!}</strong> tour</h3>
                                        <p>{!! substr($tour->description,0,125).'....' !!}</p>
                                        <ul class="add_info">
                                            <li>
                                                <div class="tooltip_styled tooltip-effect-4">
                                                    <span class="tooltip-item"><i class="icon_set_1_icon-83"></i></span>
                                                    <div class="tooltip-content">
                                                        <h4>Schedule</h4>
                                                    </div>
                                                </div>
                                            </li>
                                            @foreach($tour->services as $serveice)
                                                <li>
                                                    <div class="tooltip_styled tooltip-effect-4">
                                                        <span class="tooltip-item"><i class="{!! $serveice->icon !!}"></i></span>
                                                        <div class="tooltip-content">
                                                            <h4>{!! $serveice->name !!}</h4> {!! $serveice->description !!}
                                                            <br>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="price_list">
                                        <div class="price small">
                                            {!! $tour->getCurrentPrice() !!}
                                            <small>*Per person</small>
                                            <p>
                                                <a href="{{route('Main.tour.show',['slug'=> $tour->slug])}}" class="btn_1">Details</a>
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End strip -->
                    @endforeach

                    <hr>
                    {!! $tours->links() !!}
                    <!-- end pagination-->

                </div>
                <!-- End col lg-9 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </main>
@endsection
