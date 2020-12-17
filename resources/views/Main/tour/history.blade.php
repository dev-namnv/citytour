@extends('layouts.main.app')

@section('title', 'Lịch sử')

@section('extra-css')
    <link href="{{asset('libraries/main/css/custom.css')}}" rel="stylesheet">
    <link href="{{ asset('libraries/main/css/timeline.css') }}" rel="stylesheet">

    <style>
        .cbp_tmtimeline:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 5px;
            background: none;
            left: 20%;
            margin-left: -8px;
        }

        .cbp_tmtimeline > li .cbp_tmlabel {
            background: none;
        }

        .cbp_tmtimeline > li .cbp_tmiconFake {
            width: 48px;
            height: 48px;
            font-family: 'fontello';
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            font-size: 24px;
            line-height: 48px;
            -webkit-font-smoothing: antialiased;
            position: absolute;
            color: #53eb93;
            background:#f9f9f9;
            border-radius: 50%;
            box-shadow: 0 0 0 3px #53eb93;
            text-align: center;
            left: 19.6%;
            top: 15%;
            margin: 0 0 0 -25px;
        }

        .cbp_tmtimeline > li .cbp_tmicon {
            width: 48px;
            height: 48px;
            font-family: 'fontello';
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            font-size: 24px;
            line-height: 48px;
            -webkit-font-smoothing: antialiased;
            position: absolute;
            color: #e04f67;
            background:#f9f9f9;
            border-radius: 50%;
            box-shadow: 0 0 0 3px #e04f67;
            text-align: center;
            left: 19.6%;
            top: 15%;
            margin: 0 0 0 -25px;
        }

        .cbp_tmtimeline > li .cbp_tmtime {
            display: block;
            width: 25%;
            padding-right: 100px;
            position: absolute;
            margin-top: 37px;
        }
    </style>
