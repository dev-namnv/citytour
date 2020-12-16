<footer class="revealed fixed-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <h3>Liên Hệ</h3>
                <a href="tel://0423445999" id="phone">@lang('info.hotline')</a>
                <a href="mailto:help@citytours.com" id="email_footer">help@citytours.top</a>
            </div>
            <div class="col-lg-2 col-md-3 ml-md-auto">
                <h3>Giới Thiệu</h3>
                <ul>
                    <li>
                        <a href="{{ route('about') }}">Về chúng tôi</a>
                    </li>
                    <li>
                        <a href="{{ route('faq') }}">FAQ</a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}">Đăng nhập</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}">Đăng ký</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 ml-md-auto">
                <h3>Khám Phá</h3>
                <ul>
                    <li><a href="{{ route('articles.list') }}">Bài viết</a></li>
                    <li><a href="{{ route('guide.detail', ['guide_id' => \App\Models\User::query()->where('role', GUIDE)->inRandomOrder()->first()]) }}">Hướng dẫn viên (Ngẫu nhiên)</a></li>
                </ul>
            </div>
            <div class="col-lg-2 ml-lg-auto">
                <h3>Cài Đặt</h3>
                <div class="styled-select">
                    <select name="lang" id="lang">
                        <option value="VI" selected>VietNam</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- End row -->
        <div class="row">
            <div class="col-lg-12">
                <div id="social_footer">
                    <ul>
                        <li><a href="https://www.facebook.com/City-Tours-100149461997048/" target="_blank"><i class="icon-facebook"></i></a>
                        </li>
                        <li><a href="https://twitter.com/tweeter" target="_blank"><i class="icon-twitter"></i></a>
                        </li>
                        <li><a href="mailto:help@citytours.top"><i class="icon-google"></i></a>
                        </li>
                    </ul>
                    <p>© Citytours 2020</p>
                </div>
            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
</footer>
