@extends('layouts.manager.app')

@section('title', 'Danh mục bài viết')

@section('extra-js')
    <script>
        const showNotify = (message, status) => {
            $.notify({
                message,
            }, {
                type: status,
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
            })
        }

        @if(session()->has('flash_message') && session()->has('status'))
        console.log(`{{ session()->get('flash_message') . " with " .session()->get('status')}} `)
        showNotify("{{session()->get('flash_message')}}", "{{session()->get('status')}}")
        @endif
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h3 class="card-label">Danh sách danh mục bài viết
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{route('article_categories.create')}}" class="btn btn-primary font-weight-bolder">Thêm mới</a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-checkable dataTable no-footer dtr-inline"
                                       id="kt_datatable" role="grid" aria-describedby="kt_datatable_info"
                                       style="width: 1149px;">
                                    <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Slug</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($article_categories as $key => $article_category)
                                        <tr>
                                            <td>{{$article_category->name}}</td>
                                            <td>{{$article_category->slug}}</td>
                                            <td class="text-center">
                                        <span class="shadow-none badge {{ $article_category->active == ACTIVE ? 'badge-primary' : 'badge-danger' }}">
                                            {{ $article_category->getStatus() }}
                                        </span>
                                            </td>
                                            <td nowrap="nowrap" class="text-center">

                                                <a href="{{route('article_categories.edit', $article_category->id)}}"
                                                   class="btn btn-sm btn-clean btn-icon mr-2"
                                                   title="Sửa bài viết">
                                                    <span class="svg-icon svg-icon-md">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px"
                                                            viewBox="0 0 24 24" version="1.1">
                                                            <g
                                                                stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect
                                                                    x="0" y="0" width="24" height="24">
                                                                </rect>
                                                                <path
                                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "></path>	                                        <rect
                                                                    fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                                    height="2"
                                                                    rx="1">
                                                                </rect>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                </a>


                                                <button onclick=" event.preventDefault()
                                                                const x =  confirm('Bạn có thực sự muốn xóa không?')
                                                                if (x) {
                                                                    document.getElementById('delete-form-{{$article_category->id}}').submit()
                                                                }"
                                                        class="btn btn-sm btn-clean btn-icon"
                                                        title="Xóa bài viết">
                                                    <span class="svg-icon svg-icon-md">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px"
                                                            viewBox="0 0 24 24" version="1.1">
                                                            <g
                                                                stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect
                                                                    x="0" y="0" width="24" height="24">

                                                                </rect>
                                                                <path
                                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                    fill="#000000" fill-rule="nonzero">

                                                                </path>
                                                                <path
                                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                    fill="#000000" opacity="0.3">

                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                </button>
                                                <form id="delete-form-{{$article_category->id}}"
                                                      action="{{route('article_categories.destroy', $article_category->id)}}"
                                                      method="POST" style="display: none">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>

                                <div class="justify-content-center row">
                                    {{$article_categories->links()}}
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
