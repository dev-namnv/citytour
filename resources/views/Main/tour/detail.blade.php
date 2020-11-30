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
                                @if($i <= round($tour->reviews->avg('star')))
                                    <i class="icon-smile voted"></i>
                                @else
                                    <i class="icon-smile"></i>
                                @endif
                            @endfor
                        ({{ round($tour->reviews->avg('star'),1) }})
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="price_single_main">
                            <span>{{ $tour->getCurrentPrice() }}</span>
                            <i>/người lớn</i>
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
                                    <div class="row">
                                        <h4><strong>Ngày {{ $key + 1 }}</strong></h4>
                                        {!! $schedule->description !!}
                                    </div>
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
                    <hr>
                    <div class="row">
                        <div class="col-lg-3">
                            <h3>Reviews </h3>
                            @if(Auth::user())
                                <a href="#" class="btn_1 add_bottom_30" data-toggle="modal" data-target="#myReview">Leave a review</a>
                            @endif
                        </div>
                        <div class="col-lg-9">
                            <div class="text-right" id="general_rating">
                                <p>{{ $tour->reviews->count() }} Reviews</p>
                                <div class="rating">
                                    @for($i=1; $i<=5; $i++)
                                        @if($i <= round($tour->reviews->avg('star')))
                                            <i class="icon-smile voted"></i>
                                        @else
                                            <i class="icon-smile"></i>
                                        @endif
                                    @endfor
                                </div>
                                ({{ round($tour->reviews->avg('star'),1) }})
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
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $review->star)
                                                <i class="icon-smile voted"></i>
                                            @else
                                                <i class="icon-smile"></i>
                                            @endif
                                        @endfor
                                    </span>
                                </div>
                                <!-- End review strip -->
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--End  single_tour_desc-->

                <aside class="col-lg-4">
                    <div class="box_style_1 expose">
                        <form action="" method="get">
                            @csrf
                            <h3 class="inner">- Booking -</h3>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span>Khởi hành : </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="start_date" class="form-control">
                                            @foreach($tour->batches as $batch)
                                                <option value="{{ $batch->batch }}">{{ $batch->batch }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <span>Số hành khách hiện tại : </span>
                                </div>
                                <div class="col-sm-6">
                                    <b id="customer_total">{{ $customer_total }}</b>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Người lớn</label>
                                        <div class="numbers-row">
                                            <input type="text" value="0" id="adults" class="qty2 form-control bg-white" readonly name="adult_quantity">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Trẻ em</label>
                                        <div class="numbers-row">
                                            <input type="text" value="0" id="children" class="qty2 form-control bg-white" readonly name="children_quantity">
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
                                        <span class="text-danger">{{ $tour->adult_price }}</span>
                                         x
                                        <span class="person-adult">0</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Trẻ em
                                    </td>
                                    <td class="text-right">
                                        <span class="text-danger">{{ $tour->child_price }}</span>
                                         x
                                        <span class="person-child">0</span>
                                    </td>
                                </tr>
                                <tr class="total">
                                    <td>
                                        Tổng tiền
                                    </td>
                                    <td class="text-right" id="total-price">
                                        0 đ
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button class="btn_full">Đặt ngay</button>
                            <a class="btn_full_outline" href="#"><i class=" icon-heart"></i> Yêu thích</a>
                        </form>
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


    <!-- Modal Review -->
    @if(Auth::user())
        <div class="modal fade" id="myReview" tabindex="-1" role="dialog" aria-labelledby="myReviewLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myReviewLabel">Viết đánh giá</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div id="message-review">
                        </div>
                        <form method="post" action="assets/review_tour.php" name="review_tour" id="review_tour">
                            <input name="tour_name" id="tour_name" type="hidden" value="Paris Arch de Triomphe Tour">
                            <h4>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Chất lượng dịch vụ</label>
                                        <select class="form-control" name="star" id="position_review">
                                            <option value="1">1 Sao</option>
                                            <option value="2">2 Sao</option>
                                            <option value="3">3 Sao</option>
                                            <option value="4">4 Sao</option>
                                            <option value="5">5 Sao</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                            <div class="form-group">
                                <textarea name="review_text" id="review_text" class="form-control" style="height:100px" placeholder="Nội dung"></textarea>
                            </div>
                            <input type="submit" value="Submit" class="btn_1" id="submit-review">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- End modal review -->
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

