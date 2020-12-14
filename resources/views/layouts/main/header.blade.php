<header>
    <div id="top_line">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <i class="icon-phone"></i><strong>{{ __('info.hotline') }}</strong>
                </div>

                <div class="col-6">
                    <ul id="top_links">

                        {{--If auth valid--}}
                        @auth
                            <li>
                                <div class="dropdown dropdown-mini">
                                    <a href="#" data-toggle="dropdown" id="lang_link">{{ Auth::user()->first_name }}</a>
                                    <div class="dropdown-menu">
                                        <ul id="lang_menu">
                                            @if(Auth::user()->role !== USER)
                                                <li><a href="{{ route('manager') }}">{{ __('button.manager') }}</a>
                                                </li>
                                            @endif
                                            <li><a href="{{ route('profile') }}">{{ __('button.profile') }}</a>
                                            </li>
                                            <li><a href="{{route('Main.history')}}">Lịch sử</a>
                                            </li>
                                            <li><a href="#" onclick="Main.logoutGlobal(this)">{{ __('button.sign_out') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Dropdown access -->
                            </li>
                            <li><a href="{{route('wishlist.list')}}" id="wishlist_link">{{ __('button.wishlist') }}</a></li>
                        @endauth

                        {{--If auth invalid--}}
                        @guest
                            <li>
                                <a href="#sign-in-dialog" id="access_link">Đăng nhập</a>
                            </li>
                            @endguest
                            </li>
                    </ul>
                </div>
            </div>
            <!-- End row -->
        </div>
        <!-- End container-->
    </div>
    <!-- End top line-->

    <div class="container">
        <div class="row">
            <div class="col-3">
                <div id="logo_home">
                    <h1><a href="{{ route('home') }}" title="{{ __('info.title') }}">{{ __('info.title') }}</a></h1>
                </div>
            </div>
            <nav class="col-9">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);">
                    <span>Menu mobile</span>
                </a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="{{ asset('libraries/main/img/logo_sticky.png') }}" width="160" height="34"
                             alt="City tours" data-retina="true">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                    <ul>
                        <li class="submenu">
                            <a href="{{ route('home') }}" class="show-submenu">Trang chủ</a>
                        </li>
                        <li class="submenu">
                            <a href="{{ route('Main.tour.index') }}" class="show-submenu">Tours</a>
                        </li>
                        <li class="submenu">
                            <a href="{{ route('contact.index') }}" class="show-submenu">Liên hệ</a>
                        </li>
                        <li class="submenu">
                            <a href="{{ route('about') }}" class="show-submenu">Giới thiệu</a>
                        </li>
                        <li class="submenu">
                            <a href="{{ route('articles.list') }}" class="show-submenu">Bài viết</a>
                        </li>
                        <li class="submenu">
                            <a href="{{ route('faq') }}" class="show-submenu">Faq</a>
                        </li>
                    </ul>
                </div><!-- End main-menu -->
                <ul id="top_tools">
                    <li>
                        <a href="javascript:void(0);" class="search-overlay-menu-btn">
                            <i class="icon_search"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <form class="form-logout" method="post" action="{{ route('logout') }}" hidden>
        @csrf
    </form>
</header>
