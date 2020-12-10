@extends('layouts.main.app')

@section('title', 'Xem trước')

@section('content')
    <section id="hero_2" style="background: url('https://hiteapts.com/assets/images/cache/banner_tour-5405a7630ed2b4367d9afe15b947a91d.jpg')">
        <div class="intro_title">
            <h1>Đơn đặt lịch của bạn</h1>
            <div class="bs-wizard row">

                <div class="col-4 bs-wizard-step complete">
                    <div class="text-center bs-wizard-stepnum">{{ \Illuminate\Support\Str::limit($tour->name, 20) }}</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="#" class="bs-wizard-dot"></a>
                </div>

                <div class="col-4 bs-wizard-step complete">
                    <div class="text-center bs-wizard-stepnum">Chi tiết thanh toán</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="#" class="bs-wizard-dot"></a>
                </div>

                <div class="col-4 bs-wizard-step complete">
                    <div class="text-center bs-wizard-stepnum">Hoàn thành!</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="#" class="bs-wizard-dot"></a>
                </div>

            </div>
            <!-- End bs-wizard -->
        </div>
        <!-- End intro-title -->
    </section>

    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li><a href="#">Thanh toán</a>
                    </li>
                    <li>Trạng thái thanh toán</li>
                </ul>
            </div>
        </div>
        <!-- End position -->

        <div class="container margin_60">
            <div class="row">
                <div class="col-lg-8 add_bottom_15">

                    <div class="form_title">
                        <h3><strong><i class="icon-ok"></i></strong>Cảm ơn!</h3>
                        <p>
                            {{ $message }}
                        </p>
                    </div>
                    <div class="step">
                        <p>
                            Bạn đã đặt thành công <b>{{ $payment_log->tour->name }}</b>
                        </p>
                        <p>Cảm ơn quý khách đã tin tưởng sử dụng dịch vụ <b>đặt tour trực tuyến</b> của chúng tôi. Chúng tôi sẽ gửi mail thông báo đến địa chỉ email của bạn</p>
                    </div>
                    <!--End step -->

                    <div class="form_title">
                        <h3><strong><i class="icon-tag-1"></i></strong>Tóm tắt hóa đơn</h3>
                        <p>
                            Tóm tắt thông tin đơn đặt hàng.
                        </p>
                    </div>
                    <div class="step">
                        <table class="table table-striped confirm">
                            <thead>
                            <tr>
                                <th colspan="2">
                                    Tour
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="2" class="text-sm-center">
                                    <strong>{{ $payment_log->tour->name }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Ngày khởi hành</strong>
                                </td>
                                <td>
                                    {{ date("l jS \of F Y", strtotime($payment_log->batch)) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Số người lớn</strong>
                                </td>
                                <td>
                                    {{ $payment_log->adult_count }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Số trẻ em</strong>
                                </td>
                                <td>
                                    {{ $payment_log->child_count }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Phương thức thanh toán</strong>
                                </td>
                                <td>
                                    VNPay
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--End step -->
                </div>
                <!--End col -->

                <aside class="col-lg-4">
                    <div class="box_style_1">
                        <h3 class="inner">Cảm ơn!</h3>
                        {{ $message }}
                        <hr>
                        <a class="btn_full_outline" href="invoice.html" target="_blank">View your invoice</a>
                    </div>
                    <div class="box_style_4">
                        <i class="icon_set_1_icon-89"></i>
                        <h4>Bạn có thắc mắc về <span>Tour?</span></h4>
                        <a href="{{ 'tel://'.$payment_log->tour->guide->phone }}" class="phone">{{ $payment_log->tour->guide->phone }}</a>
                    </div>
                </aside>

            </div>
            <!--End row -->
        </div>
        <!--End container -->
    </main>
@endsection

