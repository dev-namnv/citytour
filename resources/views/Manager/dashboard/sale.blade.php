@extends('layouts.manager.app')

@section('title', 'Sale')

@section('content')
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="row">
            <div class="col-lg-8 col-xxl-8">
                <!--begin::Mixed Widget 1-->
                <div class="card card-custom bg-gray-100 card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 bg-danger py-5">
                        <h3 class="card-title font-weight-bolder text-white">Truy cập nhanh</h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body p-0 position-relative overflow-hidden">
                        <!--begin::Chart-->
                        <div id="kt_mixed_widget_1_chart" class="card-rounded-bottom bg-danger" style="height: 200px"></div>
                        <!--end::Chart-->
                        <!--begin::Stats-->
                        <div class="card-spacer mt-n25">
                            <!--begin::Row-->
                            <div class="row m-0">
                                <div class="col bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
															<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24" />
																		<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
																		<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
																		<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
																		<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
                                    <a href="#" class="text-warning font-weight-bold font-size-h6">{{ auth()->user()->getTotalIncome() }}</a>
                                </div>
                                <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"/>
                                            <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L12.5,10 C13.3284271,10 14,10.6715729 14,11.5 C14,12.3284271 13.3284271,13 12.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg>
                                </span>
                                    <a href="{{ route('articles.index') }}" class="text-primary font-weight-bold font-size-h6 mt-2">Bài viết</a>
                                </div>
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row m-0">
                                <div class="col bg-light-danger px-6 py-8 rounded-xl mr-7">
                                    <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                    </span>
                                    <a href="{{ route('invoice-list') }}" class="text-danger font-weight-bold font-size-h6 mt-2">{{ $invoices->count() }} hóa đơn</a>
                                </div>
                                <div class="col bg-light-success px-6 py-8 rounded-xl">
                                    <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z" fill="#000000" opacity="0.3"/>
                                                <path d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                    </span>
                                    <a href="{{ route('calendar') }}" class="text-success font-weight-bold font-size-h6 mt-2">Thời gian biểu</a>
                                </div>
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Mixed Widget 1-->
            </div>
            <div class="col-lg-4 col-xxl-4">
                <!--begin::List Widget 8-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0">
                        <h3 class="card-title font-weight-bolder text-dark">Hoạt động</h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0">
                        <!--begin::Item-->
                        @php($keyActivity = 0)
                        @foreach($invoices as $invoice)
                            @php($keyActivity ++)
                            @if ($keyActivity <= 4)
                                <div class="mb-10">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light mr-5">
                                    <span class="symbol-label">
                                        <img src="{{ $invoice->tour->thumbnail }}" class="h-50 align-self-center" alt="" />
                                    </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a href="{{ route('invoice-show', ['sku' => $invoice->sku]) }}" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">
                                                {{ $invoice->user->getFullName() }} đã đặt Tour
                                            </a>
                                            <span class="text-muted font-weight-bold">{{ \Carbon\Carbon::parse($invoice->created_at)->fromNow() }}</span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Desc-->
                                    <p class="text-dark-50 m-0 pt-5 font-weight-normal">
                                        {{ $invoice->user->getFullName() }} đã đặt {{ \Illuminate\Support\Str::limit($invoice->tour->name, 100) }} @if(auth()->user()->role === GUIDE) của bạn @endif
                                    </p>
                                    <!--end::Desc-->
                                </div>
                            @endif
                        @endforeach
                        <!--end::Item-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end: Card-->
                <!--end::List Widget 8-->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xxl-4">
                <!--begin::Stats Widget 11-->
                <div class="card card-stretch card-stretch-half gutter-b">
                    <!--begin::Body-->
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center justify-content-between card-spacer">
                            <span class="symbol symbol-50 symbol-light-success mr-2">
                                <span class="symbol-label">
                                    <span class="svg-icon svg-icon-xl svg-icon-success">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                            </span>
                            <div class="d-flex flex-column text-right">
                                <span class="text-dark-75 font-weight-bolder font-size-h3">{{ $weekIncome }}</span>
                                <span class="text-muted font-weight-bold mt-2">Thu nhập trong tuần</span>
                            </div>
                        </div>
                        <div id="kt_stats_widget_11_chart" class="card-rounded-bottom" data-color="success" style="height: 150px"></div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 11-->
            </div>
            <div class="col-lg-8 col-xxl-8 order-2 order-xxl-1">
                <!--begin::Advance Table Widget 2-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Thống kê</span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm">Thống kê đơn book tour</span>
                        </h3>
                        <div class="card-toolbar">
                            <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                                <li class="nav-item">
                                    <a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_11_1">Tháng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_11_2">Tuần</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-2 px-4 active" data-toggle="tab" href="#kt_tab_pane_11_3">Ngày</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2 pb-0 mt-n3">
                        <div class="tab-content mt-5" id="myTabTables11">
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade" id="kt_tab_pane_11_1" role="tabpanel" aria-labelledby="kt_tab_pane_11_1">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table table-borderless table-vertical-center">
                                        <thead>
                                        <tr>
                                            <th class="p-0"></th>
                                            <th class="p-0"></th>
                                            <th class="p-0"></th>
                                            <th class="p-0"></th>
                                            <th class="p-0"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($monthTours as $tour)
                                            <tr>
                                                <td class="pl-0 py-4">
                                                    <div class="symbol symbol-50 symbol-light">
                                                    <span class="symbol-label">
                                                        <img src="{{ $tour->thumbnail }}" class="h-50 align-self-center" alt="" />
                                                    </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ \Illuminate\Support\Str::limit($tour->name, 30) }}</a>
                                                    <div>
                                                        <span class="font-weight-bolder text-dark-50">Khách:</span>
                                                        <a class="text-muted font-weight-bold text-hover-primary" href="#">
                                                            {{ \Illuminate\Support\Str::limit(join(', ', array_map(function ($invoice) {return $invoice['user']['first_name'];}, $tour->invoices->toArray())), 30) }}
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $tour->invoices->count() }}</span>
                                                    <span class="text-muted font-weight-bold">người đã đặt cọc</span>
                                                </td>
                                                <td class="text-right">
                                                    <span class="label label-lg label-light-warning label-inline">{{ auth()->user()->role === GUIDE ? 'Tour của bạn' : $tour->guide->getFullName() }}</span>
                                                </td>
                                                <td class="text-right pr-0">
                                                    <a href="{{ route('invoice.listUsers', ['id' => $tour->id]) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-container="body" data-toggle="tooltip" data-placement="left" title="Xem chi tiết">
                                                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>
                                                                    <path d="M10.5,10.5 L10.5,9.5 C10.5,9.22385763 10.7238576,9 11,9 C11.2761424,9 11.5,9.22385763 11.5,9.5 L11.5,10.5 L12.5,10.5 C12.7761424,10.5 13,10.7238576 13,11 C13,11.2761424 12.7761424,11.5 12.5,11.5 L11.5,11.5 L11.5,12.5 C11.5,12.7761424 11.2761424,13 11,13 C10.7238576,13 10.5,12.7761424 10.5,12.5 L10.5,11.5 L9.5,11.5 C9.22385763,11.5 9,11.2761424 9,11 C9,10.7238576 9.22385763,10.5 9.5,10.5 L10.5,10.5 Z" fill="#000000" opacity="0.3"/>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end::Tap pane-->
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade" id="kt_tab_pane_11_2" role="tabpanel" aria-labelledby="kt_tab_pane_11_2">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table table-borderless table-vertical-center">
                                        <thead>
                                        <tr>
                                            <th class="p-0"></th>
                                            <th class="p-0"></th>
                                            <th class="p-0"></th>
                                            <th class="p-0"></th>
                                            <th class="p-0"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($weekTours as $tours)
                                            <tr>
                                                <td class="pl-0 py-4">
                                                    <div class="symbol symbol-50 symbol-light">
                                                    <span class="symbol-label">
                                                        <img src="{{ $tour->thumbnail }}" class="h-50 align-self-center" alt="" />
                                                    </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ \Illuminate\Support\Str::limit($tour->name, 30) }}</a>
                                                    <div>
                                                        <span class="font-weight-bolder text-dark-50">Khách:</span>
                                                        <a class="text-muted font-weight-bold text-hover-primary" href="#">
                                                            {{ \Illuminate\Support\Str::limit(join(', ', array_map(function ($invoice) {return $invoice['user']['first_name'];}, $tour->invoices->toArray())), 30) }}
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $tour->invoices->count() }}</span>
                                                    <span class="text-muted font-weight-bold">người đã đặt cọc</span>
                                                </td>
                                                <td class="text-right">
                                                    <span class="label label-lg label-light-warning label-inline">{{ auth()->user()->role === GUIDE ? 'Tour của bạn' : $tour->guide->getFullName() }}</span>
                                                </td>
                                                <td class="text-right pr-0">
                                                    <a href="{{ route('invoice.listUsers', ['id' => $tour->id]) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-container="body" data-toggle="tooltip" data-placement="left" title="Xem chi tiết">
                                                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>
                                                                    <path d="M10.5,10.5 L10.5,9.5 C10.5,9.22385763 10.7238576,9 11,9 C11.2761424,9 11.5,9.22385763 11.5,9.5 L11.5,10.5 L12.5,10.5 C12.7761424,10.5 13,10.7238576 13,11 C13,11.2761424 12.7761424,11.5 12.5,11.5 L11.5,11.5 L11.5,12.5 C11.5,12.7761424 11.2761424,13 11,13 C10.7238576,13 10.5,12.7761424 10.5,12.5 L10.5,11.5 L9.5,11.5 C9.22385763,11.5 9,11.2761424 9,11 C9,10.7238576 9.22385763,10.5 9.5,10.5 L10.5,10.5 Z" fill="#000000" opacity="0.3"/>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end::Tap pane-->
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade show active" id="kt_tab_pane_11_3" role="tabpanel" aria-labelledby="kt_tab_pane_11_3">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table table-borderless table-vertical-center">
                                        <thead>
                                        <tr>
                                            <th class="p-0"></th>
                                            <th class="p-0"></th>
                                            <th class="p-0"></th>
                                            <th class="p-0"></th>
                                            <th class="p-0"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($dayTours as $tour)
                                            <tr>
                                                <td class="pl-0 py-4">
                                                    <div class="symbol symbol-50 symbol-light">
                                                    <span class="symbol-label">
                                                        <img src="{{ $tour->thumbnail }}" class="h-50 align-self-center" alt="" />
                                                    </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ \Illuminate\Support\Str::limit($tour->name, 30) }}</a>
                                                    <div>
                                                        <span class="font-weight-bolder text-dark-50">Khách:</span>
                                                        <a class="text-muted font-weight-bold text-hover-primary" href="#">
                                                            {{ \Illuminate\Support\Str::limit(join(', ', array_map(function ($invoice) {return $invoice['user']['first_name'];}, $tour->invoices->toArray())), 30) }}
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $tour->invoices->count() }}</span>
                                                    <span class="text-muted font-weight-bold">người đã đặt cọc</span>
                                                </td>
                                                <td class="text-right">
                                                    <span class="label label-lg label-light-warning label-inline">{{ auth()->user()->role === GUIDE ? 'Tour của bạn' : $tour->guide->getFullName() }}</span>
                                                </td>
                                                <td class="text-right pr-0">
                                                    <a href="{{ route('invoice.listUsers', ['id' => $tour->id]) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-container="body" data-toggle="tooltip" data-placement="left" title="Xem chi tiết">
                                                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>
                                                                    <path d="M10.5,10.5 L10.5,9.5 C10.5,9.22385763 10.7238576,9 11,9 C11.2761424,9 11.5,9.22385763 11.5,9.5 L11.5,10.5 L12.5,10.5 C12.7761424,10.5 13,10.7238576 13,11 C13,11.2761424 12.7761424,11.5 12.5,11.5 L11.5,11.5 L11.5,12.5 C11.5,12.7761424 11.2761424,13 11,13 C10.7238576,13 10.5,12.7761424 10.5,12.5 L10.5,11.5 L9.5,11.5 C9.22385763,11.5 9,11.2761424 9,11 C9,10.7238576 9.22385763,10.5 9.5,10.5 L10.5,10.5 Z" fill="#000000" opacity="0.3"/>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end::Tap pane-->
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Advance Table Widget 2-->
            </div>
        </div>
        <!--end::Row-->
        <!--end::Dashboard-->
    </div>
