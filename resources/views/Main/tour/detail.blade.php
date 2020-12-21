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
        .price strong{
            font-size: 24px;
            color: red;
        }
    </style>
@endsection


@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="{{ $tour->banner }}" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-2">
            <div class="container title">
                <div class="row">
                    <div class="col-md-12 text-center rounded pt-2" style="background-color: #00000085">
                        <h1>{{$tour->name}}</h1>
                        <span>{{ $tour->address }}</span>
                        <br/>
                        @if($tour->reviews->count() > 0)
                            <p class="d-inline-block bg-info p-2 text-white rounded">điểm {{ round($tour->reviews->avg('star'),1) }}/10</p>
                        @endif
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
                <div class="col-lg-9" id="single_tour_desc">
                    <div class="row p-3 bg-white">
                        <div class="col-md-4">
                            <div class="row">
                                <strong>ĐIỂM XUẤT PHÁT: </strong>
                                <span class="ml-1">{{ $tour->origin }}</span>
                            </div>
                            <div class="row">
                                <strong>THỜI GIAN: </strong>
                                <span class="ml-1">{{ $tour->schedules->count() }} ngày</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="price">
                                Giá Người Lớn: <strong>{{ $tour->adult_price }}</strong>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="price">
                                Giá Trẻ Em: <strong>{{ $tour->child_price }}</strong>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row mb-2">
                        <strong class="ml-3">Ngày khởi hành: </strong>
                        <div class="col-lg-12 text-center mb-2">
                            @foreach($tour->batches as $batch)
                                <span class="d-inline-block p-1 bg-secondary rounded text-white">{{ date('d-m-Y', strtotime($batch->batch)) }}</span>
                            @endforeach
                        </div>
                        <div class="col-lg-12 text-center">
                            <a href="{{ route('checkout.detail', ['slug' => $tour->slug]) }}" style="color: #ffffff" class="bg-info p-2 d-block">Đặt Lịch</a>
                        </div>
                    </div>
                    <div id="Img_carousel" class="slider-pro">
                        <div class="sp-slides">
                            @foreach($tour->albums as $image)
                            <div class="sp-slide">
                                <img alt="Image" class="sp-image" src="{{asset('Libraries/Main/css/images/blank.gif')}}" data-src="{{ $image->image }}" data-small="{{ $image->image }}" data-medium="{{ $image->image }}" data-large="{{ $image->image }}" data-retina="{{ $image->image }}">
                            </div>
                            @endforeach
                        </div>
                        <span id="description"></span>
                        <div class="sp-thumbnails">
                            @foreach($tour->albums as $thumbnail)
                                <img alt="Image" class="sp-thumbnail" src="{{ $thumbnail->image }}">
                            @endforeach
                        </div>
                    </div>

                    <hr id="schedule">

                    <div class="row">
                        <div class="col-lg-3">
                            <h3>Mô tả</h3>
                        </div>
                        <div class="col-lg-9">
                            {!! $tour->description !!}
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
                                    <h4><strong>Ngày {{ $key + 1 }}</strong></h4>
                                    {!! $schedule->description !!}
                                    <hr/>
                                @endforeach
                            @else
                                <h4><strong>Đi trong ngày</strong></h4>
                                {!! $tour->schedules->first()->description !!}
                            @endif
                        </div>
                    </div>
                    @if(!empty($tour->note))
                        <hr>
                        <div class="row">
                            <div class="col-lg-3">
                                <h3>Chú ý</h3>
                            </div>
                            <div class="col-lg-9">
                            {!! $tour->note !!}
                            <!-- End row  -->
                            </div>
                        </div>
                    @endif
                    <hr id="review">
                    <div class="row">
                        <div class="col-lg-3">
                            <h3>Đánh giá </h3>
                        </div>
                        <div class="col-lg-9">
                            <div class="text-right" id="general_rating">
                                <p>{{ $tour->reviews->count() }} đánh giá</p>
                                @if($tour->reviews->count())
                                    <p class="d-inline-block bg-info p-2 text-white rounded">điểm {{ round($tour->reviews->avg('star'),1) }}/10</p>
                                @endif
                            </div>
                            <!-- End general_rating -->
                            @foreach($tour->reviews as $key => $review)
                                @break($key == 5)
                                <div class="review_strip_single">
                                    <img src="{{ $review->user->avatar }}" alt="Image" width="60" class="rounded-circle">
                                    <small> {{ $review->created_at }}</small>
                                    <h4>{{ $review->user->last_name }}</h4>
                                    <p>
                                        "{{ $review->content }}"
                                    </p>
                                    <span class="rating">
                                       <div class="small text-primary">
                                        Điểm:
                                        <span>{{ $review->star }}</span>
                                    </div>
                                    </span>
                                </div>
                                <!-- End review strip -->
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--End  single_tour_desc-->
                <div class="col-lg-3" style="z-index: -1">
                    <div style="position: sticky; top: 100px;">
                        <div class="sidebar border" style="">
                            <ul class="navbar-nav bg-white">
                                <li class="navbar-item p-2 border-bottom">
                                    <a href="#description" class="navbar-link text-dark-75">Mô tả</a>
                                </li>
                                <li class="navbar-item p-2 border-bottom">
                                    <a href="#schedule" class="navbar-link text-dark-75">Lịch trình</a>
                                </li>
                                <li class="navbar-item p-2 border-bottom">
                                    <a href="#review" class="navbar-link text-dark-75">Đánh giá</a>
                                </li>
                                <li class="navbar-item p-2 border-bottom">
                                    <a href="#recommend" class="navbar-link text-dark-75">Tour liên quan</a>
                                </li>
                                <li class="navbar-item p-2 border-bottom">
                                    <a href="{{route('Main.tour.pdf',['slug'=> $tour->slug])}}" class="navbar-link text-dark-75">In Lịch Trình</a>
                                </li>
                            </ul>
                        </div>
                        <div class="box_style_4 mt-3">
                            <a href="tel://004542344599" class="phone">
                                <i class="icon_set_1_icon-90"></i>
                                <h4>Hỗ Trợ</h4>
                                {{ __('info.hotline') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <h5 class="ml-auto" id="recommend">Tour liên quan</h5>
            <div class="row">
                @foreach($tour_recommend as $tour)
                    <div class="col-lg-3 col-md-6 text-center mb-2">
                        <a class="text-dark" href="{{route('Main.tour.show',['slug'=> $tour->slug])}}">
                            <p>
                                <img src="{{ $tour->thumbnail }}" alt="Pic" class="img-fluid">
                            </p>
                            <div class="tour_info">
                                <strong>{!! $tour->name !!}</strong>
                                @if($tour->reviews->count() != 0 )
                                    <div class="small">
                                        Điểm:
                                        <span>{{ round($tour->reviews->avg('star'),1) }}</span>
                                    </div>
                                @endif
                                <div class="add_info">
                                    <div class="tooltip-item">
                                        Tour <span>
                                            {{ $tour->schedules->count() == 1 ? 'trong' : $tour->schedules->count() }}
                                        </span> ngày
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <!--End row -->
        </div>
        <!--End container -->

        <div id="overlay"></div>
        <!-- Mask on input focus -->
    </main>

    <div id="toTop"></div><!-- Back to top button -->

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

    <script>
        $('.numbers-row').on('click',function () {
            let adult_price = parseFloat({{ $tour->adult_price->getAmount() }}) ;
            let child_price = {{ $tour->child_price->getAmount() }};
            let adults = $('input#adults').val()
            let children = $('input#children').val()
            let total_price = (adult_price * adults) + (child_price * children);
            $('.person-adult').text(adults)
            $('.person-child').text(children)
            $('#total-price').text(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(total_price))
        })

        $(`select[name='start_date']`).change(function (){
            let tour_id = {{ $tour->id }};
            let start_date = $(this).val();
            let customer_total = document.querySelector('#customer_total');
            $.ajax({
                url: `{{ route('api-customer-total') }}`,
                method: "GET",
                data: {
                    tour_id: tour_id,
                    start_date: start_date,
                }
            }).done(function (res) {
                customer_total.textContent = res.customer_total;
            })
        })
    </script>

@endsection

