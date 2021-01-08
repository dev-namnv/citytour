@extends('layouts.manager.app')

@section('title', 'Articles List')

@section('content')
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h3 class="card-label">Lịch sử & vị trí đăng nhập
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Ảnh đại diện</th>
                                        <th scope="col">Tài khoản</th>
                                        <th scope="col">Họ và Tên</th>
                                        <th scope="col">Chức năng</th>
                                        <th scope="col">Thời gian</th>
                                        <th scope="col">Ip</th>
                                        <th scope="col">Maps</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($logs as $key => $log)
                                        <tr id="guide_tr_{{$log->id}}">
                                            <td>{{$log->id}}</td>
                                            <td>
                                                <img src="{{$log->user->avatar}}" alt="" class="image rounded" width="60">
                                            </td>
                                            <td>{{$log->user->username}}</td>
                                            <td>{{$log->user->getFullName()}}</td>
                                            <td>{{$log->user->getRole()}}</td>
                                            <td>{{Carbon\Carbon::parse($log->updated_at)->format('d-m-Y H:i:s')}}</td>
                                            <td>{{$log->ip}}</td>
                                            <td>
                                                <a href="http://maps.google.co.uk/maps?q={{$log->latitude}},{{$log->longitude}}" target="_blank">
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Cooking\Dish.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M12,18 C15.3137085,18 18,15.3137085 18,12 C18,8.6862915 15.3137085,6 12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 Z" fill="#000000"/>
                                                            <path d="M12,16 C14.209139,16 16,14.209139 16,12 C16,9.790861 14.209139,8 12,8 C9.790861,8 8,9.790861 8,12 C8,14.209139 9.790861,16 12,16 Z" fill="#000000" opacity="0.3"/>
                                                        </g>
                                                    </svg><!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="row justify-content-center">
                                    {{$logs->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end: Datatable-->
                </div>
            </div>
        </div>
    </div>
@endsection
