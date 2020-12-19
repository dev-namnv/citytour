@extends('layouts.main.app')

@section('title', $article->title)

@section('extra-css')
    <link href="{{asset('Libraries/Main/css/blog.css')}}" rel="stylesheet">
    <style>
        #article-content img {
            height: 300px;
            display: block;
            margin: 0 auto;
        }
    </style>
@endsection

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="{{ 'https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1200,h_630,f_auto/w_80,x_15,y_15,g_south_west,l_klook_water/activities/hsnmkdasrhwmvng1yrht/V%C3%A9%20C%C3%B4ng%20Vi%C3%AAn%20Su%E1%BB%91i%20Kho%C3%A1ng%20N%C3%B3ng%20N%C3%BAi%20Th%E1%BA%A7n%20T%C3%A0i%20%C4%90%C3%A0%20N%E1%BA%B5ng.jpg' }}"
             data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Bài viết</h1>
                <p>{{$article->title}}</p>
            </div>
        </div>
    </section>
    <main style="margin-bottom: 355px;">
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">{{ __('pages.article.home') }}</a>
                    </li>
                    <li><a href="#">Bài viết</a>
                    </li>
                    <li>{{ __('pages.article.detail') }}</li>
                </ul>
            </div>
        </div>
        <!-- End position -->

        <div class="container margin_60">
            <div class="row">
                <aside class="col-lg-3 add_bottom_30">
                    <div class="widget" id="cat_blog">
                        <h4>Chuyên mục bài viết</h4>
                        <ul>
                            @foreach($article_categories as $key => $article_category)
                                <li>
                                    <a href="{{route('Main.article_category.show', $article_category->slug)}}">{{$article_category->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- End widget -->

                    <hr>

                    <div class="widget">
                        <h4>{{ __('pages.article.recent_post') }}</h4>
                        <ul class="recent_post">
                            @foreach($recent_articles as $key => $recent_article)
                                <li>
                                    <i class="icon-calendar-empty"></i> {{$recent_article->release_day}}
                                    <div>
                                        <a href="{{route('articles.detail', $recent_article->slug)}}">{{$recent_article->title}} </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                </aside>
                <!-- End aside -->

                <div class="col-lg-9">
                    <div class="box_style_1">
                        <div class="post nopadding">
{{--                            <img src="{{asset('Libraries/Main/img/blog-1.jpg')}}" alt="Image" class="img-fluid">--}}
                            <div class="text-center mb-3">
                                <img src="{{$article->image}}" alt="{{$article->image}}" class="img-fluid rounded" style="height: 300px;">
                            </div>
                            <div class="post_info clearfix">
                                <div class="post-left">
                                    <ul>
                                        <li><i class="icon-calendar-empty"></i>{{ __('pages.article.on') }} <span>{{$article->release_day}}</span>
                                        </li>
                                        <li><i class="icon-inbox-alt"></i>Chuyên mục
                                            @foreach($article->categories->take(2) as $key => $category)
                                                <a href="{{route('Main.article_category.show', $category->slug)}}">{{$category->name}}</a>,
                                            @endforeach
                                            @if(count($article->categories) > 2)
                                                ...
                                            @endif
                                        </li>
                                        <li><i class="icon-tags"></i>{{ __('pages.article.tags') }}
                                            @foreach($article->tags->take(3) as $key => $tag)
                                                <a href="#">{{$tag->name}}</a>,
                                            @endforeach
                                            @if(count($article->tags) > 3)
                                                ...
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h2>{{$article->title}}</h2>
                            <p>
                                {{$article->heading}}
                            </p>

                            <div id="article-content">
                                {!! $article->content !!}
                            </div>
                        </div>
                        <!-- end post -->
                    </div>
                    <!-- end box_style_1 -->




                </div>
                <!-- End col-md-9-->

            </div>
            <!-- End row-->
        </div>
        <!-- End container -->
    </main>
@endsection
