@extends('layouts.manager.app')

@section('title', 'Thông tin khách hàng')

@section('extra-js')
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        KTDefaultDatatableDemo = function () {
            // Private functions

            // basic demo
            const demo = function () {
                const datatable = $('#kt_datatable').KTDatatable({
                    // datasource definition
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: BASE_URL + '/api_v1/invoice/list-users/' + '{{ $currentTour->id }}',
                                method: 'GET'
                            },
                        },
                        pageSize: 5, // display 20 records per page
                        serverPaging: true,
                        serverFiltering: true,
                        serverSorting: true,
                    },

                    // layout definition
                    layout: {
                        scroll: true, // enable/disable datatable scroll both horizontal and vertical when needed.
                        minHeight: null, // datatable's body's fixed height
                        footer: false, // display/hide footer
                    },

                    // column sorting
                    sortable: true,

                    // toolbar
                    toolbar: {
                        // toolbar placement can be at top or bottom or both top and bottom repeated
                        placement: ['bottom'],

                        // toolbar items
                        items: {
                            // pagination
                            pagination: {
                                // page size select
                                pageSizeSelect: [5, 10, 20, 30, 50], // display dropdown to select pagination size. -1 is used for "ALl" option
                            },
                        },
                    },

                    search: {
                        input: $('#kt_datatable_search_query'),
                        key: 'keyword'
                    },

                    // columns definition
                    columns: [
                        {
                            field: 'user.id',
                            title: '#',
                            sortable: false,
                            width: 30,
                            type: 'number',
                            selector: {class: 'checkbox'},
                            textAlign: 'center',
                        }, {
                            field: 'user.first_name',
                            title: 'Tên',
                            autoHide: false,
                            sortable: false,
                            template: function (row) {
                                return `<div class="d-flex align-items-center">
                                                <div class="symbol symbol-40 flex-shrink-0">
                                                    <div class="symbol-label" style="background-image:url(${row.user.avatar})"></div>
                                                </div>
                                                <div class="ml-2">
                                                    <div class="font-weight-bold line-height-sm">
                                                        <a class="text-dark-75" target="_blank" href="{{ route('invoice-show', ['sku' => '/'])}}/${row.sku}">${row.user.first_name} ${row.user.last_name}</a>
                                                    </div>
                                                </div>
                                            </div>`
                            }
                        }, {
                            field: 'user.email',
                            title: 'Email',
                            sortable: false,
                            template: function (row) {
                                return `<a href="mailto:${row.user.email}" class="text-info">${row.user.email}</a>`
                            }
                        }, {
                            field: 'user.phone',
                            title: 'Số điện thoại',
                            sortable: false,
                            template: function (row) {
                                return `<a href="tel:${row.user.phone}" class="text-warning">${row.user.phone}</a>`
                            }
                        }, {
                            field: 'status',
                            title: 'Status',
                            autoHide: false,
                            // callback function support for column rendering
                            template: function (row) {
                                const invoices_status_button = document.getElementById('invoices_status')
                                invoices_status_button.style.visibility = 'hidden'

                                if (row && row.status < {{INVOICE_COMPLETE}}) {
                                    invoices_status_button.style.visibility = 'visible'
                                }


                                const status = {
                                    0: {'title': 'Đã tiếp nhận', 'class': ' label-light-info'},
                                    1: {'title': 'Đã xác nhận', 'class': 'label-light-default'},
                                    2: {'title': 'Đã thanh toán', 'class': ' label-light-primary'},
                                    3: {'title': 'Đang diễn ra', 'class': ' label-light-warning'},
                                    4: {'title': 'Đã hoàn thành', 'class': ' label-light-success'},
                                    5: {'title': 'Xác nhận hoàn thành', 'class': ' label-light-info'},
                                    6: {'title': 'Hoàn tất', 'class': ' label-light-danger'},
                                };
                                return `<span class="label ${status[row.status].class} label-inline font-weight-bold label-lg">${status[row.status].title}</span>`;
                            }
                        }],

                });

                $('#kt_datatable_search_batch').on('change', function () {
                    document.getElementById('start_date_input').value = $(this).val()
                    datatable.search($(this).val().toLowerCase(), 'batch');
                });

                $('#kt_datatable_search_batch').selectpicker();
            };

            return {
                // public functions
                init: function () {
                    demo();
                },
            };
        }();

        KTDefaultDatatableDemo.init();
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="d-flex flex-row">
            <div class="flex-md-row-auto w-md-275px w-xl-325px">
                <div class="card card-custom gutter-b">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Danh sách Tour</span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm">Danh sách Tour đã được book</span>
                        </h3>
                    </div>
                    <div class="card-body pt-4 scroll" data-scroll="true" data-height="600" data-mobile-height="auto">
                        <div>
                            @foreach($tours as $tour)
                                <div class="d-flex align-items-center mb-8" id="js-tour-{{ $tour->id }}">
                                    <div class="symbol mr-5 pt-1">
                                        <div class="symbol-label min-w-65px min-h-100px"
                                             style="background-image: url('{{ $tour->thumbnail }}')"></div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">
                                            {{ \Illuminate\Support\Str::limit($tour->name, 30) }}
                                        </a>
                                        <span class="text-muted font-weight-bold font-size-sm pb-4">
                                            {{ \Illuminate\Support\Str::limit(join(', ', array_map(function ($invoice) {return $invoice['user']['first_name'];}, $tour->invoices->toArray())), 50) }}
                                            <br/>@if(auth()->user()->role === ADMIN) Guide: {{ $tour->guide->getFullName() }} @endif
                                        </span>
                                        <div>
                                            <a href="{{ route('invoice.listUsers', ['id' => $tour->id]) }}" class="btn font-weight-bolder font-size-sm py-2 @if($tour->id == $currentTour->id) btn-light-primary active @else btn-light @endif">
                                                Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--end::Container-->
                    </div>
                </div>
            </div>
            <div class="flex-row-fluid ml-lg-8">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark mb-3">{{ \Illuminate\Support\Str::limit($currentTour->name, 100) }}</span>
                            <span class="text-muted mt-1 font-weight-bold font-size-sm">
                                {{ $currentTour && $batch ? \Illuminate\Support\Str::limit($currentTour->name, 50) : 'Vui lòng chọn ngày khởi hành để xem chi tiết' }}
                            </span>
                            <span class="text-danger mt-1 font-weight-bold font-size-sm">
                                @if(session()->has('message_error'))
                                    {{ session('message_error')  }}
                                @endif
                            </span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-10">
                            <div class="row align-items-center">
                                <div class="col-lg-9 col-xl-8">
                                    <div class="row align-items-center">
                                        <div class="col-md-8 my-2 my-md-0">
                                            <div class="input-icon">
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder="Search..." id="kt_datatable_search_query"/>
                                                <span>
																			<i class="flaticon2-search-1 text-muted"></i>
																		</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 my-2 my-md-0">
                                            <select class="form-control form-control-solid"
                                                    id="kt_datatable_search_batch">
                                                <option value="">Ngày khởi hành</option>
                                                @foreach($currentTour->batches as $batch)
                                                    <option value="{{ $batch->batch }}">{{ \Carbon\Carbon::parse($batch->batch)->format('d/m/Y') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                                    <form action="{{route('invoices.update-status', $currentTour->id)}} "method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="start_date" id="start_date_input">
                                        <button style="visibility: hidden" id="invoices_status" class="btn btn-light-primary px-6 font-weight-bold">Cập nhật trạng thái</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