@endsection

@section('extra-css')
    <link href="{{ asset('Libraries/Manager/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('extra-js')
    <script src="{{ asset('Libraries/Manager/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        getDataTotalIncome = async () => {
            let data = []
            await axios.get(`${BASE_URL}/api_v1/invoice/total-income`)
                .then((res) => data = res.data)
                .catch((err) => {
                    console.log(err)
                })
            return data
        }
        getDataWeeklyIncome = async () => {
            let data = []
            await axios.get(`${BASE_URL}/api_v1/invoice/weekly-income`)
                .then((res) => data = res.data)
                .catch((err) => {
                    console.log(err)
                })
            return data
        }

        _initMixedWidget1 = async function () {
            const dataTotalIncome = await getDataTotalIncome()
            var element = document.getElementById("kt_mixed_widget_1_chart");
            var height = parseInt(KTUtil.css(element, 'height'));

            if (!element) {
                return;
            }

            var strokeColor = '#D13647';

            var options = {
                series: [{
                    name: 'Thu nhập',
                    data: dataTotalIncome.map(({ money }) => money)
                }],
                chart: {
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    },
                    dropShadow: {
                        enabled: true,
                        enabledOnSeries: undefined,
                        top: 5,
                        left: 0,
                        blur: 3,
                        color: strokeColor,
                        opacity: 0.5
                    }
                },
                plotOptions: {},
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 0
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [strokeColor]
                },
                xaxis: {
                    categories: dataTotalIncome.map(({ title }) => title),
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: '#B5B5C3',
                            fontSize: '12px',
                            fontFamily: 'Poppins'
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            color: '#E4E6EF',
                            width: 1,
                            dashArray: 3
                        }
                    }
                },
                yaxis: {
                    labels: {
                        show: false,
                        style: {
                            colors: '#B5B5C3',
                            fontSize: '12px',
                            fontFamily: 'Poppins'
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Poppins'
                    },
                    y: {
                        formatter: function (val) {
                            return Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(val)
                        }
                    },
                    marker: {
                        show: false
                    }
                },
                colors: ['transparent'],
                markers: {
                    colors: ['#FFE2E5'],
                    strokeColor: [strokeColor],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        }
        _initStatsWidget11 = async function () {
            const dataWeeklyIncome = await getDataWeeklyIncome()
            const element = document.getElementById("kt_stats_widget_11_chart");

            const height = parseInt(KTUtil.css(element, 'height'));
            const color = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'success';

            if (!element) {
                return;
            }

            const options = {
                series: [{
                    name: 'Thu nhập',
                    data: dataWeeklyIncome.map(({ money }) => money)
                }],
                chart: {
                    type: 'area',
                    height: 150,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                plotOptions: {},
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: 'success'
                },
                xaxis: {
                    categories: dataWeeklyIncome.map(({ title }) => title),
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: '#B5B5C3',
                            fontSize: '12px',
                            fontFamily: 'Poppins'
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            color: "#E4E6EF",
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                            fontFamily: "Poppins"
                        }
                    }
                },
                yaxis: {
                    labels: {
                        show: false,
                        style: {
                            colors: "#B5B5C3",
                            fontSize: '12px',
                            fontFamily: "Poppins"
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px',
                        fontFamily: "Poppins"
                    },
                    y: {
                        formatter: function (val) {
                            return Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(val)
                        }
                    }
                },
                colors: ["#C9F7F5"],
                markers: {
                    colors: ['#C9F7F5'],
                    strokeColor: ['#1BC5BD'],
                    strokeWidth: 3
                }
            };

            const chart = new ApexCharts(element, options);
            chart.render();
        }

        _initMixedWidget1()
        _initStatsWidget11()
    </script>
@endsection
