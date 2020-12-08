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
    <section class="parallax-window" data-parallax="scroll" data-image-src="{{asset('Libraries/Main/img/slides_bg/banner-tours.png')}}" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Tours Du lịch</h1>
                <p>Bạn chỉ việc đặt lịch. Mọi thứ để chúng tôi lo.</p>
            </div>
        </div>
    </section>
    <!-- End section -->

    <main>

        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">Trang chủ</a>
                    </li>
                    <li><a href="#">Tours</a>
                    </li>
                    <li>Tất cả</li>
                </ul>
            </div>
        </div>
        <!-- Position -->

        <div class="container margin_60">

            <div class="row">
                <aside class="col-lg-3">

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
                        <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt"><i class="icon_set_1_icon-65"></i>Lọc</a>
                        <div class="collapse show" id="collapseFilters">
                            <div class="filter_type">
                                <h6>Giá</h6>
                                <input type="text" id="range" name="range" value="">
                            </div>
                            <div class="filter_type">
                                <h6>Đánh giá</h6>
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
                                <h6>Khởi hành</h6>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                                    </div>
                                </div>
                            </div>
                            <div class="filter_type text-center">
                                <button class="btn btn-field col-12 bold">Cập nhật</button>
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

                    @for($i=0; $i<count($tours);$i++)
                        <div class="row">
                            <div class="col-md-6 wow zoomIn" data-wow-delay="0.{!! $i !!}s">
                                <div class="tour_container">
                                    <div class="img_container">
                                        <a href="{{route('Main.tour.show',['slug'=> $tours[$i]->slug])}}">
                                            <img src="{!! $tours[$i]->thumbnail !!}" width="800" height="533" class="img-fluid" alt="Image">
                                            <div class="short_info">
                                                <i class="{!! $tours[$i]->category->icon !!}"></i>
                                                {!! $tours[$i]->category->name !!}
                                                <span class="price small" style="color: #ff8989">{!! $tours[$i]->getCurrentPrice() !!}</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="tour_title">
                                        <h3><strong>{{ $tours[$i]->name }}</strong></h3>
                                        <div class="add_info">
                                            <div class="tooltip-item">
                                                Tour <span>
                                                    {{ $tours[$i]->schedules->count() == 1 ? 'trong' : $tours[$i]->schedules->count() }}
                                                </span> ngày
                                            </div>
                                        </div>
                                        <ul class="add_info">
                                            <li>
                                                <div class="tooltip_styled tooltip-effect-4">
                                                    Khởi hành:
                                                </div>
                                            </li>
                                            @foreach($tours[$i]->batches as $batch)
                                                <li>
                                                    <div class="tooltip_styled tooltip-effect-4">
                                                        <span class="tooltip-item">
                                                            {{ $batch->batch }}
                                                        </span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        @if($tours[$i]->reviews->count() != 0 )
                                            <div class="small mt-3 ">
                                                Điểm: {{ round($tours[$i]->reviews->avg('star'),1) }}
                                            </div>
                                        @endif
                                        <!-- end rating -->
                                        <div class="wishlist">
                                            <a onclick="Main.addToWishlist({{$tours[$i]->id}})" class="tooltip_flip tooltip-effect-1" href="javascript:;">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                                        </div>

                                        <!-- End wish list-->
                                    </div>
                                </div>
                                <!-- End box tour -->
                            </div>
                            <!-- End col-md-6 -->

                            <div class="col-md-6 wow zoomIn" data-wow-delay="0.{!! $i++ !!}s">
                                <div class="tour_container">
                                    <div class="img_container">
                                        <a href="{{route('Main.tour.show',['slug'=> $tours[$i]->slug])}}">
                                            <img src="{!! $tours[$i]->thumbnail !!}" width="800" height="533" class="img-fluid" alt="Image">
                                            <div class="short_info">
                                                <i class="{!! $tours[$i]->category->icon !!}"></i>
                                                {!! $tours[$i]->category->name !!}
                                                <span class="price small" style="color: #ff8989">{!! $tours[$i]->getCurrentPrice() !!}</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="tour_title">
                                        <h3><strong>{{ $tours[$i]->name }}</strong></h3>
                                        <div class="add_info">
                                            <div class="tooltip-item">
                                                Tour <span>
                                                    {{ $tours[$i]->schedules->count() == 1 ? 'trong' : $tours[$i]->schedules->count() }}
                                                </span> ngày
                                            </div>
                                        </div>
                                        <ul class="add_info">
                                            <li>
                                                <div class="tooltip_styled tooltip-effect-4">
                                                    Khởi hành:
                                                </div>
                                            </li>
                                            @foreach($tours[$i]->batches as $batch)
                                                <li>
                                                    <div class="tooltip_styled tooltip-effect-4">
                                                        <span class="tooltip-item">
                                                            {{ $batch->batch }}
                                                        </span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        @if($tours[$i]->reviews->count() != 0 )
                                            <div class="small mt-3 ">
                                                Điểm: {{ round($tours[$i]->reviews->avg('star'),1) }}
                                            </div>
                                        @endif
                                        <!-- end rating -->
                                        <div class="wishlist">
                                            <a onclick="Main.addToWishlist({{$tours[$i]->id}})" class="tooltip_flip tooltip-effect-1" href="javascript:;">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                                        </div>
                                        <!-- End wish list-->
                                    </div>
                                </div>
                                <!-- End box tour -->
                            </div>
                            <!-- End col-md-6 -->
                        </div>
                        <!-- End row -->
                    @endfor

                    <hr>

                    {!! $tours->links() !!}
                    <!-- end pagination-->

                </div>
                <!-- End col lg 9 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </main>
    <!-- End main -->
@endsection
