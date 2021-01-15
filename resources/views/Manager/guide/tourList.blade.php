@extends('layouts.manager.app')

@section('content')
    <div class="container bg-white">
        <div class="row layout-top-spacing">
            <div class="widget-content widget-content-area br-6 ml-3">
                <ul class="nav">
                    <li class="nav-item m-3 {{ config('masterdata')['invoice']['color'][0] }}">
                        <a class="nav-link text-white" href="?status=0">{{ config('masterdata')['invoice']['status'][0] }}</a>
                    </li>
                    <li class="nav-item m-3 {{ config('masterdata')['invoice']['color'][1] }}">
                        <a class="nav-link text-white" href="?status=1">{{ config('masterdata')['invoice']['status'][1] }}</a>
                    </li>
                    <li class="nav-item m-3 {{ config('masterdata')['invoice']['color'][2] }}">
                        <a class="nav-link text-white" href="?status=2">{{ config('masterdata')['invoice']['status'][2] }}</a>
                    </li>
                    <li class="nav-item m-3 {{ config('masterdata')['invoice']['color'][3] }}">
                        <a class="nav-link" href="?status=3">{{ config('masterdata')['invoice']['status'][3] }}</a>
                    </li>
                    <li class="nav-item m-3 {{ config('masterdata')['invoice']['color'][4] }}">
                        <a class="nav-link text-white" href="?status=4">{{ config('masterdata')['invoice']['status'][4] }}</a>
                    </li>
                    <li class="nav-item m-3 {{ config('masterdata')['invoice']['color'][5] }}">
                        <a class="nav-link text-white" href="?status=5">{{ config('masterdata')['invoice']['status'][5] }}</a>
                    </li>
                    <li class="nav-item m-3 {{ config('masterdata')['invoice']['color'][6] }}">
                        <a class="nav-link text-white" href="?status=6">{{ config('masterdata')['invoice']['status'][6] }}</a>
                    </li>
                    <li class="nav-item m-3">
                        <a class="nav-link text-dark" href="{{ route('invoice-index') }}">Tất cả</a>
                    </li>
                </ul>
            </div>
        </div>

        <hr/>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table class="table table-hover non-hover text-center" style="width:100%">
                            <thead>
                            <tr class="text-center">
                                <th>Tên tour</th>
                                <th>Ảnh thu nhỏ</th>
                                <th>Tên khách hàng</th>
                                <th>Ngày khởi hành</th>
                                <th>Số người </th>
                                <th>Trạng Thái</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $key => $invoice)
                                <tr>
                                    <td>
                                        <p>{{$invoice->invoice_detail->name}}</p>
                                    </td>
                                    <td>
                                        <img src="{{$invoice->invoice_detail->thumbnail}}" alt="{{$invoice->invoice_detail->name}}" width="80"/>
                                    </td>
                                    <td>{{ $invoice->customer_name }}</td>
                                    <td>{{ date_format(new DateTime($invoice->start_date),'d-m-Y') }}</td>
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
                                        @if($invoice->status == 3)
                                            <div class="btn-group">
                                                <a href="{{ route('step1',['slug' =>$invoice->tour->slug]) }}" class="btn btn-sm btn-light">Open</a>
                                            </div>
                                        @endif
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

@endsection

