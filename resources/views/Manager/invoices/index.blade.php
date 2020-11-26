@extends('layouts.manager.app')
@section('title', 'Invoices')

@section('extra-css')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('Libraries/Manager/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Libraries/Manager/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Libraries/Manager/plugins/table/datatable/dt-global_style.css') }}">
    <!-- END PAGE LEVEL CUSTOM STYLES -->
@endsection

@section('content')
    <div class="container bg-white">

        <div class="row layout-top-spacing">
            <div class="widget-content widget-content-area br-6 ml-3">

            </div>
        </div>

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table class="table table-hover non-hover text-center" style="width:100%">
                            <thead>
                            <tr class="text-center">
                                <th>Tên tour</th>
                                <th>Thumbnail</th>
                                <th>Tên khách hàng</th>
                                <th>Địa chỉ khách hàng</th>
                                <th>Số người </th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $key => $invoice)
                                <tr>
                                    <td>
                                        <p>{{$invoice->invoice_detail->name}}</p>
                                        <span class="small">{{$invoice->sku}}</span>
                                    </td>
                                    <td>
                                        <img src="{{$invoice->invoice_detail->thumbnail}}" alt="{{$invoice->invoice_detail->name}}" width="80"/>
                                    </td>
                                    <td>{{ $invoice->customer_name }}</td>
                                    <td>{{ $invoice->customer_address }}</td>
                                    <td>
                                        <span class="d-block">Người lớn:</span>
                                        <span class="text-danger">{{ $invoice->adult_count }}</span>
                                        <br/>
                                        <span class="d-block">Trẻ em:</span>
                                        <span class="text-danger">{{ $invoice->child_count }}</span>
                                    </td>
                                    <td>
                                         <span class="tour-status-{{ $invoice->id }} rounded p-1 {{ $invoice->getColor() }}">
                                                {{ $invoice->getStatus() }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('tour-edit',$invoice->id)}}" class="btn btn-sm btn-light">Open</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$invoices->links()}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('extra-js')
    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/datatables.js') }}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
@endsection
