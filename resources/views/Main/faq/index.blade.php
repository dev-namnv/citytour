@extends('layouts.main.app')

@section('title', __('FAQ'))

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="https://cdn.vietnambiz.vn/171464876016439296/2020/10/20/anh-1603189635999219727010.png" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>{!! __('pages.faq.title') !!}</h1>
                <p>{!! __('pages.faq.desc') !!}</p>
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
                            @foreach ($faqs as $key => $item)
                                <li>
                                    <a href="#{!! $key !!}"><i class="icon_set_1_icon-95"></i>{!! $key !!}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="box_style_2">
                        <i class="icon_set_1_icon-57"></i>
                        <h4>Need <span>Help?</span></h4>
                        <a href="tel://004542344599" class="phone">{{ __('info.hotline') }}</a>
                        <small>{{ __('info.opening') }}</small>
                    </div>
                </aside>
                <!--End aside -->
                <div class="col-lg-9" id="faq">
                    @foreach ($faqs as $key => $item)
                        <h3 class="nomargin_top" id="{{$key}}"> {{$key}}</h3>
                        @foreach ($item as $index => $i)
                            <div id="payment" class="accordion_styled">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#payment" href="#collapseTwo_{!! $key.$index !!}">{{$i->heading}}<i class="indicator icon-plus float-right"></i></a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo_{!! $key.$index !!}" class="collapse" data-parent="#payment">
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
