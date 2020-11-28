@extends('layouts.main.app')

@section('title', 'Xem trước')

@section('extra-js')
    <script>
        ps = new PerfectScrollbar('.scroll-service', {
            wheelSpeed: 2,
            wheelPropagation: true,
            minScrollbarLength: 20
        });
    </script>
@endsection

@section('content')
    <section id="hero_2">
        <div class="intro_title">
            <h1>Place your order</h1>
            <div class="bs-wizard row">

                <div class="col-4 bs-wizard-step active">
                    <div class="text-center bs-wizard-stepnum">Xem trước</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="#" class="bs-wizard-dot"></a>
                </div>

                <div class="col-4 bs-wizard-step disabled">
                    <div class="text-center bs-wizard-stepnum">Chi tiết</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="#" class="bs-wizard-dot"></a>
                </div>

                <div class="col-4 bs-wizard-step disabled">
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
    <!-- End Section hero_2 -->
    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">Trang chủ</a>
                    </li>
                    <li><a href="#">Thanh toán</a>
                    </li>
                    <li>Xem trước</li>
                </ul>
            </div>
        </div>
        <!-- End position -->
        <div class="container margin_60">
            @if(!empty($error))
                <div class="alert alert-danger" role="alert">
                    {!! $error !!}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8">
                    <table class="table table-striped cart-list add_bottom_30">
                        <thead>
                        <tr>
                            <th>
                                Tour
                            </th>
                            <th>
                                Ngày khởi hành
                            </th>
                            <th>
                                Giá
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="thumb_cart">
                                    <img src="{{ $tour['thumbnail'] }}" alt="Image">
                                </div>
                                <span class="item_cart">{{ $tour['name'] }}</span>
                            </td>
                            <td>
                                {{ $tour['date'] }}
                            </td>
                            <td>
                                <strong>{{ $tour['adult_price'] }}</strong>
                            </td>
                            <td class="options">
                                <a href="{{ route('Main.tour.index') }}"><i class=" icon-trash"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped options_cart">
                        <thead>
                        <tr>
                            <th colspan="3">
                                Dịch vụ Tour cung cấp.
                            </th>
                        </tr>
                        </thead>
                        <tbody class="scroll-service">
                            <tr>
                                <td style="width:10%">
                                    <i class="'hihi'"></i>
                                </td>
                                <td style="width:60%">
                                    oke
                                </td>
                                <td style="width:35%">
                                    <label class="switch-light switch-ios float-right">
                                        <input type="checkbox" disabled="disabled" name="option_1" id="option_1" checked value="">
                                        <span>
                                    <span>No</span>
                                    <span>Yes</span>
                                    </span>
                                        <a></a>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="add_bottom_15"><small>* Prices for person.</small>
                    </div>
                </div>
                <!-- End col-md-8 -->

                <aside class="col-lg-4" id="sidebar">
                    <div class="theiaStickySidebar">
                        <div class="box_style_1">
                            <h3 class="inner">- Tóm lược -</h3>
                            <table class="table table_summary">
                                <tbody>
                                <tr>
                                    <td>
                                        Adults
                                    </td>
                                    <td class="text-right">
                                        2
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Children
                                    </td>
                                    <td class="text-right">
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Dedicated tour guide
                                    </td>
                                    <td class="text-right">
                                        $34
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Insurance
                                    </td>
                                    <td class="text-right">
                                        $34
                                    </td>
                                </tr>
                                <tr class="total">
                                    <td>
                                        Total cost
                                    </td>
                                    <td class="text-right">
                                        $154
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <a class="btn_full" href="{{ route('checkout.detail', ['id' => $tour['id'], 'date' => $tour['date']]) }}">Thanh toán</a>
                            <a class="btn_full_outline" href="{{ route('Main.tour.index') }}"><i class="icon-right"></i> Quay lại</a>
                        </div>
                    </div>
                    <!-- End sitcky -->
                </aside>
                <!-- End aside -->

            </div>
            <!--End row -->
        </div>
        <!--End container -->
    </main>
@endsection

