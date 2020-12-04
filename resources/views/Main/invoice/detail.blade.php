<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link href="{{ asset('libraries/main/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('libraries/main/css/vendors.css') }}" rel="stylesheet">

<!-- CUSTOM CSS -->
<link href="{{ asset('libraries/main/css/custom.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="invoice-title">
                <h2>Hóa đơn</h2><h3 class="pull-right">Đơn hàng # {{$invoice->id}}</h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <address>
                        <h3>Thông tin người thanh toán:</h3><br>
                        <strong>Họ tên:</strong> {{$invoice->customer_name}}<br>
                        <strong>Địa chỉ:</strong> {{$invoice->customer_address}}<br>
                        <strong>Email:</strong> {{$invoice->customer_email}}<br>
                        <strong>Số điện thoại:</strong> {{$invoice->customer_phone}} <br>
                        <strong>Lời nhắn:</strong> {{$invoice->customer_message}} <br>
                        <strong>Ngày thanh toán:</strong> {{empty($invoice->created_at) ? null : date_format($invoice->created_at, 'H:i:s m-d-Y')}}
                    </address>
                </div>
                <div class="col-6">
                    <address>
                        <h3>Hình thức thanh toán:</h3><br>
                        <strong>Loại thẻ:</strong> {{$invoice->payment_type}}<br>
                        <strong>Mã thanh toán:</strong> {{$invoice->payment_code}}
                    </address>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Thông tin chi tiết</strong></h3>
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
                                <td>{{$invoice->tour->name}}</td>
                                <td class="text-center">{{$invoice->adult_count}}</td>
                                <td class="text-center">{{$invoice->tour->adult_price}}</td>
                                <td class="text-center">{{$invoice->child_count}}</td>
                                <td class="text-center">{{$invoice->tour->child_price}}</td>
                                <td class="text-right">{{$invoice->sub_cost}}</td>
                            </tr>

                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-right"><strong>Thuế VAT</strong></td>
                                <td class="no-line text-right">{{$invoice->vat_cost}}</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-right"><strong>Tổng phải trả</strong></td>
                                <td class="no-line text-right">{{$invoice->total_cost}}</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-right"><strong>Số tiền đã đặt cọc</strong></td>
                                <td class="no-line text-right">{{$invoice->deposit_cost}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
