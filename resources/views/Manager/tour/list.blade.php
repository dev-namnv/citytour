@extends('layouts.manager.app')

@section('title', 'Quản lý Tour')

@section('extra-css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('libraries/manager/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('libraries/manager/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('libraries/manager/plugins/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('libraries/manager/assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('libraries/manager/plugins/table/datatable/custom_dt_custom.css') }}">
@endsection

@section('extra-js')
    <script src="{{ asset('libraries/manager/plugins/table/datatable/datatables.js') }}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script
        src="{{ asset('libraries/manager/plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('libraries/manager/plugins/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('libraries/manager/plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('libraries/manager/plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    <script>
        $('#html5-extension').DataTable({
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    {extend: 'copy', className: 'btn'},
                    {extend: 'csv', className: 'btn'},
                    {extend: 'excel', className: 'btn'},
                    {extend: 'print', className: 'btn'}
                ]
            },
            "oLanguage": {
                "sInfo": "Hiện thị trang _PAGE_ của {{ $tours->lastPage() }} trang",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Tìm kiếm ...",
                "sLengthMenu": "Kết quả :  _MENU_",
            },
            paging: false
        });
    </script>
@endsection

@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tour</th>
                                <th>Địa chỉ</th>
                                <th>Giá hiện tại</th>
                                <th>Danh mục</th>
                                <th>Trạng thái</th>
                                @if(Auth::user()->role === ADMIN)
                                    <th>Trạng thái</th>
                                @endif
                                <th>Đánh giá</th>
                                <th>Tùy chọn</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tours as $key => $tour)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $tour->name }}</td>
                                    <td>{{ $tour->address }}</td>
                                    <td>{{ $tour->getCurrentPrice() }}</td>
                                    <td>{{ $tour->category->name }}</td>
                                    <td class="">
                                        <span class="tour-status-{{$tour->id}} shadow-none badge {{ $tour->active ? 'badge-primary' : 'badge-danger' }}">
                                            {{ $tour->getStatus() }}
                                        </span>
                                    </td>
                                    @if(Auth::user()->role === ADMIN)
                                        <td class="">
                                        <span class="tour-status-{{$tour->id}} shadow-none badge {{ $tour->deleted_at ? 'badge-danger' : 'badge-primary' }}">
                                            {{ $tour->getStatusDelete() }}
                                        </span>
                                        </td>
                                    @endif
                                    <td>{{ $tour->rating }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('tour-edit', ['id' => $tour->id]) }}" type="button" class="btn btn-dark btn-sm">Open</a>
                                            <button type="button"
                                                    class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split"
                                                    id="dropdownMenuReference1" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false" data-reference="parent">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2"
                                                     stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-chevron-down">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                                <a class="dropdown-item" href="javascript:void(0)" tour-id="{{ $tour->id }}" onclick="Admin.tourSetActive(this)">@if($tour->active) Khóa dịch vụ @else Mở dịch vụ @endif</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Separated link</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="float-right">
                            {{ $tours->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
