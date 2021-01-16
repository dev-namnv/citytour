@extends('layouts.main.app')

@section('title', 'Welcome')

@section('extra-js')
    <script>
        $('#example-date-input').datepicker({
            format: 'dd-mm-yyyy',
            setDate: true,
            today: true,
            showInput: true
        });
    </script>
@endsection

@section('content')
    <main>
        <div id="search_container_2">
            <div id="search_2">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tours">
                        <form action="{{ route('Main.tour.index') }}" method="get">
                            <div class="row no-gutters custom-search-input-2">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control" name="where" type="text" placeholder="Địa điểm..." id="autocomplete" autocomplete="off">
                                        <i class="icon_pin_alt"></i>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input class="form-control date-pick" id="example-date-input" type="text" name="when" placeholder="Ngày.." autocomplete="off">
                                        <i class="icon_calendar"></i>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <input type="submit" class="btn_search" value="Tìm kiếm">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container margin_60">

            <div class="main_title">
                <h2><span>Tour</span> Mới</h2>
                <p>Top những chuyến du lịch tuyệt vời nhất dành cho bạn</p>
            </div>

            <div class="row">
                @php($key = 0)
                @foreach($tours as $tour)
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.{{ ++$key }}s">
                    <div class="tour_container">
                        @if($tour->top > TOUR_POPULAR)
                            <div class="ribbon_3 popular"><span>Phổ biến</span></div>
                        @elseif($tour->rating >= TOUR_RATING)
                            <div class="ribbon_3 rating"><span>Yêu thích</span></div>
                        @endif
                        <div class="img_container">
                            <a href="{{ route('Main.tour.show', ['slug' => $tour->slug]) }}">
                                <img src="{{ $tour->thumbnail }}" width="800" height="219px" class="img-fluid" alt="Image">
                                <div class="short_info">
                                    <i class="icon_set_1_icon-44"></i>{{ $tour->category->name }}<span class="price">{{ $tour->getCurrentPrice() }}</span>
                                </div>
                            </a>
                        </div>
                        <div class="tour_title">
                            <h3><strong>{{ \Illuminate\Support\Str::limit($tour->name, 20) }}</strong></h3>
                            <div class="rating">
                                {{ \App\Helpers\ReviewHelper::rating($tour->reviews) }}<small>({{ $tour->reviews->count() }})</small>
                            </div>
                            <div class="wishlist">
                                <a @if(!auth()->guest()) onclick="Main.addToWishlist({{$tour->id}})" @else onclick="Toastr.show({'status': 'error', 'content': 'Bạn cần phải đăng nhập'})" @endif class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <p class="text-center nopadding">
                <a href="#" class="btn_1 medium"><i class="icon-eye-7"></i>Xem tất cả tour ({{ \App\Helpers\TourHelper::count() }}) </a>
            </p>
        </div>

        <div class="white_bg">
            <div class="container margin_60">
                <div class="main_title">
                    <h2>Danh mục <span>Nổi bật</span></h2>
                    <p>Các danh mục Tour được gợi ý dành cho bạn</p>
                </div>
                <div class="row add_bottom_45">
                    <div class="col-lg-4 other_tours">
                        <ul>
                            @foreach($categories[0] as $category)
                                <li>
                                    <a href="{{ route('Main.tour.index', ['category' => $category->slug]) }}">
                                        <i class="{{ $category->icon }}"></i>
                                            {{ $category->name }}
                                        <span class="other_tours_price">{{ \App\Helpers\TourHelper::countOfCategory($category->id) }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-4 other_tours">
                        <ul>
                            @foreach($categories[1] as $category)
                                <li>
                                    <a href="{{ route('Main.tour.index', ['category' => $category->slug]) }}">
                                        <i class="{{ $category->icon }}"></i>
                                        {{ $category->name }}
                                        <span class="other_tours_price">{{ \App\Helpers\TourHelper::countOfCategory($category->id) }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-4 other_tours">
                        <ul>
                            @foreach($categories[2] as $category)
                                <li>
                                    <a href="{{ route('Main.tour.index', ['category' => $category->slug]) }}">
                                        <i class="{{ $category->icon }}"></i>
                                        {{ $category->name }}
                                        <span class="other_tours_price">{{ \App\Helpers\TourHelper::countOfCategory($category->id) }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                @isset($tour_min)
                    <div class="banner colored">
                        <h4>Đặt Tour ngay <span>chỉ với {{ $tour_min->adult_price }}</span></h4>
                        <a href="{{ route('Main.tour.show', ['slug' => $tour_min->slug]) }}" class="btn_1 white">Xem thêm</a>
                    </div>
                @endisset

                <div class="row">
                    @foreach($articles as $article)
                        <div class="col-lg-3 col-md-6 text-center">
                            <p>
                                <a href="{{ route('articles.detail', ['slug' => $article->slug]) }}">
                                    <img src="{{ $article->image }}" alt="Pic" class="img-fluid">
                                </a>
                            </p>
                            <h4><a href="{{ route('articles.detail', ['slug' => $article->slug]) }}">{{ $article->title }}</a></h4>
                            <p>{!! \Illuminate\Support\Str::limit($article->heading, 50) !!}</p>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <section class="promo_full">
            <div class="promo_full_wp magnific">
                <div>
                    <h3>đi bất cứ đâu</h3>
                    <p>Chúng tôi sẽ giúp bạn tìm kiếm các chuyến du lịch hấp dẫn nhất với giá cực ưu đãi. Đăng ký để nhận ngay thông tin!</p>
                    <a href="https://www.youtube.com/watch?v=Zz5cu72Gv5Y" class="video"><i class="icon-play-circled2-1"></i></a>
                </div>
            </div>
        </section>

        <div class="container margin_60">

            <div class="main_title">
                <h2>Sự lựa chọn<span> tuyệt vời</span> cho bạn</h2>
                <p>
                    Tour chọn lọc chất lượng. Bảo đảm giá tốt nhất. Tư vấn tận tình. Thanh toán nhanh gọn. Đặt ngay hôm nay!
                </p>
            </div>

            <div class="row">

                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.2s">
                    <div class="feature_home">
                        <i class="icon_set_1_icon-41"></i>
                        <h3><span>+{{ \App\Helpers\TourHelper::count() }}</span> Tour tuyệt vời</h3>
                        <p>
                            Ở bất cứ nơi nào trên thế giới, những đứa trẻ hồn nhiên, vô tư vui đùa với nhau luôn là những khoảnh khắc tuyệt vời nhất.
                        </p>
                        <a href="{{ route('Main.tour.index') }}" class="btn_1 outline">Xem thêm</a>
                    </div>
                </div>

                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.4s">
                    <div class="feature_home">
                        <i class="icon_set_1_icon-30"></i>
                        <h3><span>+{{ \App\Helpers\UserHelper::countUsers() }}</span> Khách hàng</h3>
                        <p>
                            Chúng tôi đang dần nâng cao trải nghiệm của người dùng, đem đến cho bạn những lựa chọn hợp lý nhất. Phù hợp túi tiền với các bạn.
                        </p>
                        <a href="{{ route('Main.tour.index') }}" class="btn_1 outline">Xem thêm</a>
                    </div>
                </div>

                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="feature_home">
                        <i class="icon_set_1_icon-57"></i>
                        <h3>Hỗ trợ <span>24h</span></h3>
                        <p>
                            Chúng tôi luôn sẵn sàng giải đáp các thắc mắc của bạn. Tạo cảm giác như đang ở nhà. Nhấc điện thoại lên và liên hệ ngay với chúng tôi.
                        </p>
                        <a href="{{ route('contact.store') }}" class="btn_1 outline">Liên hệ</a>
                    </div>
                </div>

            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('Libraries/Main/img/laptop.png') }}" alt="Laptop" class="img-fluid laptop">
                </div>
                <div class="col-md-6">
                    <h3><span>Bắt đầu</span> với CityTour</h3>
                    <p>
                        Hướng dẫn bạn bắt đầu nhanh với City Tour
                    </p>
                    <ul class="list_order">
                        <li><span>1</span>Chọn các chuyến tham quan ưa thích của bạn</li>
                        <li><span>2</span>Đặt cọc tour và tiến hành thanh toán</li>
                        <li><span>3</span>Đợi phản hồi và bắt đầu 1 chuyến du lịch tuyệt vời</li>
                    </ul>
                    <a href="{{ route('Main.tour.index') }}" class="btn_1">Bắt đầu ngay</a>
                </div>
            </div>
        </div>
    </main>
@endsection
