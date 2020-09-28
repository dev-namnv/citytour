@extends('layouts.manager.app')
@section('title', 'Contacts')

@section('extra-css')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('Libraries/Manager/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Libraries/Manager/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Libraries/Manager/plugins/table/datatable/dt-global_style.css') }}">
    <!-- END PAGE LEVEL CUSTOM STYLES -->
@endsection

@section('extra-js')
    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/datatables.js') }}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('Libraries/Manager/plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    <script>
        $('#html5-extension').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn' },
                    { extend: 'csv', className: 'btn' },
                    { extend: 'excel', className: 'btn' },
                    { extend: 'print', className: 'btn' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        } );
    </script>
@endsection

@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table class="table table-hover non-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Email</th>
                                <th>ip</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $key =>$contact)
                                    <tr>
                                        <td>{{$contact->full_name}}</td>
                                        <td>{{$contact->subject}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->geoip}}</td>
                                        <td>{{$contact->created_at}}</td>
                                        <td>{{$contact->updated_at}}</td>
                                        <td>
                                            <div class="t-dot bg-{{$contact->getColor()}}" data-toggle="tooltip" data-placement="top" data-original-title="{{$contact->getStatus()}}"></div>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('contacts.show',$contact->id)}}" class="btn btn-sm">Open</a>
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                                    <a class="dropdown-item" href="{{route('contacts.update',['id'=>$contact->id,'status'=>TICKET_ANSWERED])}}">Đã Phản hồi</a>
                                                    <a class="dropdown-item" href="{{route('contacts.update',['id'=>$contact->id,'status'=>TICKET_WAITING_FOR_PROGRESS])}}">Đang chờ xử lý</a>
                                                    <a class="dropdown-item" href="{{route('contacts.update',['id'=>$contact->id,'status'=>TICKET_PROCESSING])}}">Đang xử lý</a>
                                                    <a class="dropdown-item" href="{{route('contacts.update',['id'=>$contact->id,'status'=>TICKET_CLOSED])}}">Đẫ đóng</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
