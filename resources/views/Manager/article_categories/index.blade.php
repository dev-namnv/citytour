@extends('layouts.manager.app')

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{asset('libraries/manager/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('libraries/manager/plugins/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('libraries/manager/plugins/table/datatable/custom_dt_multiple_tables.css')}}">
@endsection

@section('extra-js')
    <script src="{{asset('libraries/manager/plugins/table/datatable/datatables.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('table.multi-table').DataTable({
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7,
                drawCallback: function () {
                    $('.t-dot').tooltip({template: '<div class="tooltip status" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'})
                    $('.dataTables_wrapper table').removeClass('table-striped');
                }
            });
        });
    </script>
@endsection

@section('title', 'Articles List')

@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table class="multi-table table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($article_categories as $key => $article_category)
                                <tr>
                                    <td>{{$article_category->name}}</td>
                                    <td>{{$article_category->slug}}</td>
                                    <td>
                                        <span class="shadow-none badge {{ $article_category->active === ACTIVE ? 'badge-primary' : 'badge-danger' }}">
                                            {{ $article_category->getStatus() }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a  href="{{route('article_categories.edit', $article_category->id)}}" class="btn btn-primary mr-2">Edit</a>
                                            <form action="{{route('article_categories.destroy', $article_category->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection
