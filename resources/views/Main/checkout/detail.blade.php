@extends('layouts.Main.app')

@section('title', 'Chi tiết thanh toán')

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

                <div class="col-4 bs-wizard-step active">
                    <div class="text-center bs-wizard-stepnum">Chi tiết thanh toán</div>
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

    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li><a href="#">Thanh toán</a>
                    </li>
                    <li>Chi tiết thanh toán</li>
                </ul>
            </div>
        </div>
        <!-- End position -->


        <div class="container margin_60">
            @if(session()->has(TOASTR))
                <div class="col-lg-12 alert alert-danger">{{ json_decode(session(TOASTR))->content }}</div>
            @endif
            @isset($error)
                <div class="alert alert-danger" role="alert">{!! $error !!}</div>
            @endisset
            <form class="row" id="js-form-payment" method="post" action="{{ route('checkout.payment') }}">
                @csrf
                <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                <div class="col-lg-8 add_bottom_15">
                    <div class="form_title">
                        <h3><strong>1</strong>Thông tin cá nhân</h3>
                        <p>
                            Vui lòng điền đẩy đủ thông tin của bạn để xác thực đặt Tour.
                        </p>
                    </div>
                    <div class="step">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Họ tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="firstname_booking" value="{{ Auth::check() ? Auth::user()->getFullName() : old('customer_name') }}" name="customer_name">
                                    @error('customer_name')
                                        <small class="text-sm-left text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="tel" id="customer_phone" name="customer_phone" value="{{ Auth::check() ? Auth::user()->phone : old('customer_phone') }}" class="form-control @error('customer_phone') is-invalid @enderror">
                                    @error('customer_phone')
                                    <small class="text-sm-left text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Địa chỉ email <span class="text-danger">*</span></label>
                                    <input type="email" id="email_booking" name="customer_email" value="{{ Auth::check() ? Auth::user()->email : old('customer_email') }}" class="form-control @error('customer_email') is-invalid @enderror">
                                    @error('customer_email')
                                    <small class="text-sm-left text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Xác thưc lại email</label>
                                    <input type="email" id="email_booking_2" name="customer_email_confirm" value="{{ old('customer_email_confirm') }}" class="form-control @error('customer_email_confirm') is-invalid @enderror">
                                    @error('customer_email_confirm')
                                    <small class="text-sm-left text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End step -->

                    <div class="form_title">
                        <h3><strong>2</strong>Địa chỉ</h3>
                        <p>
                            Vui lòng cung cấp chính xác thông tin địa chỉ của bạn.
                        </p>
                    </div>
                    <div class="step">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" name="country" id="country">
                                        <option value="VN" selected>Việt Nam</option>
                                        <option value="US">United states</option>
                                    </select>
                                    @error('country')
                                    <small class="text-sm-left text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" id="street_1" name="customer_address" value="{{ Auth::check() ? Auth::user()->address : old('customer_address') }}" class="form-control">
                                    @error('customer_address')
                                    <small class="text-sm-left text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Thành phố</label>
                                    <input type="text" id="city_booking" name="city" value="{{ Auth::check() ? Auth::user()->city : old('city') }}" class="form-control">
                                    @error('city')
                                    <small class="text-sm-left text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Quận/huyện</label>
                                    <input type="text" id="state_booking" name="state" value="{{ Auth::check() ? Auth::user()->state : old('state') }}" class="form-control">
                                    @error('state')
                                    <small class="text-sm-left text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Mã zip</label>
                                    <input type="text" id="postal_code" name="zipcode" value="{{ Auth::check() ? Auth::user()->zipcode : old('zipcode') }}" class="form-control">
                                    @error('zipcode')
                                    <small class="text-sm-left text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--End row -->
                    </div>
                    <!--End step -->

                    <div class="form_title">
                        <h3><strong>3</strong>Điều khoản và chính sách</h3>
                        <p>
                            Vui lòng đọc chi tiết chính sách hủy chuyến và hoàn tiền.
                        </p>
                    </div>
                    <div id="policy">
                        <div class="form-group">
                            <label>
                                <input type="checkbox" {{ old('policy_terms') ? 'checked' : '' }} name="policy_terms" id="policy_terms"> Tôi chấp nhận các điều khoản, điều kiện và
                                <a href="#cancel-policy" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="cancel-policy" data-parent="#cancel-policy">chính sách hủy chuyến</a>
                                .</label>
                            @error('policy_terms')
                            <small class="text-sm-left text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div id="cancel-policy">
                            <div class="card card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Thời gian</th>
                                        <th scope="col">Phần trăm hoàn trả</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cancel_policies as $key => $policy)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $policy->name }}</td>
                                            <td>{{ $policy->refunds }}%</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="submit" class="btn_1 btn-primary medium">Đặt ngay</button>
                    </div>
                </div>

                <aside class="col-lg-4">
                    <div class="box_style_1 expose" style="position: sticky; top: 100px">
                        <h3 class="inner">- Đặt lịch -</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <span>Khởi hành : </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select name="batch" class="form-control @error('batch') input-invalid @enderror" id="js-tour-batch">
                                        @foreach($tour->batches as $batch)
                                            <option value="{{ $batch->batch }}">{{ date('d-m-Y', strtotime($batch->batch)) }}</option>
                                        @endforeach
                                    </select>
                                    @error('batch')
                                    <small class="text-sm-left text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <span>Số hành khách hiện tại : </span>
                            </div>
                            <div class="col-sm-6">
                                <b id="customer_total">{{ $customer_total }}</b>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Người lớn</label>
                                    <div class="numbers-row">
                                        <input type="text" value="{{ old('adult_count') ? old('adult_count') : 0 }}" id="adults" class="qty2 form-control bg-white" name="adult_count">
                                        @error('adult_count')
                                        <small class="text-sm-left text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Trẻ em</label>
                                    <div class="numbers-row">
                                        <input type="text" value="{{ old('child_count') ? old('child_count') : 0 }}" id="children" class="qty2 form-control bg-white" name="child_count">
                                        @error('child_count')
                                        <small class="text-sm-left text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table class="table table_summary">
                            <tbody>
                            <tr>
                                <td>
                                    Người lớn
                                </td>
                                <td class="text-right">
                                    <span class="text-danger">{{ $tour->adult_price }}</span>
                                    x
                                    <span class="person-adult">0</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Trẻ em
                                </td>
                                <td class="text-right">
                                    <span class="text-danger">{{ $tour->child_price }}</span>
                                    x
                                    <span class="person-child">0</span>
                                </td>
                            </tr>
                            <tr class="total">
                                <td>
                                    Tổng tiền
                                </td>
                                <td class="text-right" id="total-price">
                                    0 đ
                                </td>
                            </tr>
                            <tr class="total">
                                <td>
                                    Đặt cọc
                                </td>
                                <td class="text-right" id="deposit-price">
                                    0 đ
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <button class="btn_full" type="submit">Đặt ngay</button>
                        <a @if(!auth()->guest()) onclick="Main.addToWishlist({{$tour->id}})" @else onclick="Toastr.show({'status': 'error', 'content': 'Bạn cần phải đăng nhập'})" @endif class="btn_full_outline" href="javascript:void(0)"><i class=" icon-heart"></i> Yêu thích</a>
                    </div>

                </aside>

            </form>
            <!--End row -->
        </div>
        <!--End container -->
    </main>
