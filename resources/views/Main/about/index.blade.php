@extends('layouts.main.app')

@section('title', __('pages.about.title'))

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="{{asset('Libraries\Main\img\header_bg.jpg')}}" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>{!! __('pages.about.section.title') !!}</h1>
                <p>{!! __('pages.about.section.desc') !!}</p>
            </div>
        </div>
    </section>
    <!-- End Section -->

    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li><a href="{{ route('about') }}">Giới thiệu</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Position -->

        <div class="container margin_60">

            <div class="main_title">
                <h2>Lý do <span>chọn</span> chúng tôi</h2>
                <p>Với tiêu chí đặt trải nghiệm của bạn lên làm đầu. Chúng tôi đang nỗ lực để tạo sự thoải mái cho một chuyến du lịch tuyệt vời.</p>
            </div>

            <div class="row">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="feature">
                        <i class="icon_set_1_icon-30"></i>
                        <h3><span>+{{ \App\Helpers\UserHelper::countUsers() }}</span> Khách hàng</h3>
                        <p>
                            Chúng tôi đang dần nâng cao trải nghiệm của người dùng, đem đến cho bạn những lựa chọn hợp lý nhất. Phù hợp túi tiền với các bạn.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.2s">
                    <div class="feature">
                        <i class="icon_set_1_icon-41"></i>
                        <h3><span>+{{ \App\Helpers\TourHelper::count() }}</span> Tour tuyệt vời</h3>
                        <p>
                            Ở bất cứ nơi nào trên thế giới, những đứa trẻ hồn nhiên, vô tư vui đùa với nhau luôn là những khoảnh khắc tuyệt vời nhất.
                        </p>
                    </div>
                </div>
            </div>
            <!-- End row -->
            <div class="row">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                    <div class="feature">
                        <i class="icon_set_1_icon-57"></i>
                        <h3>Hỗ trợ <span>24h</span></h3>
                        <p>
                            Chúng tôi luôn sẵn sàng giải đáp các thắc mắc của bạn. Tạo cảm giác như đang ở nhà. Nhấc điện thoại lên và liên hệ ngay với chúng tôi.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.4s">
                    <div class="feature">
                        <i class="icon_set_1_icon-61"></i>
                        <h3>Đi bất cứ đâu</h3>
                        <p>
                            Chúng tôi sẽ giúp bạn tìm kiếm các chuyến du lịch hấp dẫn nhất với giá cực ưu đãi. Đăng ký để nhận ngay thông tin!
                        </p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <h4>Dịch vụ đơn giản</h4>
                    <p>Các dịch vụ đi kèm mà chúng tôi cung cấp là những cái tưởng chừng như ít được quan tâm nhưng bạn đã nhầm. Chúng tôi luôn cố gắng tạo nên cảm giác thoải mái nhất cho bạn</p>
                    <div class="general_icons">
                        <ul>
                            @foreach($services[0] as $service)
                                <li><i class="{{ $service->icon }}"></i>{{ $service->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4>Nhưng phù hợp với mọi người</h4>
                    <p>Chúng tôi cũng cấp các dịch vụ thiết thực với mọi người, nơi mà những <b>Tour</b> cố định khác chưa có, bạn có thể tham khảo một số dưới đây.</p>
                    <div class="general_icons">
                        <ul>
                            @foreach($services[1] as $service)
                                <li><i class="{{ $service->icon }}"></i>{{ $service->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 nopadding features-intro-img">
                    <div class="features-bg">
                        <div class="features-img"></div>
                    </div>
                </div>
                <div class="col-lg-6 nopadding">
                    <div class="features-content">
                        <h3>"Phổ biến và phải chăng"</h3>
                        <p>
                            Bạn có thể tham khảo một số Tour được đánh giá cao với giá cả hợp túi tiền nhất.
                            <br/> Có thể tìm hiểu và thêm các bộ lọc như ngày khởi hành, địa điểm, đánh giá.
                            Tìm hiểu thêm tại đây.
                        </p>
                        <p><a href="{{ route('Main.tour.index', ['price' => 'lower', 'ranking' => 'higher']) }}" class=" btn_1 white">Xem thêm</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End container-fluid  -->

        <div class="container margin_60">

            <div class="main_title">
                <h2><span>người dùng </span>nói gì về chúng tôi</h2>
                <p>Những đánh giá nổi bật của người dùng được ghi nhận trên hệ thống của chúng tôi.</p>
            </div>

            <div class="row">
                @foreach ($comments as $c)
                    <div class="col-lg-6">
                        <div class="review_strip" style="min-height: 170px">
                            <img src="{{ $c->user->avatar }}" style="width: 60px; margin-top: 25px" alt="Image" class="rounded-circle">
                            <h4>{{ $c->user->getFullName() }}</h4>
                            <p>{{ $c->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <img src="libraries/main/img/laptop.png" alt="Laptop" class="img-fluid laptop">
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
