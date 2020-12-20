@extends('layouts.main.app')

@section('title', $guide->getFullName())

@section('content')
    {{--    {{dd($chunkReviews)}}--}}
    <section class="parallax-window" data-parallax="scroll"
             data-image-src="{{ 'https://dmresourcecenter.com/wp-content/uploads/2014/10/big-seven-header-1400x400.jpg' }}" data-natural-width="1400"
             data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Tôi là {{$guide->getFullName()}}</h1>
            </div>
        </div>
    </section>

    <main style="margin-bottom: 355px;">
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li><a href="#">Hướng đẫn viên</a>
                    </li>
                    <li>{{ $guide->getFullName() }}</li>
                </ul>
            </div>
        </div>
        <!-- End Position -->

        <div class="margin_60 container">
            <div id="tour_guide">
                <p>
                    <img src="{{$guide->avatar}}" alt="Image" class="rounded-circle styled" style="max-width: 100px">
                </p>
                <h2>{{$guide->getFullName()}} - Hướng dẫn viên du lịch có chứng chỉ</h2>
            </div>
        </div>

        <div class="container margin_60">
            <div class="main_title">
                <h2>Mọi người nói gì về <span>{{$guide->getFullName()}}</span> ?</h2>
                <p>
                    Dưới đây là những đánh giá tiêu biểu
                </p>
            </div>

            @if($reviews[0]->count() > 0)
                <div class="row">
                    @foreach($reviews[0] as $key => $review)
                        <div class="col-md-6">
                            <div class="review_strip">
                                <img src="{{$review->user->avatar}}" style="width: 60px; margin-top: 20px" alt="{{$review->user->getFullName()}}"
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
                        </div>
                    @endforeach
                </div>
            @endif
            @if($reviews[1]->count() > 0)
                <div class="row">
                    @foreach($reviews[1] as $key => $review)
                        <div class="col-md-6">
                            <div class="review_strip">
                                <img src="{{$review->user->avatar}}" style="width: 60px; margin-top: 20px" alt="{{$review->user->getFullName()}}"
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
                        </div>
                @endforeach
                </div>
            @endif
        </div>
    </main>
@endsection
