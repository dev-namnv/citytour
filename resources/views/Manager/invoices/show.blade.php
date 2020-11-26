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
                            <p class="inv-created-date"><span class="inv-title">Ngày tạo : </span> <span class="inv-date">{{ $invoice->created_at }}</span></p>
                            <p class="inv-due-date"><span class="inv-title">Cập nhật lần cuối : </span> <span class="inv-date">{{ $invoice->updated_at }}</span></p>
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
                                        <th scope="col">Địa Chỉ</th>
                                        <th class="text-right" scope="col">Số người</th>
                                        <th class="text-right" scope="col">Giá Tiền</th>
                                        <th class="text-right" scope="col">Ngày bắt đầu</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $invoice->invoice_detail->name }}</td>
                                        <td>{{ $invoice->guide->first_name .' '. $invoice->guide->last_name }}</td>
                                        <td>{{ $invoice->invoice_detail->address }}</td>
                                        <td class="text-right">
                                            <span class="d-block">Người lớn:</span>
                                            <span class="text-danger">{{ $invoice->adult_count }}</span>
                                            <br/>
                                            <span class="d-block">Trẻ em:</span>
                                            <span class="text-danger">{{ $invoice->child_count }}</span>
                                        </td>
                                        <td class="text-right">
                                            <span class="d-block">Người lớn:</span>
                                            <span class="text-danger">{{ number_format($invoice->invoice_detail->adult_price->getAmount() * $invoice->adult_count) }}</span>
                                            <br/>
                                            <span class="d-block">Trẻ em:</span>
                                            <span class="text-danger">{{ number_format($invoice->invoice_detail->child_price->getAmount() * $invoice->child_count) }}</span>
                                        </td>
                                        <td class="text-right">{{ $invoice->start_date }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-5 col-12 order-sm-0 order-1">
                            <div class="inv--payment-info">
                                <div class="row">
                                    <div class="col-sm-12 col-12">
                                        <h6 class=" inv-title">Thông tin thanh toán:</h6>
                                    </div>
                                    <div class="col-sm-4 col-12">
                                        <p class=" inv-subtitle">Tên ngân hàng: </p>
                                    </div>
                                    <div class="col-sm-8 col-12">
                                        <p class="">Bank of America</p>
                                    </div>
                                    <div class="col-sm-4 col-12">
                                        <p class=" inv-subtitle">Account Number : </p>
                                    </div>
                                    <div class="col-sm-8 col-12">
                                        <p class="">1234567890</p>
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
                                        <p class="">{{ $invoice->sub_cost }}</p>
                                    </div>
                                    <div class="col-sm-8 col-7">
                                        <p class="">VAT: </p>
                                    </div>
                                    <div class="col-sm-4 col-5">
                                        <p class="">{{ $invoice->vat_cost }}</p>
                                    </div>
                                    <div class="col-sm-8 col-7 grand-total-title">
                                        <h4 class="">Tổng thanh toán : </h4>
                                    </div>
                                    <div class="col-sm-4 col-5 grand-total-amount">
                                        <h4 class="text-danger">{{ $invoice->total_cost }}</h4>
                                    </div>
                                    <div class="col-sm-8 col-7">
                                        <p class=" discount-rate">Đã thanh toán :
                                            <span class="discount-percentage">30%</span>
                                        </p>
                                    </div>
                                    <div class="col-sm-4 col-5">
                                        <p class="">{{ $invoice->deposit_cost }}</p>
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
                    <p>Lịch trình có thể xem tại: <a href="#" class="text-primary">Lịch Trình</a></p>
                </div>
            </div>

        </div>
    </div>
@endsection
