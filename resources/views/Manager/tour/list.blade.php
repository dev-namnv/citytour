@extends('layouts.manager.app')

@section('title', 'Quản lý Tour')

@section('extra-js')
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    @if(Auth::user()->role === ADMIN)
        <script>
            deleteTour = (id) => {
                axios.delete(`${BASE_URL}/api_v1/tour/manager/${id}/delete`)
                    .then(res => {
                        if (res.status === 200) {
                            const labelActive = $(`#js-label-active-${id}`)
                            labelActive.parent().parent().parent().fadeOut()
                        }
                        showNotify(res)
                    })
                    .catch(err => {
                        showNotify(err, true)
                    })
            }
            setActive = (id) => {
                axios.patch(`${BASE_URL}/api_v1/tour/manager/${id}/active`)
                    .then(res => {
                        if (res.status === 200) {
                            const labelActive = $(`#js-label-active-${id}`)
                            const buttonActive = $(`#js-active-button-${id}`)
                            if (res.data.active) {
                                labelActive.removeClass(' label-light-light-danger')
                                labelActive.addClass('label-light-primary')
                                labelActive.text('Activated')
                                buttonActive.text('Deactivate')
                            } else {
                                labelActive.removeClass('label-light-primary')
                                labelActive.addClass(' label-light-light-danger')
                                labelActive.text('Not activated')
                                buttonActive.text('Active')
                            }
                        }
                        showNotify(res)
                    })
                    .catch((err) => {
                        showNotify(err, true)
                    })
            }
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
                                    url: BASE_URL + `/api_v1/tour/manager/list`,
                                    method: 'GET'
                                },
                            },
                            pageSize: 20, // display 20 records per page
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
                                field: 'id',
                                title: '#',
                                sortable: false,
                                width: 30,
                                type: 'number',
                                selector: {class: 'checkbox'},
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
                                                    <div class="font-weight-bold line-height-sm">
                                                        <a class="text-dark-75" target="_blank" href="{{ route('tour-edit',['slug'=>'/']) }}/${row.slug}">${row.name.length >= 25 ? `${row.name.substring(0, 25)}...`: row.name}</a>
                                                    </div>
                                                </div>
                                            </div>`
                                }
                            } , {
                                field: 'batches',
                                title: 'Lịch trình',
                                sortable: false,
                                width: 120,
                                autoHide: false,
                                template: function (row) {
                                    return `<div class="d-flex align-items-center">
                                                <select class="form-control">
                                                    ${row.batches.map(item => moment(item.batch) > moment()
                                                        ? `<option class="text-primary" selected>${item.batch}</option>`
                                                        : `<option class="text-danger disabled" disabled="disabled">${item.batch}</option>`)
                                                    }
                                                </select>
                                            </div>`;
                                }
                            }, {
                                field: 'adult_price',
                                title: 'Giá',
                                template: function (row) {
                                    return `<span class="text-info">${row.adult_price.formatted}</span>`
                                }
                            }, {
                                field: 'address',
                                title: 'Địa chỉ'
                            }, {
                                field: 'description',
                                title: 'Mô tả',
                                type: 'string',
                                template: function (row) {
                                    return `${row.description.substring(0, 30)}...`
                                }
                            }, {
                                field: 'content',
                                title: 'Nội dung',
                                template: function (row) {
                                    return `${row.description.substring(0, 30)}...`
                                }
                            }, {
                                field: 'publish',
                                title: 'Công khai',
                                // callback function support for column rendering
                                template: function (row) {
                                    const status = {
                                        true: {'title': 'Published', 'class': 'label-light-primary'},
                                        false: {'title': 'Unpublished', 'class': ' label-light-light-danger'}
                                    };
                                    return `<span class="label ${status[row.publish].class} label-inline font-weight-bold label-lg" id="js-label-publish-${row.id}">${status[row.publish].title}</span>`;
                                },
                            }, {
                                field: 'active',
                                title: 'Active',
                                autoHide: false,
                                // callback function support for column rendering
                                template: function (row) {
                                    const status = {
                                        true: {'title': 'Activated', 'class': 'label-light-primary'},
                                        false: {'title': 'Not activated', 'class': ' label-light-light-danger'}
                                    };
                                    return `<span class="label ${status[row.active].class} label-inline font-weight-bold label-lg" id="js-label-active-${row.id}">${status[row.active].title}</span>`;
                                },
                            }, {
                                field: 'guide',
                                title: 'Guide',
                                sortable: false,
                                autoHide: false,
                                width: 160,
                                // callback function support for column rendering
                                template: function (row) {
                                    return `<div class="d-flex align-items-center">
                                                <div class="symbol symbol-40 flex-shrink-0">
                                                    <div class="symbol-label" style="background-image:url(${row.guide.avatar})"></div>
                                                </div>
                                            <div class="ml-2">
                                                <div class="text-dark-75 font-weight-bold line-height-sm">${row.guide.first_name}</div>
                                                    <a href="mailto:${row.guide.email}" class="font-size-sm text-dark-50 text-hover-primary">${row.guide.email.length > 13 ? `${row.guide.email.substr(0, 13)}...` : row.guide.email}</a>
                                                </div>
                                            </div>`
                                }
                            }, {
                                field: 'Actions',
                                title: 'Actions',
                                sortable: false,
                                width: 125,
                                overflow: 'visible',
                                autoHide: false,
                                template: function (row) {
                                    return `
