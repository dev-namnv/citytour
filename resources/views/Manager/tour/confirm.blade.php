@extends('layouts.manager.app')
@section('title', 'Tour - Confirm')

@section('extra-css')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('Libraries/Manager/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Libraries/Manager/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Libraries/Manager/plugins/table/datatable/dt-global_style.css') }}">
    <!-- END PAGE LEVEL CUSTOM STYLES -->
@endsection

@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">
            <div class="widget-content widget-content-area br-6 ml-3">

            </div>
        </div>

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table class="table table-hover non-hover" style="width:100%">
                            <thead>
                            <tr class="text-center">
                                <th>Tên</th>
                                <th>Thumb</th>
                                <th>Địa Chỉ</th>
                                <th>Danh Mục</th>
                                <th>Giá/Người</th>
                                <th>HDV</th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tours as $key =>$tour)
                                <tr>
                                    <td>{{$tour->name}}</td>
                                    <td>
                                        <img src="{{$tour->thumbnail}}" alt="{{$tour->name}}" width="80"/>
                                    </td>
                                    <td>{{$tour->address}}</td>
                                    <td>{{$tour->category->name}}</td>
                                    <td>
                                        <span class="d-block">Người lớn:</span>
                                        <span class="text-danger">{{ $tour->adult_price }}</span>
                                        <br/>
                                        <span class="d-block">Trẻ em:</span>
                                        <span class="text-danger">{{ $tour->adult_price }}</span>
                                    </td>
                                    <td>
                                        <a href="#">{{ $tour->guide->first_name . ' ' .$tour->guide->last_name }}</a>
                                    </td>
                                    <td class="tour-status-{{ $tour->id }}">
                                        <div class="t-dot bg-{{$tour->getColor()}}" data-toggle="tooltip" data-placement="top" data-original-title="{{$tour->getStatus()}}"></div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('tour-edit',$tour->id)}}" class="btn btn-sm">Open</a>
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                                <a class="dropdown-item" href="#active" tour-id="{{ $tour->id }}" onclick="Admin.tourConfirmActive(this)">{{ $tour->active == 0 ?  'Public':'Private' }}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$tours->links()}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('extra-js')
    <script type="javascript">
        $(document).ready(function (){
            function active(id) {
                $.ajax({
                    url: {{ route('tour-set-active') }},
                    type: 'POST',
                    data: {
                        method : 'PUT',
                        tour_id : id
                    },
                }).done(function (res) {
                    console.log(res)
                }).error(function (error) {
                    console.log(error)
                })
            }
        })
    </script>
    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/datatables.js') }}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
@endsection
