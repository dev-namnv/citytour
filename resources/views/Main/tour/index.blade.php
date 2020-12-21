@extends('layouts.main.app')

@section('title','Danh sách tour')

@section('extra-js')
    <script src="{{asset('Libraries/Main/js/cat_nav_mobile.js')}}"></script>
    <script>
        $('#cat_nav').mobileMenu();
    </script>
    <script>
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-grey',
            radioClass: 'iradio_square-grey'
        });
    </script>
    <script>
        $('.js-select-sort').change(function () {
            $('#js-form-sort').submit()
        })
        $("#js-range-tour").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 0,
            max: 15000000,
            from: {{ request()->has('range') ? explode(';', request()->get('range'))[0] : 500000 }},
            to: {{ request()->has('range') ? explode(';', request()->get('range'))[1] : 4000000 }},
            type: 'double',
            step: 1,
            prefix: "₫",
            grid: true
        });
    </script>
@endsection

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="{{ 'https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1200,h_630,f_auto/w_80,x_15,y_15,g_south_west,l_klook_water/activities/hsnmkdasrhwmvng1yrht/V%C3%A9%20C%C3%B4ng%20Vi%C3%AAn%20Su%E1%BB%91i%20Kho%C3%A1ng%20N%C3%B3ng%20N%C3%BAi%20Th%E1%BA%A7n%20T%C3%A0i%20%C4%90%C3%A0%20N%E1%BA%B5ng.jpg' }}" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Tours Du lịch</h1>
                <p>Bạn chỉ việc đặt lịch. Mọi thứ để chúng tôi lo.</p>
            </div>
        </div>
    </section>

    <main>

        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">Trang chủ</a>
                    </li>
                    <li><a href="#">Tours</a>
                    </li>
                    <li>{{ $category ? $category->name : 'Tất cả' }}</li>
                </ul>
            </div>
        </div>

        <div class="container margin_60">
            <div class="row">
                <aside class="col-lg-3">
                    <div class="box_style_cat">
                        <ul id="cat_nav">
                            <li>
                                <a href="{!! route('Main.tour.index') !!}" id="active"><i class="icon_set_1_icon-51"></i>Tất cả Tour <span>({{ \App\Helpers\TourHelper::count() }})</span></a>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('Main.tour.index', ['category' => $category->slug, \App\Helpers\TourHelper::searchParams(request(), ['category'])]) }}"><i class="{!! $category->icon !!}"></i>{!! $category->name !!}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div id="filters_col">
                        <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt"><i class="icon_set_1_icon-65"></i>Lọc</a>
                        <form action="{{ route('Main.tour.index', [\App\Helpers\TourHelper::searchParams(request(), ['price', 'when'])]) }}" class="collapse show" id="collapseFilters">
                            <div class="filter_type">
                                <h6>Giá</h6>
                                <input type="text" id="js-range-tour" name="range" value="">
                            </div>
                            <div class="filter_type">
                                <h6>Khởi hành</h6>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control" name="when" type="date" value="{{ request()->when ?? '' }}" id="example-date-input">
                                    </div>
                                </div>
                            </div>
                            <div class="filter_type text-center">
                                <a class="btn btn-dark col-5 bold" href="{{ route('Main.tour.index') }}">Bỏ bộ lọc</a>
                                <button type="submit" class="btn btn-primary col-5 bold">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                    <div class="box_style_2">
                        <i class="icon_set_1_icon-57"></i>
                        <h4>Cần <span>Giúp đỡ?</span></h4>
                        <a href="tel://{!! __('info.hotline') !!}" class="phone">{!! __('info.hotline') !!}</a>
                        <small>{!! __('info.opening') !!}</small>
                    </div>
                </aside>
                <div class="col-lg-9">

                    <div id="tools">
                        <form class="row" id="js-form-sort" method="get" action="{{ route('Main.tour.index', [\App\Helpers\TourHelper::searchParams(request(), ['price', 'ranking'])]) }}">
                            <div class="col-md-3 col-sm-4 col-6">
                                <div class="styled-select-filters">
                                    <select class="js-select-sort" name="price" id="sort_price">
                                        <option value="">Sắp xếp theo giá</option>
                                        <option value="lower" @if(request()->get('price') == 'lower') selected @endif>Giá thấp</option>
                                        <option value="higher" @if(request()->get('price') == 'higher') selected @endif>Giá cao</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-6">
                                <div class="styled-select-filters">
                                    <select class="js-select-sort" name="ranking" id="sort_rating">
                                        <option value="">Sắp xếp theo xếp hạng</option>
                                        <option value="lower" @if(request()->get('ranking') == 'lower') selected @endif>Xếp hạng thấp</option>
                                        <option value="higher" @if(request()->get('ranking') == 'higher') selected @endif>Xếp hạng cao</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-4 d-none d-sm-block text-right">
                                <a href="{{ route('Main.tour.index',['view'=>'list-grid', \App\Helpers\TourHelper::searchParams(request(), ['view'])]) }}" class="bt_filters"><i class="icon-th"></i></a>
                                <a href="{{ route('Main.tour.index',['view'=>'list', \App\Helpers\TourHelper::searchParams(request(), ['view'])]) }}" class="bt_filters"><i class=" icon-list"></i></a>
                            </div>
                            @php($params = request()->only(['keyword', 'where', 'when', 'range', 'category', 'page', 'view']))
                            @foreach($params as $key => $param)
                                <input type="hidden" name="{{ $key }}" value="{{ $param }}">
                            @endforeach
                        </form>
                    </div>

                    @yield('tour-list')

                    <hr>
                    {!! $tours->appends(request()->except('page'))->links() !!}

                </div>
            </div>
        </div>
    </main>
@endsection