\t                        <div class="dropdown dropdown-inline">
\t                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">
\t                                <span class="svg-icon svg-icon-md">
\t                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
\t                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
\t                                            <rect x="0" y="0" width="24" height="24"/>
\t                                            <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>
\t                                        </g>
\t                                    </svg>
\t                                </span>
\t                            </a>
\t                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
\t                                <ul class="navi flex-column navi-hover py-2">
\t                                    <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">
\t                                        Choose an action:
\t                                    </li>
\t                                    <li class="navi-item">
\t                                        <a href="javascript:void(0)" onclick="setActive(${row.id})" class="navi-link js-btn-active">
\t                                            <span class="navi-icon"><i class="la la-print"></i></span>
\t                                            <span class="navi-text" id="js-active-button-${row.id}">${!row.active ? 'Active' : 'Deactivate'}</span>
\t                                        </a>
\t                                    </li>
\t                                </ul>
\t                            </div>
\t                        </div>
\t                        <button data-record-id="${row.id}" class="btn btn-sm btn-clean" title="Xem chi tiết">
\t                          <i class="flaticon2-document"></i>
\t                       </button>
\t                        <a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon js-btn-delete bg-danger" onclick="confirm('Xác nhận xóa Tour?') && deleteTour(${row.id})" title="Delete">
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
\t                    `;
                                },
                            }],

                    });

                    $('#kt_datatable_search_publish').on('change', function () {
                        datatable.search($(this).val().toLowerCase(), 'publish');
                    });

                    $('#kt_datatable_search_active').on('change', function () {
                        datatable.search($(this).val().toLowerCase(), 'active');
                    });

                    $('#kt_datatable_search_publish, #kt_datatable_search_active').selectpicker();

                    datatable.on('click', '[data-record-id]', function() {
                        initSubDatatable($(this).data('record-id'));
                        $('#kt_datatable_modal').modal('show');
                    });

                };

                const initSubDatatable = function(id) {
                    const el = $('#kt_datatable_sub');
                    const datatable = el.KTDatatable({
                        data: {
                            type: 'remote',
                            source: {
                                read: {
                                    url: BASE_URL + `/api_v1/tour/manager/${id}/schedules`,
                                    method: 'GET'
                                },
                            }
                        },

                        // layout definition
                        layout: {
                            theme: 'default',
                            scroll: true,
                            height: 350,
                            footer: false,
                        },

                        // columns definition
                        columns: [
                            {
                                field: 'image',
                                title: 'Ảnh',
                                sortable: false,
                                width: 40,
                                autoHide: false,
                                template: function (row) {
                                    return `<div class="d-flex align-items-center">
                                                <div class="symbol symbol-40 flex-shrink-0">
                                                    <div class="symbol-label" style="background-image:url(${row.image || ''})"></div>
                                                </div>
                                            </div>`
                                }
                            }, {
                                field: 'description',
                                title: 'Mô tả',
                                sortable: false,
                                autoHide: false,
                                template: function(row) {
                                    return `<span>${row.description}</span>`;
                                },
                            }
                        ],
                    });

                    const modal = datatable.closest('.modal');

                    // fix datatable layout after modal shown
                    datatable.hide();
                    modal.on('shown.bs.modal', function() {
                        const modalContent = $(this).find('.modal-content');
                        datatable.spinnerCallback(true, modalContent);
                        datatable.spinnerCallback(false, modalContent);
                    }).on('hidden.bs.modal', function() {
                        el.KTDatatable('destroy');
                    });

                    datatable.on('datatable-on-layout-updated', function() {
                        datatable.show();
                        datatable.redraw();
                    });
                };

                return {
                    // public functions
                    init: function () {
                        demo();
                    },
                };
            }();

            jQuery(document).ready(function () {
                KTDefaultDatatableDemo.init();
            });
        </script>
    @else
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
            deleteTour = (id) => {
                axios.delete(`${BASE_URL}/api_v1/tour/manager/${id}/delete`)
                    .then(res => {
                        if (res.status === 200) {
                            const labelActive = $(`#js-label-active-${id}`)
                            labelActive.parent().parent().parent().fadeOut()
                        }
                        showNotify(res)
                    })
                    .catch(err => {
                        showNotify(err, true)
                    })
            }
            setPublish = (id) => {
                axios.patch(`${BASE_URL}/api_v1/tour/manager/${id}/publish`)
                    .then(res => {
                        if (res.status === 200) {
                            const labelPublish = $(`#js-label-publish-${id}`)
                            const buttonPublish = $(`#js-publish-button-${id}`)
                            if (res.data.publish) {
                                labelPublish.removeClass(' label-light-light-danger')
                                labelPublish.addClass('label-light-primary')
                                labelPublish.text('Published')
                                buttonPublish.text('Un publish')
                            } else {
                                labelPublish.removeClass('label-light-primary')
                                labelPublish.addClass(' label-light-light-danger')
                                labelPublish.text('Unpublished')
                                buttonPublish.text('Publish')
                            }
                        }
                        showNotify(res)
                    })
                    .catch((err) => {
                        showNotify(err, true)
                    })
            }

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
                                    url: BASE_URL + '/api_v1/tour/manager/list',
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
                                field: 'id',
                                title: '#',
                                sortable: false,
                                width: 30,
                                type: 'number',
                                selector: {class: 'checkbox'},
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
                                                    <div class="text-dark-75 font-weight-bold line-height-sm">${row.name.length >= 25 ? `${row.name.substring(0, 25)}...`: row.name}</div>
                                                </div>
                                            </div>`
                                }
                            } , {
                                field: 'batches',
                                title: 'Lịch trình',
                                sortable: false,
                                width: 120,
                                autoHide: false,
                                template: function (row) {
                                    return `<div class="d-flex align-items-center">
                                                <select class="form-control">
                                                    ${row.batches.map(item => moment(item.batch) > moment()
                                        ? `<option class="text-primary" selected>${item.batch}</option>`
                                        : `<option class="text-danger disabled" disabled="disabled">${item.batch}</option>`)
                                    }
                                                </select>
                                            </div>`;
                                }
                            }, {
                                field: 'adult_price',
                                title: 'Giá',
                                template: function (row) {
                                    return `<span class="text-info">${row.adult_price.formatted}</span>`
                                }
                            }, {
                                field: 'address',
                                title: 'Địa chỉ'
                            }, {
                                field: 'publish',
                                title: 'Công khai',
                                autoHide: false,
                                // callback function support for column rendering
                                template: function (row) {
                                    const status = {
                                        true: {'title': 'Published', 'class': 'label-light-primary'},
                                        false: {'title': 'Unpublished', 'class': ' label-light-light-danger'}
                                    };
                                    return `<span class="label ${status[row.publish].class} label-inline font-weight-bold label-lg" id="js-label-publish-${row.id}">${status[row.publish].title}</span>`;
                                },
                            }, {
                                field: 'active',
                                title: 'Active',
                                autoHide: false,
                                // callback function support for column rendering
                                template: function (row) {
                                    const status = {
                                        true: {'title': 'Activated', 'class': 'label-light-primary'},
                                        false: {'title': 'Not activated', 'class': ' label-light-light-danger'}
                                    };
                                    return `<span class="label ${status[row.active].class} label-inline font-weight-bold label-lg" id="js-label-active-${row.id}">${status[row.active].title}</span>`;
                                },
                            }, {
                                field: 'Actions',
                                title: 'Actions',
                                sortable: false,
                                width: 125,
                                overflow: 'visible',
                                autoHide: false,
                                template: function (row) {
                                    return `
