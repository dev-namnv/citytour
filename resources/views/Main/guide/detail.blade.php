@extends('layouts.main.app')

@section('title', $guide->getFullName())

@section('content')
    {{--    {{dd($chunkReviews)}}--}}
    <section class="parallax-window" data-parallax="scroll"
             data-image-src="{{asset('libraries/main/img/tourist_guide.jpg')}}" data-natural-width="1400"
             data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Tôi là {{$guide->getFullName()}}</h1>
                {{--                <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>--}}
            </div>
        </div>
    </section>

    <main style="margin-bottom: 355px;">
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">Home</a>
                    </li>
                    <li><a href="#">Category</a>
                    </li>
                    <li>Page active</li>
                </ul>
            </div>
        </div>
        <!-- End Position -->

        <div class="margin_60 container">
            <div id="tour_guide">
                <p>
                    <img src="{{$guide->avatar}}" alt="Image" class="rounded-circle styled">
                </p>
                <h2>{{$guide->getFullName()}} - Hướng dẫn viên du lịch có chứng chỉ</h2>
                {{--                <p class="lead add_bottom_30">--}}
                {{--                    "Eu tota moderatius usu, ad putant aliquando constituam ius, <strong>commodo sententiae</strong> suscipiantur nam eu. Tamquam nominati abhorreant at vis, has id harum melius petentium. Mea wisi debet omnium ne, est ea graecis noluisse recusabo, denique deterruisset ius et."--}}
                {{--                </p>--}}
            </div>
        {{--            <div class="row">--}}
        {{--                <div class="col-md-8">--}}
        {{--                    <h3>Some words about me</h3>--}}
        {{--                    <p>--}}
        {{--                        Lorem ipsum dolor sit amet, ex justo nominavi eum, cu veniam salutatus reprimique quo, nisl virtute meliore ei eos. Quaestio consequat sed no, urbanitas honestatis ei usu. Ex nec aliquid appetere petentium, ei eum soleat possim. Has ea omnes prompta. Vel te magna voluptaria, cu nec fabulas voluptatum, has et dictas quaeque labores. Qui ex mazim sadipscing.--}}
        {{--                    </p>--}}
        {{--                    <h5>Education</h5>--}}
        {{--                    <p>--}}
        {{--                        Lorem ipsum dolor sit amet, ex justo nominavi eum, cu veniam salutatus reprimique quo, nisl virtute meliore ei eos. Quaestio consequat sed no, urbanitas honestatis ei usu. Ex nec aliquid appetere petentium, ei eum soleat possim. Has ea omnes prompta. Vel te magna voluptaria, cu nec fabulas voluptatum, has et dictas quaeque labores. Qui ex mazim sadipscing.--}}
        {{--                    </p>--}}
        {{--                    <h5>Past experiences</h5>--}}
        {{--                    <p>--}}
        {{--                        Lorem ipsum dolor sit amet, ex justo nominavi eum, cu veniam salutatus reprimique quo, nisl virtute meliore ei eos. Quaestio consequat sed no, urbanitas honestatis ei usu. Ex nec aliquid appetere petentium, ei eum soleat possim. Has ea omnes prompta. Vel te magna voluptaria, cu nec fabulas voluptatum, has et dictas quaeque labores. Qui ex mazim sadipscing.--}}
        {{--                    </p>--}}
        {{--                </div>--}}
        {{--                <div class="col-md-4">--}}
        {{--                    <h3>Spoken languages</h3>--}}
        {{--                    <p>--}}
        {{--                        Eu tota moderatius usu, ad putant aliquando constituam ius, commodo sententiae suscipiantur nam eu.--}}
        {{--                    </p>--}}
        {{--                    <p>--}}
        {{--                        <img src="img/lang_en_2x.png" width="40" height="26" alt="Image" data-retina="complete"> <img src="img/lang_fr_2x.png" width="40" height="26" alt="Image" data-retina="complete">--}}
        {{--                        <img src="img/lang_de_2x.png" width="40" height="26" alt="Image" data-retina="complete"> <img src="img/lang_es_2x.png" width="40" height="26" alt="Image" data-retina="complete">--}}
        {{--                    </p>--}}
        {{--                    <h3><i class=""></i>Certificates</h3>--}}
        {{--                    <p>--}}
        {{--                        Eu tota moderatius usu, ad putant aliquando constituam ius, commodo sententiae suscipiantur nam eu.--}}
        {{--                    </p>--}}
        {{--                    <ul class="list_ok">--}}
        {{--                        <li>Putant aliquando constituam</li>--}}
        {{--                        <li>Commodo sententiae</li>--}}
        {{--                        <li>Denique deterruisset</li>--}}
        {{--                        <li>Putant aliquando constituam</li>--}}
        {{--                    </ul>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        <!-- end row -->
        </div>
        <!-- end container -->

        <div class="container margin_60">
            <div class="main_title">
                <h2>Mọi người nói gì về <span>{{$guide->getFullName()}}</span> ?</h2>
                <p>
                    Dưới đây là những đánh giá tiêu biểu
                </p>
            </div>

            <div class="row">
                @foreach($chunkReviews[0] as $key => $review)
                    <div class="col-md-6">
                        <div class="review_strip">
                            <img src="{{$review->user->avatar}}" alt="{{$review->user->getFullName()}}"
                                 class="rounded-circle">
                            <h4>{{$review->user->getFullName()}}</h4>
                            <p>
                                {{$review->content}}
                            </p>
                            <div class="rating">
                                @for($i = 0; $i < 5; $i++)
                                    @if ($i < $review->star)
                                        <i class="icon-star voted"></i>
                                    @else
                                        <i class=" icon-star-empty"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <!-- End review strip -->
                    </div>
                @endforeach

            </div>
            <!-- End row -->

            <div class="row">
                @foreach($chunkReviews[1] as $key => $review)
                    <div class="col-md-6">
                        <div class="review_strip">
                            <img src="{{$review->user->avatar}}" alt="{{$review->user->getFullName()}}"
                                 class="rounded-circle">
                            <h4>{{$review->user->getFullName()}}</h4>
                            <p>
                                {{$review->content}}
                            </p>
                            <div class="rating">
                                @for($i = 0; $i < 5; $i++)
                                    @if ($i < $review->star)
                                        <i class="icon-star voted"></i>
                                    @else
                                        <i class=" icon-star-empty"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <!-- End review strip -->
                    </div>
            @endforeach
            <!-- End row -->
            </div>
        </div>
        <!-- End container -->
    </main>
@endsection
