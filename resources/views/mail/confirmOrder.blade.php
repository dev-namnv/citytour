<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <div class="container">
    <div class="invoice-container bg-white p-3">
        <div class="invoice-inbox">
            <div class="content-section">
                <div class="row inv--head-section">
                    <div class="col-sm-6 col-12">
                        <h3 class="in-heading">Hóa Đơn</h3>
                    </div>
                </div>

                <div class="row inv--detail-section">
                    <div class="col-sm-7 align-self-center">
                        <p class="inv-customer-name">Tên khách hàng: {!! $customer_name !!}</p>
                        <p class="inv-street-addr">Địa chỉ: {!! $customer_address !!}</p>
                        <p class="inv-email-address">Số điện thoại: {!! $customer_phone !!}</p>
                    </div>
                    <div class="col-sm-5 align-self-center  text-sm-right order-2">
                        <p class="inv-list-number"><span class="inv-title">Invoice Number : </span> <span class="inv-number">{!! $sku !!}</span></p>
                        <p class="inv-created-date"><span class="inv-title">Ngày tạo : </span> <span class="inv-date">{!! $created_at !!}</span></p>
                        <p class="inv-due-date"><span class="inv-title">Cập nhật lần cuối : </span> <span class="inv-date">{!! $updated_at !!}</span></p>
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
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        {!! $invoice_detail['name'] !!}
                                    </td>
                                    <td>{!! $guide['first_name'] .' '. $guide['last_name'] !!}</td>
                                    <td>{!! $invoice_detail['address'] !!}</td>
                                    <td class="text-right">
                                        <span class="d-block">Người lớn:</span>
                                        <span class="text-info">{!! $adult_count !!}</span>
                                        <br/>
                                        <span class="d-block">Trẻ em:</span>
                                        <span class="text-info">{!! $child_count !!}</span>
                                    </td>
                                    <td class="text-right">
                                        <span class="d-block">Người lớn:</span>
                                        <span class="text-danger">{!! number_format($invoice_detail['adult_price']['amount'] * $adult_count) !!}</span>
                                        <br/>
                                        <span class="d-block">Trẻ em:</span>
                                        <span class="text-danger">{!! number_format($invoice_detail['child_price']['amount'] * $child_count) !!}</span>
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
                                    <p class="">{!! $payment_type !!}</p>
                                </div>
                                <div class="col-sm-4 col-12">
                                    <p class=" inv-subtitle">Mã thanh toán : </p>
                                </div>
                                <div class="col-sm-8 col-12">
                                    <p class="">{!! $payment_code !!}</p>
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
                                    <p class="text-danger font-size-h4">{!! $sub_cost['amount'] !!}</p>
                                </div>
                                <div class="col-sm-8 col-7">
                                    <p class="">VAT: </p>
                                </div>
                                <div class="col-sm-4 col-5">
                                    <p class="text-danger font-size-h5">{!! $vat_cost['amount'] !!}</p>
                                </div>
                                <div class="col-sm-8 col-7 grand-total-title">
                                    <h4 class="">Tổng thanh toán : </h4>
                                </div>
                                <div class="col-sm-4 col-5 grand-total-amount">
                                    <h4 class="text-white bg-danger p-2 font-size-h3">
                                        <trong>{!! $total_cost['amount'] !!}</trong>
                                    </h4>
                                </div>
                                <div class="col-sm-8 col-7">
                                    <p class=" discount-rate">Đã thanh toán :
                                        <span class="discount-percentage">30%</span>
                                    </p>
                                </div>
                                <div class="col-sm-4 col-5">
                                    <strong class="text-danger font-size-h4">{!! $deposit_cost['amount'] !!}</strong>
                                </div>
                                <div class="col-sm-8 col-7">
                                    <p class=" discount-rate">Còn thiếu :
                                        <span class="discount-percentage">70%</span>
                                    </p>
                                </div>
                                <div class="col-sm-4 col-5">
                                    <strong class="text-danger font-size-h4">{!! number_format($total_cost['amount'] - $deposit_cost['amount']) !!} đ</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <p>Chú ý:
                    <span>Quý khách hàng sẽ thanh toán <i class="text-danger">{!! number_format($total_cost['amount'] - $deposit_cost['amount']) !!} đ</i> (tương đương 70% số tiền còn lại) cho Hướng dẫn viên trước khi chuyến du lịch diễn ra.</span>
                </p>
                <p>Lịch trình có thể xem tại: <a href="{!! route('invoice-schedule',['sku'=>$sku]) !!}" target="_blank" class="text-primary">Lịch Trình</a></p>
            </div>
        </div>
    </div>
</div>
