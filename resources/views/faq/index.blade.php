@extends('layouts.main.app')

@section('title', __('pages.faq.title'))

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="{{asset('Libraries\Main\img\header_bg.jpg')}}" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>{!! __('pages.faq.section.title') !!}</h1>
                <p>{!! __('pages.faq.section.desc') !!}</p>
            </div>
        </div>
    </section>
    <!-- End section -->

    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="{{route('home')}}">Home</a>
                    </li>
                    <li><a href="#">Faq</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Position -->

        <div class="container margin_60">
            <div class="row">
                <aside class="col-lg-3">
                    <div class="box_style_cat">
                        <ul id="cat_nav">
                            <li><a href="#" class="active"><i class="icon_set_1_icon-95"></i>Payments</a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-95"></i>Suggestions and tips</a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-95"></i>Travel reccomendations</a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-95"></i>Terms and conditons</a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-95"></i>Booking and vouchers</a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-95"></i>Transfers</a>
                            </li>
                        </ul>
                    </div>

                    <div class="box_style_2">
                        <i class="icon_set_1_icon-57"></i>
                        <h4>Need <span>Help?</span></h4>
                        <a href="tel://004542344599" class="phone">+45 423 445 99</a>
                        <small>Monday to Friday 9.00am - 7.30pm</small>
                    </div>
                </aside>
                <!--End aside -->
                <div class="col-lg-9" id="faq">
                    @foreach ($faqs as $key => $item)
                        <h3 class="nomargin_top"> {{$key}}</h3>
                        @foreach ($item as $i)
                            <div id="payment" class="accordion_styled">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#payment" href="#collapseTwo_payment">{{$i->heading}}<i class="indicator icon-plus float-right"></i></a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo_payment" class="collapse" data-parent="#payment">
                                        <div class="card-body">{{$i->content}}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <!-- End col lg-9 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </main>
@endsection
