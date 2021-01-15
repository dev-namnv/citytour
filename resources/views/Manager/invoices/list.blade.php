@extends('layouts.manager.app')

@section('title', 'Quản lý hóa đơn')

@section('extra-js')
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script>
        var KTDatatableChildRemoteDataDemo = function() {
            // Private functions

            // demo initializer
            const demo = function() {

                const datatable = $('#kt_datatable').KTDatatable({
                    // datasource definition
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: BASE_URL + '/api_v1/invoice/tours',
                                method: 'GET',
                            },
                        },
                        pageSize: 20, // display 20 records per page
                        serverPaging: true,
                        serverFiltering: true,
                        serverSorting: true,
                    },

                    // layout definition
                    layout: {
                        scroll: false,
                        footer: false,
                    },

                    // column sorting
                    sortable: true,

                    pagination: true,

                    detail: {
                        title: 'Load sub table',
                        content: subTableInit,
                    },

                    search: {
                        input: $('#kt_datatable_search_query'),
                        key: 'keyword'
                    },

                    // columns definition
                    columns: [
                        {
                            field: 'id',
                            title: '',
                            sortable: false,
                            width: 30,
                            textAlign: 'center',
                        }, {
                            field: 'name',
                            title: 'Tên',
                            autoHide: false,
                            template: function (row) {
                                return `<div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 flex-shrink-0">
                                        <div class="symbol-label" style="background-image:url(${row.thumbnail})"></div>
                                    </div>
                                    <div class="ml-2">
                                        <div class="text-dark-75 font-weight-bold line-height-sm">
                                            <a class="text-dark-75" href="{{ route('invoice.listUsers', ['id' => '/']) }}/${row.id}">${row.name.length >= 50 ? `${row.name.substring(0, 50)}...`: row.name}</a>
                                        </div>
                                    </div>
                                </div>`
                            }
                        }, {
                            field: 'invoices',
                            title: 'Tổng số hóa đơn',
                            sortable: false,
                            template: function (row) {
                                return `<span class="text-info">${row.invoices.length}</span>`
                            }
                        }, {
                            field: 'batches',
                            title: 'Lịch trình',
                            sortable: false,
                            width: 125,
                            autoHide: false,
                            template: function (row) {
                                return `<div class="d-flex align-items-center">
                                                <select class="form-control">
                                                    ${row.batches.map(item => moment(item.batch) > moment()
                                    ? `<option class="text-primary" selected>${moment(item.batch).format('DD-MM-YYYY')}</option>`
                                    : `<option class="text-danger disabled" disabled="disabled">${item.batch}</option>`)
                                }
                                                </select>
                                            </div>`;
                            }
                        }, {
                            field: 'address',
                            title: 'Địa chỉ',
                        }],
                });

                $('#kt_datatable_search_status').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'status');
                });

                $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();

                function subTableInit(e) {
                    $('<div/>').attr('id', 'child_data_ajax_' + e.data.id).appendTo(e.detailCell).KTDatatable({
                        data: {
                            type: 'remote',
                            source: {
                                read: {
                                    url: BASE_URL + '/api_v1/invoice/list-by-tour/' + e.data.id,
                                    method: 'GET'
                                },
                            },
                            pageSize: 5,
                            serverPaging: true,
                            serverFiltering: false,
                            serverSorting: true,
                        },

                        // layout definition
                        layout: {
                            scroll: true,
                            footer: false,

                            // enable/disable datatable spinner.
                            spinner: {
                                type: 1,
                                theme: 'default',
                            },
                        },

                        sortable: true,

                        // columns definition
                        columns: [
                            {
                                field: 'id',
                                title: '#',
                                sortable: false,
                                width: 30,
                                template: function (row) {
                                    return `<a href="{{ route('invoice-show', ['', '']) }}/${row.sku}">${row.id}</a>`
                                }
                            }, {
                                field: 'start_date',
                                title: 'Ngày khởi hành',
                                template: function (row) {
                                    return moment(row.start_date).format('DD-MM-YYYY')
                                }
                            }, {
                                field: 'customer_name',
                                title: 'Khách hàng',
                            }, {
                                field: 'customer_email',
                                title: 'Địa chỉ Email',
                                template: function (row) {
                                    return `<a href="mailto:${row.customer_email}">${row.customer_email}</a>`
                                }
                            }, {
                                field: 'customer_phone',
                                title: 'Số điện thoại',
                                template: function (row) {
                                    return `<a href="tel:${row.customer_phone}">${row.customer_phone}</a>`
                                }
                            }, {
                                field: 'payment_type',
                                title: 'Hình thức',
                            }, {
                                field: 'status',
                                title: 'Trạng thái',
                                // callback function support for column rendering
                                template: function(row) {
                                    const status = {
                                        0: {'title': 'Đã tiếp nhận', 'class': ' label-light-info'},
                                        1: {'title': 'Đã xác nhận', 'class': 'label-light-default'},
                                        2: {'title': 'Đã thanh toán', 'class': ' label-light-primary'},
                                        3: {'title': 'Đang diễn ra', 'class': ' label-light-warning'},
                                        4: {'title': 'Đã hoàn thành', 'class': ' label-light-success'},
                                        5: {'title': 'Xác nhận hoàn thành', 'class': ' label-light-info'},
                                        6: {'title': 'Hoàn tất', 'class': ' label-light-danger'},
                                    };
                                    return '<span class="label ' + status[row.status].class + ' label-inline label-bold">' + status[row.status].title + '</span>';
                                },
                            }, {
                                field: 'payment_status',
                                title: 'Thanh toán',
                                autoHide: false,
                                // callback function support for column rendering
                                template: function(row) {
                                    const status = {
                                        0: {'title': 'Chưa thanh toán', 'state': 'danger'},
                                        1: {'title': 'Đã thanh toán', 'state': 'success'},
                                    };
                                    return '<span class="label label-' + status[row.payment_status].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' +
                                        status[row.payment_status].state + '">' +
                                        status[row.payment_status].title + '</span>';
                                },
                            }],
                    });
                }
            };

            return {
                // Public functions
                init: function() {
                    // init dmeo
                    demo();
                },
            };
        }();

        jQuery(document).ready(function() {
            KTDatatableChildRemoteDataDemo.init();
        });

    </script>
@endsection

@section('content')
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Quản lý hóa đơn
                        <span class="d-block text-muted pt-2 font-size-sm">
                            @if (Auth::user()->role === ADMIN)
                                Danh sách tất cả hóa đơn của hệ thống
                            @else
                                Danh sách tất cả hóa đơn của bạn
                            @endif
                        </span></h3>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Search Form-->
                <!--begin::Search Form-->
                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-6 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Search..."
                                               id="kt_datatable_search_query"/>
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Trạng thái:</label>
                                        <select class="form-control" id="kt_datatable_search_status">
                                            <option value="">Tất cả</option>
                                            <option value="0">Đã tiếp nhận</option>
                                            <option value="1">Đã xác nhận</option>
                                            <option value="2">Đã xác thanh toán</option>
                                            <option value="3">Đang diễn ra</option>
                                            <option value="4">Đã hoàn thành</option>
                                            <option value="5">Xác nhận hoàn thành</option>
                                            <option value="6">Hoàn tất</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                            <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                        </div>
                    </div>
                </div>
                <!--end::Search Form-->
                <!--begin: Datatable-->
                <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
@endsection