\t                        <div class="dropdown dropdown-inline">
\t                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">
\t                                <span class="svg-icon svg-icon-md">
\t                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
\t                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
\t                                            <rect x="0" y="0" width="24" height="24"/>
\t                                            <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>
\t                                        </g>
\t                                    </svg>
\t                                </span>
\t                            </a>
\t                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
\t                                <ul class="navi flex-column navi-hover py-2">
\t                                    <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">
\t                                        Choose an action:
\t                                    </li>
\t                                    <li class="navi-item">
\t                                        <a href="javascript:void(0)" onclick="setPublish(${row.id})" class="navi-link js-btn-publish">
\t                                            <span class="navi-icon"><i class="la la-print"></i></span>
\t                                            <span class="navi-text" id="js-publish-button-${row.id}">${!row.publish ? 'Publish' : 'Un publish'}</span>
\t                                        </a>
\t                                    </li>
\t                                </ul>
\t                            </div>
\t                        </div>
\t                      <button data-record-id="${row.id}" class="btn btn-sm btn-clean" title="Xem chi tiết">
\t                          <i class="flaticon2-document"></i>
\t                       </button>
\t                        <a href="tour/edit/${row.slug}" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
\t                            <span class="svg-icon svg-icon-md">
\t                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
\t                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
\t                                        <rect x="0" y="0" width="24" height="24"/>
\t                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
\t                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
\t                                    </g>
\t                                </svg>
\t                            </span>
\t                        </a>
\t                        <a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon js-btn-delete" onclick="confirm('Xác nhận xóa Tour?') && deleteTour(${row.id})" title="Delete">
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
\t                    `;
                                },
                            }],

                    });

                    $('#kt_datatable_search_publish').on('change', function () {
                        datatable.search($(this).val().toLowerCase(), 'publish');
                    });

                    $('#kt_datatable_search_active').on('change', function () {
                        datatable.search($(this).val().toLowerCase(), 'active');
                    });

                    $('#kt_datatable_search_publish, #kt_datatable_search_active').selectpicker();

                    datatable.on('click', '[data-record-id]', function() {
                        initSubDatatable($(this).data('record-id'));
                        $('#kt_datatable_modal').modal('show');
                    });

                };

                const initSubDatatable = function(id) {
                    const el = $('#kt_datatable_sub');
                    const datatable = el.KTDatatable({
                        data: {
                            type: 'remote',
                            source: {
                                read: {
                                    url: BASE_URL + `/api_v1/tour/manager/${id}/schedules`,
                                    method: 'GET'
                                },
                            }
                        },

                        // layout definition
                        layout: {
                            theme: 'default',
                            scroll: true,
                            height: 350,
                            footer: false,
                        },

                        // columns definition
                        columns: [
                            {
                                field: 'image',
                                title: 'Ảnh',
                                sortable: false,
                                width: 40,
                                autoHide: false,
                                template: function (row) {
                                    return `<div class="d-flex align-items-center">
                                                <div class="symbol symbol-40 flex-shrink-0">
                                                    <div class="symbol-label" style="background-image:url(${row.image || ''})"></div>
                                                </div>
                                            </div>`
                                }
                            }, {
                                field: 'description',
                                title: 'Mô tả',
                                sortable: false,
                                autoHide: false,
                                template: function(row) {
                                    return `<span>${row.description}</span>`;
                                },
                            }
                        ],
                    });

                    const modal = datatable.closest('.modal');

                    // fix datatable layout after modal shown
                    datatable.hide();
                    modal.on('shown.bs.modal', function() {
                        const modalContent = $(this).find('.modal-content');
                        datatable.spinnerCallback(true, modalContent);
                        datatable.spinnerCallback(false, modalContent);
                    }).on('hidden.bs.modal', function() {
                        el.KTDatatable('destroy');
                    });

                    datatable.on('datatable-on-layout-updated', function() {
                        datatable.show();
                        datatable.redraw();
                    });
                };

                return {
                    // public functions
                    init: function () {
                        demo();
                    },
                };
            }();

            jQuery(document).ready(function () {
                KTDefaultDatatableDemo.init();
            });
        </script>
    @endif
@endsection

@section('content')
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Quản lý Tour
                        <span class="d-block text-muted pt-2 font-size-sm">
                            @if (Auth::user()->role === ADMIN)
                                Danh sách tất cả Tour của hệ thống
                            @else
                                Danh sách tất cả Tour của bạn
                            @endif
                        </span></h3>
                </div>
                @if(auth()->user()->role === GUIDE)
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('tour-create') }}" class="btn btn-primary font-weight-bolder">
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
                                </span>Thêm Tour</a>
                        <!--end::Button-->
                    </div>
                @endif
            </div>
            <div class="card-body">
                <!--begin: Search Form-->
                <!--begin::Search Form-->
                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Search..."
                                               id="kt_datatable_search_query"/>
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Publish:</label>
                                        <select class="form-control" id="kt_datatable_search_publish">
                                            <option value="">All</option>
                                            <option value="true">Published</option>
                                            <option value="false">Unpublished</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Active:</label>
                                        <select class="form-control" id="kt_datatable_search_active">
                                            <option value="">All</option>
                                            <option value="true">Active</option>
                                            <option value="false">Not Active</option>
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
        <!-- start:Schedule tour -->
        <div id="kt_datatable_modal" class="modal fade" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content" style="min-height: 590px;">
                    <div class="modal-header py-5">
                        <h5 class="modal-title">Lịch trình
                            <span class="d-block text-muted font-size-sm">Chi tiết lịch trình của Tour</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--begin: Datatable-->
                        <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable_sub"></div>
                        <!--end: Datatable-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold text-uppercase" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:Schedule tour -->
        <!--end::Card-->
    </div>
@endsection

