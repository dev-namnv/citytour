@extends('layouts.main.app')


@section('extra-css')
    <link href="{{asset('libraries/main/css/blog.css')}}" rel="stylesheet">
@endsection

@section('title', 'Articles')

@section('extra-js')
    <script>
        $('.pagination').addClass('justify-content-center');
    </script>
@endsection

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="{{asset('Libraries/Main/img/bg_blog.jpg')}}"
             data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>{{ __('pages.article.news') }}</h1>
            </div>
        </div>
    </section>
    <main style="margin-bottom: 355px;">
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="/">{{ __('pages.article.home') }}</a>
                    </li>
                    <li>{{ __('pages.article.news') }}</li>
                </ul>
            </div>
        </div>
        <!-- End position -->

        <div class="container margin_60">
            <div class="row">
                <aside class="col-lg-3 add_bottom_30">

                    <div class="widget">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="{{ __('pages.article.search') }}...">
                            <span class="input-group-btn">
						<button class="btn btn-default" type="button" style="margin-left:0;"><i class="icon-search"></i></button>
						</span>
                        </div>
                        <!-- /input-group -->
                    </div>
                    <!-- End Search -->

                    <hr>

                    <div class="widget" id="cat_blog">
                        <h4>{{ __('pages.article.categories') }}</h4>
                        <ul>
                            @foreach($article_categories as $key => $article_category)
                                <li>
                                    <a href="#">{{$article_category->name}}</a>
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
                    <!-- End widget -->
                    <hr>
                    <div class="widget tags">
                        <h4>{{ __('pages.article.tags') }}</h4>
                        @foreach($article_tags as $key => $article_tag)
                            <a href="#">{{$article_tag->name}}</a>
                        @endforeach
                    </div>
                    <!-- End widget -->

                </aside>
                <!-- End aside -->

                <div class="col-lg-9">
                    <div class="box_style_1">
                        @foreach($articles as $key => $article)
                            <div class="post">
                                <div class="text-center">
                                    <a href="{{route('articles.detail', $article->slug)}}" title="{{$article->image}}">
                                        <img src="{{$article->image}}" alt="Image" class="img-fluid rounded">
                                    </a>
                                </div>
                                <div class="post_info clearfix">
                                    <div class="post-left">
                                        <ul>
                                            <li><i class="icon-calendar-empty"></i> {{ __('pages.article.on') }}
                                                <span>{{$article->release_day}}</span>
                                            </li>
                                            <li>
                                                <i class="icon-inbox-alt"></i> {{ __('pages.article.in') }}
                                                @foreach($article->categories->take(2) as $key => $category)
                                                    <a href="#{{$category->id}}">{{$category->name}}</a>,
                                                @endforeach
                                                @if(count($article->categories) > 2)
                                                    ...
                                                @endif

                                            </li>
                                            <li>
                                                <i class="icon-tags"></i> {{ __('pages.article.tags') }}:
                                                @foreach($article->tags->take(3) as $key => $tag)
                                                    <a href="#">{{$tag->name}}</a>,
                                                @endforeach
                                                @if(count($article->tags) > 3)
                                                    ...
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="post-right"><i class="icon-comment"></i><a href="#">{{count($article->comments)}}</a>
                                    </div>
                                </div>
                                <h2>{{$article->title}}</h2>

                                <p>{{$article->heading}}</p>
                                <a href="{{route('articles.detail', $article->slug)}}" class="btn_1"
                                   title="{{$article->title}}">{{ __('pages.article.read_more') }}</a>
                            </div>
                            <!-- end post -->
                            <hr>
                        @endforeach
                    </div>
                    <!-- end box style -->
                    <hr>
                {{$articles->links()}}
                <!-- end pagination-->

                </div>
                <!-- End col-md-9-->
            </div>
            <!-- End row-->
        </div>
        <!-- End container -->
    </main>
@endsection
