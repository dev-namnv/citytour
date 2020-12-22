@extends('layouts.main.app')

@section('title', 'Wishlist')

@section('extra-css')
    <link href="{{asset('Libraries/Main/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1200,h_630,f_auto/w_80,x_15,y_15,g_south_west,l_klook_water/activities/hsnmkdasrhwmvng1yrht/V%C3%A9%20C%C3%B4ng%20Vi%C3%AAn%20Su%E1%BB%91i%20Kho%C3%A1ng%20N%C3%B3ng%20N%C3%BAi%20Th%E1%BA%A7n%20T%C3%A0i%20%C4%90%C3%A0%20N%E1%BA%B5ng.jpg"
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
                    <li><a href="#">Home</a>
                    </li>

                    <li>Danh sách yêu thích</li>
                </ul>
            </div>
        </div>
        <!-- Position -->



        <div class="container margin_60">
            <div class="row">
                <div class="col-lg-9">
                    @if(count(auth()->user()->wishlists) > 0)
                        @foreach(auth()->user()->wishlists as $key => $tour)
                            <div class="strip_all_tour_list wow fadeIn" id="tour_{{$tour->id}}" data-wow-delay="0.1s"
                                 style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="wishlist_close" onclick="Main.removeTourInWishlist({{$tour->id}})">-</div>
                                        <div class="img_list">
                                            <a href="{{route('Main.tour.show', $tour->slug)}}">
                                                <img src="{{$tour->thumbnail}}" alt="Image">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="tour_list_desc">
                                            <h3>{{\Illuminate\Support\Str::limit($tour->name, 30)}}</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="price_list">
                                            <div><h2 class="mb-3 text-danger" style="font-size: 20px">{{$tour->adult_price}}</h2>
                                                <p><a href="{{route('Main.tour.show', $tour->slug)}}" class="btn_1">Chi tiết</a>
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
