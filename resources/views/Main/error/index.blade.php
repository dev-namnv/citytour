@extends('layouts.main.app')

@section('title', '404')

@section('content')
    <section id="hero">
        <div class="intro_title error">
            <h1 class="animated fadeInDown">404</h1>
            <p class="animated fadeInDown">Trang không tìm thấy</p>
            <a href="{{ route('home') }}" class="animated fadeInUp button_intro">Quay về trang chủ</a> <a href="{{ route('Main.tour.index') }}" class="animated fadeInUp button_intro outline">Xem tất cả Tour</a>
        </div>

    </section>

    <main>
        <div class="container margin_60">

            @isset($tour_min)
                <div class="banner colored add_bottom_30">
                    <h4>Đặt Tour ngay <span>chỉ với {{ $tour_min->adult_price }}</span></h4>
                    <p>{{ \Illuminate\Support\Str::limit($tour_min->description, 150) }}</p>
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
                        <h4><span>{{ \Illuminate\Support\Str::limit($article->title, 20) }}</span> {{ \Illuminate\Support\Str::limit($article->heading, 10) }}</h4>
                        <p>{{ \Illuminate\Support\Str::limit($article->content) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
