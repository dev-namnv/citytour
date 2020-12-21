@extends('layouts.manager.app')

@section('title','Invoice - ' . $invoice->sku)

@section('extra-css')
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('Libraries/Manager/assets/css/apps/invoice.css') }}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
@endsection

@section('extra-js')
    <script src="{{ asset('Libraries/Manager/assets/js/apps/invoice.js') }}"></script>
@endsection

@section('content')
    <div class="container">

        <div class="invoice-container bg-white p-3">
            <div class="invoice-inbox">

                <div class="content-section">

                    <div class="row">
                        @if(Auth::user()->role == GUIDE)
                            @if($invoice->status >= 5)
                                <div class="col-12 text-center">
                                    <span class="col-12 d-block rounded p-3 {{ $invoice->getColor() }}">
                                        <strong>{{ $invoice->getStatus() }}</strong>
                                    </span>
                                </div>
                            @endif
                            @if($invoice->status < 4 )
                                @php $next_status = $invoice->status +1 @endphp
                                <div class="col-12">
                                    <a href="{{route('invoice-update-status',['sku'=>$invoice->sku,'status'=>$next_status])}}" class="col-12 btn {{ config('masterdata')['invoice']['color'][$next_status] }}">
                                        <strong>{{ config('masterdata')['invoice']['status'][$next_status] }}</strong>
                                        <i style="color: green" class="fas fa-bullseye"></i>
                                    </a>
                                </div>
                            @elseif($invoice->status == 4)
                                <div class="col-12 text-center">
                                    <span class="col-12 d-block rounded p-3 {{ config('masterdata')['invoice']['color'][5] }}-o-80">
                                        <strong>Chờ {{ config('masterdata')['invoice']['status'][5] }}</strong>
                                    </span>
                                </div>
                            @endif
                        @else
                            @if($invoice->status < 5 || $invoice->status == 6)
                                <div class="col-12 text-center">
                                    <p class="col-12 d-block rounded p-3 {{ $invoice->getColor() }}">
                                        <strong>{{ $invoice->getStatus()}}</strong>
                                    </p>
                                </div>
                            @else
                                <div class="col-12 text-center">
                                    <a href="{{route('invoice-update-status',['sku'=>$invoice->sku,'status'=>6])}}" class="col-12 btn {{ config('masterdata')['invoice']['color'][6] }}-o-80">
                                        <strong>{{ config('masterdata')['invoice']['status'][6] }}</strong>
                                        <i style="color: green" class="fas fa-bullseye"></i>
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>

                    <hr/>

                    <div class="row inv--head-section">

                        <div class="col-sm-6 col-12">
                            <h3 class="in-heading">Hóa Đơn</h3>
                        </div>
                        <div class="col-sm-6 col-12 align-self-center text-sm-right">
                            <div class="company-info">
                                <img src="{{ asset('Libraries/Main/img/logo_sticky.png') }}"/>
                            </div>
                        </div>

                    </div>

                    <div class="row inv--detail-section">
                        <div class="col-sm-7 align-self-center">
                            <p class="inv-customer-name">Tên khách hàng: {{ $invoice->customer_name }}</p>
                            <p class="inv-street-addr">Địa chỉ: {{ $invoice->customer_address }}</p>
                            @if(!empty($invoice->customer_email))
                                <p class="inv-email-address">Email: {{ $invoice->customer_email }}</p>
                            @endif
                            <p class="inv-email-address">Số điện thoại: {{ $invoice->customer_phone }}</p>
                        </div>
                        <div class="col-sm-5 align-self-center  text-sm-right order-2">
                            <p class="inv-list-number"><span class="inv-title">Invoice Number : </span> <span class="inv-number">{{ $invoice->sku }}</span></p>
                            <p class="inv-created-date"><span class="inv-title">Ngày tạo : </span> <span class="inv-date">{{ \Carbon\Carbon::parse($invoice->created_at)->format('H:i:s - d/m/Y') }}</span></p>
                            <p class="inv-due-date"><span class="inv-title">Cập nhật lần cuối : </span> <span class="inv-date">{{ \Carbon\Carbon::parse($invoice->updated_at)->format('H:i:s - d/m/Y') }}</span></p>
                        </div>
                    </div>

                    <div class="row inv--product-table-section">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="">
                                    <tr>
                                        <th scope="col">Tour Du Lịch</th>
                                        <th scope="col">Người Hướng Dẫn</th>
                                        <th scope="col">Ngày khởi hành</th>
                                        <th class="text-right" scope="col">Số người</th>
                                        <th class="text-right" scope="col">Giá Tiền</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <a href="{{ route('invoice-schedule',['sku'=>$invoice->sku]) }}" target="_blank" class="text-primary">{{ $invoice->invoice_detail->name }}</a>
                                        </td>
                                        <td>{{ $invoice->guide->first_name .' '. $invoice->guide->last_name }}</td>
                                        <td>{{ date_format(new DateTime($invoice->start_date),'d-m-Y') }}</td>
                                        <td class="text-right">
                                            <span class="d-block">Người lớn:</span>
                                            <span class="text-info">{{ $invoice->adult_count }}</span>
                                            <br/>
                                            <span class="d-block">Trẻ em:</span>
                                            <span class="text-info">{{ $invoice->child_count }}</span>
                                        </td>
                                        <td class="text-right">
                                            <span class="d-block">Người lớn:</span>
                                            <span class="text-danger">{{ number_format($invoice->invoice_detail->adult_price->getAmount() * $invoice->adult_count) }}</span>
                                            <br/>
                                            <span class="d-block">Trẻ em:</span>
                                            <span class="text-danger">{{ number_format($invoice->invoice_detail->child_price->getAmount() * $invoice->child_count) }}</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row mt-4">
                        <div class="col-sm-5 col-12 order-sm-0 order-1">
                            <div class="inv--payment-info">
                                <div class="row">
                                    <div class="col-sm-12 col-12">
                                        <h6 class=" inv-title">Thông tin thanh toán:</h6>
                                    </div>
                                    <div class="col-sm-4 col-12">
                                        <p class=" inv-subtitle">Phương thức thanh toán: </p>
                                    </div>
                                    <div class="col-sm-8 col-12">
                                        <p class="">{{ $invoice->payment_type }}</p>
                                    </div>
                                    <div class="col-sm-4 col-12">
                                        <p class=" inv-subtitle">Mã thanh toán : </p>
                                    </div>
                                    <div class="col-sm-8 col-12">
                                        <p class="">{{ $invoice->payment_code }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7 col-12 order-sm-1 order-0">
                            <div class="inv--total-amounts text-sm-right">
                                <div class="row">
                                    <div class="col-sm-8 col-7">
                                        <p class="">Tổng: </p>
                                    </div>
                                    <div class="col-sm-4 col-5">
                                        <p class="text-danger font-size-h4">{{ $invoice->sub_cost }}</p>
                                    </div>
                                    <div class="col-sm-8 col-7">
                                        <p class="">VAT: </p>
                                    </div>
                                    <div class="col-sm-4 col-5">
                                        <p class="text-danger font-size-h5">{{ $invoice->vat_cost }}</p>
                                    </div>
                                    <div class="col-sm-8 col-7 grand-total-title">
                                        <h4 class="">Tổng thanh toán : </h4>
                                    </div>
                                    <div class="col-sm-4 col-5 grand-total-amount">
                                        <h4 class="text-white bg-danger p-2 font-size-h3">
                                            <trong>{{ $invoice->total_cost }}</trong>
                                        </h4>
                                    </div>
                                    <div class="col-sm-8 col-7">
                                        <p class=" discount-rate">Đã thanh toán :
                                            <span class="discount-percentage">30%</span>
                                        </p>
                                    </div>
                                    <div class="col-sm-4 col-5">
                                        <strong class="text-danger font-size-h4">{{ $invoice->deposit_cost }}</strong>
                                    </div>
                                    <div class="col-sm-8 col-7">
                                        <p class=" discount-rate">Còn thiếu :
                                            <span class="discount-percentage">70%</span>
                                        </p>
                                    </div>
                                    <div class="col-sm-4 col-5">
                                        <strong class="text-danger font-size-h4">{{ number_format($invoice->total_cost->getAmount() - $invoice->deposit_cost->getAmount()) }} đ</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <p>Chú ý:
                        <span>Quý khách hàng sẽ thanh toán <i class="text-danger">{{ number_format($invoice->total_cost->getAmount() - $invoice->deposit_cost->getAmount()) }} đ</i> (tương đương 70% số tiền còn lại) cho Hướng dẫn viên trước khi chuyến du lịch diễn ra.</span>
                    </p>
                    <span>Được tạo bởi user: {{ $invoice->user->username }}</span>
                    <p>Lịch trình có thể xem tại: <a href="{{ route('invoice-schedule',['sku'=>$invoice->sku]) }}" target="_blank" class="text-primary">Lịch Trình</a></p>
                </div>
            </div>

        </div>
    </div>
@endsection