@endsection

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1200,h_630,f_auto/w_80,x_15,y_15,g_south_west,l_klook_water/activities/hsnmkdasrhwmvng1yrht/V%C3%A9%20C%C3%B4ng%20Vi%C3%AAn%20Su%E1%BB%91i%20Kho%C3%A1ng%20N%C3%B3ng%20N%C3%BAi%20Th%E1%BA%A7n%20T%C3%A0i%20%C4%90%C3%A0%20N%E1%BA%B5ng.jpg"
             data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Lịch sử</h1>
            </div>
        </div>
    </section>
    <main style="margin-bottom: 355px;">
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">Home</a>
                    </li>

                    <li>Lịch sử</li>
                </ul>
            </div>
        </div>
        <!-- Position -->
        <div class="container margin_60">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    @if (count($invoices) > 0)
                    @if(today()->toDateString() <= $invoices[0]->end_date && $invoices[0]->status < INVOICE_COMPLETE_CONFIRM)
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Tour hiện tại</h3>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tour-infomation-tab" data-toggle="tab"
                                           href="#home"
                                           role="tab"
                                           aria-controls="home" aria-selected="true">Thông tin tour</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="schedule-tab" data-toggle="tab" href="#profile"
                                           role="tab"
                                           aria-controls="profile" aria-selected="false">Lịch trình</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="invoice-tab" data-toggle="tab" href="#contact"
                                           role="tab"
                                           aria-controls="contact" aria-selected="false">Thông tin thanh toán</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel"
                                         aria-labelledby="tour-infomation-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row justify-content-center">
                                                    <img class="img-fluid" width="900" src="{{$invoices[0]->tour->banner}}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-12 mt-5">
                                                <table class="table table-condensed">
                                                    <tbody>
                                                    <tr>
                                                        <td width="50%" class="text-right"><strong>Tên tour:</strong></td>
                                                        <td>{{$invoices[0]->tour->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><strong>Địa điểm:</strong></td>
                                                        <td>{{$invoices[0]->tour->address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><strong>Hướng dẫn viên:</strong></td>
                                                        <td>{{$invoices[0]->guide->getFullName()}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><strong>Ngày bắt đầu:</strong></td>
                                                        <td>{{date_format(new DateTime($invoices[0]->start_date), 'd-m-Y')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><strong>Ngày kết thúc:</strong></td>
                                                        <td>{{date_format(new DateTime($invoices[0]->end_date), 'd-m-Y')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><strong>Trạng thái:</strong></td>
                                                        <td>
{{--                                                            @if(today()->toDateString() < $invoices[0]->start_date)--}}
{{--                                                                <span class="text-secondary">Sắp khởi hành, còn {{$invoices[0]->calculateDaysDiff()}} ngày</span>--}}
{{--                                                            @elseif(today()->toDateString() <= $invoices[0]->end_date)--}}
{{--                                                                <span class="text-primary">Đang đi</span>--}}
{{--                                                            @else--}}
{{--                                                                <span class="text-success">Đã kết thúc</span>--}}
{{--                                                            @endif--}}
                                                            <span class="text-success">{{$invoices[0]->getStatus()}}</span>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>

                                            @if($invoices[0]->status == 4)
                                                <div class="col-12 mt-5 ">
                                                    <div class="row justify-content-center">
                                                        <h4>Hiện tại, tour đã kết thúc lịch trình. Hãy bấm vào nút <span class="text-success">xác nhận</span> kể hoàn tất bước cuối cùng.</h4>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <form action="{{route('Main.invoice.complete', $invoices[0]->sku)}}" method="POST">
                                                            @csrf
                                                            <button class="btn btn-success">Xác nhận</button>
                                                        </form>
                                                        <div class="ml-2">
                                                            <a href="#Review" class="btn_1 add_bottom_30 review" data-id="{{$invoices[0]->tour->id}}" data-tour="{{$invoices[0]->tour->name}}" data-toggle="modal" data-target="#myReview">Viết đánh giá</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel"
                                         aria-labelledby="schedule-tab">
                                        <ul class="cbp_tmtimeline">
                                            @foreach($invoices[0]->tour->schedules as $key => $schedule)
                                                @if ($key < $invoices[0]->calculateDaysDiff() && $invoices[0]->start_date <= today()->toDateString())
                                                    <li class="blur">
                                                        <time class="cbp_tmtime">
                                                            <span
                                                                style="font-size: 25px">{{$invoices[0]->getDayAddFromStart($key)}}</span>
                                                        </time>
                                                        <div class="cbp_tmiconFake timeline_icon_point"></div>
                                                        <div class="cbp_tmlabel">
                                                            <div class="float-right d-none d-md-block">Hướng dẫn viên
                                                                <strong>{{$invoices[0]->guide->getFullName()}}</strong><img
                                                                    src="{{$invoices[0]->guide->avatar}}" alt="Image"
                                                                    class="rounded-circle speaker">
                                                            </div>
                                                            <h2>
                                                                @if($key == 0)
                                                                    Ngày đầu tiên
                                                                @elseif ($key == count($invoices[0]->tour->schedules) - 1)
                                                                    Ngày cuối cùng
                                                                @else
                                                                    Ngày thứ {{$key+1}}
                                                                @endif
                                                            </h2>
                                                            <p>{{$schedule->description}}</p>
                                                            <img src="{{$schedule->image}}" alt="">
                                                        </div>
                                                    </li>
                                                @else
                                                    <li>
                                                        <time class="cbp_tmtime">
                                                            <span
                                                                style="font-size: 25px">{{$invoices[0]->getDayAddFromStart($key)}}</span>
                                                        </time>
                                                        <div class="cbp_tmicon timeline_icon_point"></div>
                                                        <div class="cbp_tmlabel">
                                                            <div class="float-right d-none d-md-block">Hướng dẫn viên
                                                                <strong>{{$invoices[0]->guide->getFullName()}}</strong><img
                                                                    src="{{$invoices[0]->guide->avatar}}" alt="Image"
                                                                    class="rounded-circle speaker">
                                                            </div>
                                                            <h2>
                                                                @if($key == 0)
                                                                    Ngày đầu tiên
                                                                @elseif ($key == count($invoices[0]->tour->schedules) - 1)
                                                                    Ngày cuối cùng
                                                                @else
                                                                    Ngày thứ {{$key+1}}
                                                                @endif
                                                            </h2>
                                                            <p>{{$schedule->description}}</p>
                                                            <img src="{{$schedule->image}}" alt="">
                                                        </div>
                                                    </li>
                                                @endif

                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel"
                                         aria-labelledby="invoice-tab">
                                        <div class="row">

                                            <div class="col-6">

                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <h3>Thông tin cá nhân</h3>
                                                    </tr>
                                                        <tr>
                                                            <td width="50%"><strong>Họ tên:</strong></td>
                                                            <td>{{$invoices[0]->customer_name}}</td>
                                                        </tr>
                                                    <tr>
                                                        <td><strong>Địa chỉ:</strong></td>
                                                        <td>{{$invoices[0]->customer_address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Email:</strong></td>
                                                        <td>{{$invoices[0]->customer_email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Số điện thoại:</strong></td>
                                                        <td>{{$invoices[0]->customer_phone}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Lời nhắn:</strong></td>
                                                        <td>{{$invoices[0]->customer_message}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Ngày thanh toán:</strong></td>
                                                        <td>{{empty($invoices[0]->created_at) ? null : date_format($invoices[0]->created_at, 'H:i:s m-d-Y')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Trạng thái thanh toán</strong></td>
                                                        <td>
                                                            <span class="text-success">{{$invoices[0]->getStatus()}}</span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-6">
                                                <address>
                                                    <h3>Hình thức thanh toán:</h3><br>
                                                    <strong>Loại thẻ:</strong> Credit card<br>
                                                    <strong>Mã thanh toán:</strong> 5FC3C6A8960CA
                                                </address>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Thông tin chi tiết</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-condensed">
                                                        <thead>
                                                        <tr>
                                                            <td><strong>Tour</strong></td>
                                                            <td class="text-center">
                                                                <strong>Số người lớn</strong>
                                                            </td>
                                                            <td class="text-center">
                                                                <strong>Đơn giá người lớn</strong>
                                                            </td>
                                                            <td class="text-center">
                                                                <strong>Số trẻ em</strong>
                                                            </td>
                                                            <td class="text-center">
                                                                <strong>Đơn giá trẻ em</strong>
                                                            </td>
                                                            <td class="text-right">
                                                                <strong>Giá tour</strong>
                                                            </td>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->

                                                        <tr>
                                                            <td>{{$invoices[0]->tour->name}}</td>
                                                            <td class="text-center">{{$invoices[0]->adult_count}}</td>
                                                            <td class="text-center">{{$invoices[0]->tour->adult_price}}</td>
                                                            <td class="text-center">{{$invoices[0]->child_count}}</td>
                                                            <td class="text-center">{{$invoices[0]->tour->child_price}}</td>
                                                            <td class="text-right">{{$invoices[0]->sub_cost}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line text-right"><strong>Thuế VAT</strong></td>
                                                            <td class="no-line text-right">{{$invoices[0]->vat_cost}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line text-right"><strong>Tổng phải trả</strong></td>
                                                            <td class="no-line text-right">{{$invoices[0]->total_cost}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line text-right"><strong>Số tiền đã đặt cọc</strong></td>
                                                            <td class="no-line text-right">{{$invoices[0]->deposit_cost}}</td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div><!-- End col-md-12-->


                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Các tour đã đi</h3>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên tour</th>
                                    <th>Lịch trình</th>
                                    <th>Hóa đơn</th>
                                    <th>Đánh giá</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(today()->toDateString() <= $invoices[0]->end_date && $invoices[0]->status < INVOICE_COMPLETE_CONFIRM)
                                    @foreach($invoices->reverse()->take(count($invoices) - 1) as $key => $invoice)
                                        <tr>
                                            <td>{{count($invoices->reverse()->take(5)) - $key + 1}}</td>
                                            <td>{{$invoice->tour->name}}</td>
                                            <td>
                                                <a href="{{route('Main.invoice_schedule', $invoice->id)}}"
                                                   target="_blank">Chi tiết</a>
                                            </td>
                                            <td>
                                                <a href="{{route('Main.invoice_detail', $invoice->id)}}"
                                                   target="_blank">Chi tiết</a>
                                            </td>
                                            <td>
                                                <a href="#Review" class="btn_1 bg-success review" data-id="{{$invoice->tour->id}}" data-tour="{{$invoice->tour->name}}" data-toggle="modal" data-target="#myReview">Đánh giá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach($invoices as $key => $invoice)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$invoice->tour->name}}</td>
                                            <td>
                                                <a href="{{route('Main.invoice_schedule', $invoice->id)}}"
                                                   target="_blank">Chi tiết</a>
                                            </td>
                                            <td>
                                                <a href="{{route('Main.invoice_detail', $invoice->id)}}"
                                                   target="_blank">Chi tiết</a>
                                            </td>
                                            <td>
                                                <a href="#Review" class="btn_1 review" data-id="{{$invoice->tour->id}}" data-tour="{{$invoice->tour->name}}" data-toggle="modal" data-target="#myReview">Đánh giá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div><!-- End col-md-12-->
                    </div>
                    @else
                        <h2>Bạn chưa từng đi một tour nào cả !</h2>
                    @endif
                </div>

            </div>
        </div>


        <!-- End container -->
    </main>
    <!--Modal Review-->
    <div class="modal fade" id="myReview" tabindex="-1" role="dialog" aria-labelledby="myReviewLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myReviewLabel">Viết đánh giá</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div id="message-review">
                    </div>
                    <form method="post" action="{{route('Main.tour.review')}}" name="review_tour" id="review_tour">
                        @csrf
                        <div class="row pl-3">
                            <input type="text" name="name" class="border-0 bg-white" disabled>
                            <input type="hidden" name="id">
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Chất lượng dịch vụ</label>
                                    <select class="form-control" name="star" id="position_review">
                                        <option value="10">10 điểm</option>
                                        <option value="9">9 điểm</option>
                                        <option value="8">8 điểm</option>
                                        <option value="7">7 điểm</option>
                                        <option value="6">6 điểm</option>
                                        <option value="5">5 điểm</option>
                                        <option value="4">4 điểm</option>
                                        <option value="3">3 điểm</option>
                                        <option value="2">2 điểm</option>
                                        <option value="1">1 điểm</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End row -->
                        <div class="form-group">
                            <textarea name="review_text" id="review_text" class="form-control" style="height:100px" placeholder="Nội dung"></textarea>
                        </div>
                        <input type="submit" value="Gửi đi" class="btn_1" id="submit-review">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script>
        $(document).ready(function (){
            $(`.review`).click(function (){
                let tour = $(this).data('tour')
                let id = $(this).data('id')
                let input_name = $(`input[name='name']`).val(tour)
                let input_id = $(`input[name='id']`).val(id)
            })
        })
    </script>
@endsection
