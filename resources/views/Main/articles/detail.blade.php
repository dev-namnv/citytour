@extends('layouts.main.app')

@section('title', $article->title)

@section('extra-css')
    <link href="{{asset('libraries/main/css/blog.css')}}" rel="stylesheet">
@endsection

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="{{asset('Libraries/Main/img/bg_blog.jpg')}}"
             data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>{{ __('pages.article.news') }}</h1>
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
                    <li><a href="#">{{ __('pages.article.news') }}</a>
                    </li>
                    <li>{{ __('pages.article.detail') }}</li>
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
                        <div class="post nopadding">
{{--                            <img src="{{asset('libraries/main/img/blog-1.jpg')}}" alt="Image" class="img-fluid">--}}
                            <div class="text-center mb-3">
                                <img src="{{$article->image}}" alt="{{$article->image}}" class="img-fluid rounded">
                            </div>
                            <div class="post_info clearfix">
                                <div class="post-left">
                                    <ul>
                                        <li><i class="icon-calendar-empty"></i>{{ __('pages.article.on') }} <span>{{$article->release_day}}</span>
                                        </li>
                                        <li><i class="icon-inbox-alt"></i>{{ __('pages.article.in') }}
                                            @foreach($article->categories->take(2) as $key => $category)
                                                <a href="#{{$category->id}}">{{$category->name}}</a>,
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
                                <div class="post-right"><i class="icon-comment"></i><a href="#comments">{{count($article->comments)}} </a>{{ __('pages.article.comments') }}</div>
                            </div>
                            <h2>{{$article->title}}</h2>
                            <p>
                                {{$article->heading}}
                            </p>

                            <div>
                                {!! $article->content !!}
                            </div>
                        </div>
                        <!-- end post -->
                    </div>
                    <!-- end box_style_1 -->

                    <h4>{{count($article->comments)}} {{ __('pages.article.comments') }}</h4>
                    <div id="comments">
                        <ol>
                            @foreach($article->comments as $key => $comment)
                                @if($comment->reply_for === null)
                                    <li>
                                        <div class="avatar">
                                            <a href="#"><img src="{{$comment->user->avatar}}" width="50" alt="Image">
                                            </a>
                                        </div>

                                        <div class="comment_right clearfix">
                                            <div class="comment_info">
                                                {{ __('pages.article.posted_by') }} <a href="#">{{$comment->user->getFullName()}}</a><span>|</span> {{$comment->created_at}} <span>|</span><a href="#">{{ __('pages.article.reply') }}</a>
                                            </div>
                                            <p>
                                                Cursus tellus quis magna porta adipiscin
                                            </p>
                                        </div>
                                        @foreach($article->comments as $key => $reply_comment)
                                            @if($comment->id == $reply_comment->reply_for)
                                                <ul>
                                                    <li>
                                                        <div class="avatar">
                                                            <a href="#"><img width="50" src="{{$reply_comment->user->avatar}}" alt="Image">
                                                            </a>
                                                        </div>

                                                        <div class="comment_right clearfix">
                                                            <div class="comment_info">
                                                                {{ __('pages.article.posted_by') }} <a href="#">{{$reply_comment->user->getFullName()}}</a><span>|</span> 25 apr 2019 <span>|</span><a href="#">{{ __('pages.article.reply') }}</a>
                                                            </div>
                                                            <p>
                                                                Nam cursus tellus quis magna porta adipiscing. Donec et eros leo, non pellentesque arcu. Curabitur vitae mi enim, at vestibulum magna. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed sit amet sem a urna rutrumeger fringilla. Nam vel enim ipsum, et congue ante.
                                                            </p>
                                                            <p>
                                                                Aenean iaculis sodales dui, non hendrerit lorem rhoncus ut. Pellentesque ullamcorper venenatis elit idaipiscingi Duis tellus neque, tincidunt eget pulvinar sit amet, rutrum nec urna. Suspendisse pretium laoreet elit vel ultricies. Maecenas ullamcorper ultricies rhoncus. Aliquam erat volutpat.
                                                            </p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            @endif
                                        @endforeach
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                    <!-- End Comments -->

                    <h4>{{ __('pages.article.leave_a_comment') }}</h4>
                    <form action="#" method="post">
                        <div class="form-group">
                            <input class="form-control style_2" type="text" name="name" placeholder="{{ __('pages.article.enter_name') }}">
                        </div>
                        <div class="form-group">
                            <input class="form-control style_2" type="text" name="mail" placeholder="{{ __('pages.article.enter_email') }}">
                        </div>
                        <div class="form-group">
                            <textarea name="message" class="form-control style_2" style="height:150px;" placeholder="{{ __('pages.article.message') }}"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="reset" class="btn_1" value="{{ __('pages.article.clear_form') }}">
                            <input type="submit" class="btn_1" value="{{ __('pages.article.post_comment') }}">
                        </div>
                    </form>
                </div>
                <!-- End col-md-9-->

            </div>
            <!-- End row-->
        </div>
        <!-- End container -->
    </main>
@endsection
