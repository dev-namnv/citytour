@extends('layouts.manager.app')

@section('title', 'Danh sách danh mục')

@section('extra-js')
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        deleteCategory = async (id) => {
            axios.delete(`${BASE_URL}/manager/category/${id}/delete`)
                .then(res => {
                    if (res.status === 200) {
                        const labelCategory = $(`#js-category-${id}`)
                        labelCategory.parent().parent().parent().fadeOut()
                    }
                    showNotify(res)
                })
                .catch(err => {
                    showNotify(err, true)
                })
        }

        var KTDatatableModal = function () {

            var initDatatable = function () {
                var el = $('#kt_datatable');

                var datatable = el.KTDatatable({
                    // datasource definition
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: BASE_URL + '/api_v1/category',
                                method: 'GET'
                            },
                        },
                        pageSize: 10, // display 20 records per page
                        serverPaging: true,
                        serverFiltering: false,
                        serverSorting: true,
                    },

                    // layout definition
                    layout: {
                        theme: 'default',
                        scroll: false,
                        height: null,
                        footer: false,
                    },

                    // column sorting
                    sortable: true,

                    pagination: true,

                    search: {
                        input: el.find('#kt_datatable_search_query'),
                        key: 'generalSearch'
                    },

                    // columns definition
                    columns: [{
                        field: 'id',
                        title: 'ID',
                        sortable: false,
                        width: 30,
                        textAlign: 'center',
                    }, {
                        field: 'name',
                        title: 'Tên danh mục',
                    }, {
                        field: 'icon',
                        title: 'Icon',
                        template: function (row) {
                            return `<i class="${row.icon}"></i>`
                        }
                    }, {
                        field: 'description',
                        title: 'Description',
                    }, {
                        field: 'sort_order',
                        title: 'Sắp xếp',
                    }, {
                        field: 'Actions',
                        title: 'Actions',
                        sortable: false,
                        width: 125,
                        overflow: 'visible',
                        autoHide: false,
                        template: function (row) {
                            return `
\t                        <div id="js-category-${row.id}">
                          <a href="{{ route('category.edit', ['id' => '/']) }}/${row.id}" class="btn btn-sm btn-clean" title="Xem chi tiết">
\t                          <i class="flaticon2-document"></i>
\t                       </a>
\t                        <a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon js-btn-delete" onclick="confirm('Xác nhận xóa Danh mục?') && deleteCategory(${row.id})" title="Delete">
\t                            <span class="svg-icon svg-icon-md">
\t                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
\t                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
\t                                        <rect x="0" y="0" width="24" height="24"/>
\t                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
\t                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
\t                                    </g>
\t                                </svg>
\t                            </span>
\t                        </a>
                        </div>
\t                    `;
                        },
                    }],
                });

                datatable.on('click', '[data-record-id]', function () {
                    $('#kt_datatable_modal').modal('show');
                });
            };

            return {
                // public functions
                init: function () {
                    initDatatable();
                }
            };
        }();

        jQuery(document).ready(function () {
            KTDatatableModal.init();
        });
    </script>
    <script>
        showNotify = (res, error = false) => {
            $.notify({
                title: !error ? (res.data.title || '') : 'Error',
                message: !error ? res.data.message : 'Có lỗi xảy ra'
            }, {
                type: !error ? (res.status === 200 ? 'success' : 'danger') : 'danger',
                allow_dismiss: false,
                newest_on_top: true,
                mouse_over:  false,
                showProgressbar:  false,
                spacing: 10,
                timer: 2000,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                offset: {
                    x: 30,
                    y: 30
                },
                delay: 1000,
                z_index: 10000,
                animate: {
                    enter: 'animate__animated animate__bounceIn',
                    exit: 'animate__animated animate__bounceOut'
                }
            });
        }
    </script>
    @if(session()->has('category'))
        <script>
            $.notify({
                title: 'Success',
                message: '{{ json_decode(session('category'))->message }}'
            }, {
                type: '{{ json_decode(session('category'))->status ? 'success' : 'error' }}',
                allow_dismiss: false,
                newest_on_top: true,
                mouse_over: false,
                showProgressbar: false,
                spacing: 10,
                timer: 2000,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                offset: {
                    x: 30,
                    y: 30
                },
                delay: 1000,
                z_index: 10000,
                animate: {
                    enter: 'animate__animated animate__bounceIn',
                    exit: 'animate__animated animate__bounceOut'
                }
            });
        </script>
    @endif
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('Libraries/Main/css/fontello/css/all-fontello.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Danh mục
                        <span class="d-block text-muted pt-2 font-size-sm">Danh sách danh mục</span></h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="#" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24"/>
														<circle fill="#000000" cx="9" cy="15" r="6"/>
														<path
                                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                                            fill="#000000" opacity="0.3"/>
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span>Tạo danh mục</a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
        <!--begin::Modal-->
        <div id="kt_datatable_modal" class="modal fade" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content" style="min-height: 590px;">
                    <div class="modal-header py-5">
                        <h5 class="modal-title">Sub Datatable in Modal Pop-up
                            <span class="d-block text-muted font-size-sm">sub datatable for the selected row is loaded from remote data source</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--begin: Search Form-->
                        <!--begin::Search Form-->
                        <div class="mb-5">
                            <div class="row align-items-center">
                                <div class="col-lg-9 col-xl-8">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 my-2 my-md-0">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" placeholder="Search..."
                                                       id="kt_datatable_search_query_2"/>
                                                <span>
																			<i class="flaticon2-search-1 text-muted"></i>
																		</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 my-2 my-md-0">
                                            <div class="d-flex align-items-center">
                                                <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                                <select class="form-control" id="kt_datatable_search_status_2">
                                                    <option value="">All</option>
                                                    <option value="1">Pending</option>
                                                    <option value="2">Delivered</option>
                                                    <option value="3">Canceled</option>
                                                    <option value="4">Success</option>
                                                    <option value="5">Info</option>
                                                    <option value="6">Danger</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 my-2 my-md-0">
                                            <div class="d-flex align-items-center">
                                                <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                                <select class="form-control" id="kt_datatable_search_type_2">
                                                    <option value="">All</option>
                                                    <option value="1">Online</option>
                                                    <option value="2">Retail</option>
                                                    <option value="3">Direct</option>
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
                        <!--end: Search Form-->
                        <!--begin: Datatable-->
                        <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable_sub"></div>
                        <!--end: Datatable-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold text-uppercase"
                                data-dismiss="modal">Close
                        </button>
                        <button type="button" class="btn btn-primary font-weight-bold text-uppercase">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