@endsection

@section('extra-js')
    <!-- Date and time pickers -->
    <script>
        $('input.date-pick').datepicker('setDate', 'today');
        $('input.time-pick').timepicker({
            minuteStep: 15,
            showInpunts: false
        })
    </script>

    <script>
        function realPrice() {
            let adult_price = parseFloat({{ $tour->adult_price->getAmount() }}) ;
            let child_price = {{ $tour->child_price->getAmount() }};
            let adults = $('input#adults').val()
            let children = $('input#children').val()
            let total_price = (adult_price * adults) + (child_price * children);
            $('.person-adult').text(adults)
            $('.person-child').text(children)
            $('#total-price').text(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(total_price))
            $('#deposit-price').text(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(total_price * 30/100))
        }
        $('.numbers-row').on('click', function () {
            realPrice()
        })
        $(document).ready(function () {
            realPrice()
        })

        $(`select[name='start_date']`).change(function (){
            let tour_id = {{ $tour->id }};
            let start_date = $(this).val();
            let customer_total = document.querySelector('#customer_total');
            $.ajax({
                url: `{{ route('api-customer-total') }}`,
                method: "GET",
                data: {
                    tour_id: tour_id,
                    start_date: start_date,
                }
            }).done(function (res) {
                customer_total.textContent = res.customer_total;
            })
        })
    </script>

    <script>
        function checkExistTour(batch) {
            fetch(`${BASE_URL}/checkout/check-tour-exist/{{{ $tour->id }}}/${batch}`, {
                method: 'GET', // *GET, POST, PUT, DELETE, etc.
                mode: 'cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: 'same-origin', // include, *same-origin, omit

                redirect: 'follow', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            })
                .then((r) => {
                    if (r.status === 409) {
                        Toastr.show({status: 'warning', title: 'Trùng ngày khởi hành', content: `Bạn đã đặt <b>Tour</b> này trùng ngày khởi hành đã chọn: ${batch}`})
                    }
                })
                .catch((e) => console.log(e));
        }

        $(document).ready(function () {
            checkExistTour($('#js-tour-batch').val())
        })
        $('#js-tour-batch').on('change', function () {
            checkExistTour($('#js-tour-batch').val())
        })
    </script>

@endsection
