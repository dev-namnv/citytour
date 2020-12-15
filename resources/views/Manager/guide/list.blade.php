@extends('layouts.manager.app')

@section('title', 'Articles List')


@section('extra-js')
    <script>
        const showNotify = (message, status) => {
            $.notify({
                message,
            }, {
                type: status,
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
            })
        }

        @if(session()->has('flash_message') && session()->has('status'))
        console.log(`{{ session()->get('flash_message') . " with " .session()->get('status')}} `)
        showNotify("{{session()->get('flash_message')}}", "{{session()->get('status')}}")
        @endif

        const updateStatus = guide_id => {
            $.ajax({
                type: "POST",
                url: `${window.location.origin}/manager/guides/${guide_id}/updateStatus`,
                data: {
                    _method: "PUT",
                    _token: "{{csrf_token()}}",
                    status: $(`#radio_guide_${guide_id}`).children().children('[name="status"]:checked').val()
                },
                success: data => {
                    showNotify(data.flash_message, 'success')
                    $(`#update_status_modal_${guide_id}`).modal('toggle')
                    if (data.status == 0) {
                        $(`#status_guide_${guide_id}`).removeClass('text-success').addClass('text-danger').text('Khóa')
                    } else {
                        $(`#status_guide_${guide_id}`).removeClass('text-danger').addClass('text-success').text('Mở')
                    }
                },
                error: () => {
                    showNotify('Hướng dẫn viên không tồn tại', 'danger')
                }
            })
        }

        const updateBehaviorScore = guide_id => {
            $.ajax({
                type: "POST",
                url: `${window.location.origin}/manager/guides/${guide_id}/updateBehaviorScore`,
                data: {
                    _method: "PUT",
                    _token: "{{csrf_token()}}",
                    behavior_score: $(`#bh-${guide_id}`).val()
                },
                success: data => {
                    showNotify(data.flash_message, 'success')
                    $(`#update_behavior_score_modal_${guide_id}`).modal('toggle')
                    $(`#behavior_score_${guide_id}`).text(data.behavior_score)
                },
                error: err => {
                    showNotify(err.responseJSON.errors.behavior_score[0], 'danger')
                }
            })
        }

        const removeGuide = guide_id => {
            const x = confirm('Bạn có thực sự muốn xóa không?')
            if (x) {
                $.ajax({
                    type: "POST",
                    url: `${window.location.origin}/manager/guides/${guide_id}`,
                    data: {
                        _method: "DELETE",
                        _token: "{{csrf_token()}}",
                    },
                    success: data => {
                        console.log(data)
                        showNotify(data.flash_message, 'success')
                        $(`#guide_tr_${data.id}`).hide()
                    },
                    error: () => {
                        showNotify("Gặp lỗi khi xóa", 'danger')
                    }
                })
            }


        }
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h3 class="card-label">Danh sách hướng dẫn viên
                        </h3>
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
                                    <tr role="row">
                                        <th>Ảnh đại diện</th>
                                        <th>Tên tài khoản</th>
                                        <th>Họ và tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Trạng thái</th>
                                        <th>Điểm hành vi</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @foreach($guides as $key => $guide)
                                        <tr id="guide_tr_{{$guide->id}}">
                                            <td>
                                                <img src="{{$guide->avatar}}" alt="" width="100">
                                            </td>
                                            <td>{{$guide->username}}</td>
                                            <td>{{$guide->getFullName()}}</td>
                                            <td>{{$guide->email}}</td>
                                            <td>{{$guide->phone}}</td>
                                            <td>
                                                <span id="status_guide_{{$guide->id}}"
                                                      class="{{$guide->status == 0 ? 'text-danger' : 'text-success'}}">
                                                    {{$guide->status == 0 ? 'Khóa' : 'Mở'}}
                                                </span>
                                                <a href="javascript:;"
                                                   class="btn btn-sm btn-clean btn-icon mr-2"
                                                   title="Sửa trạng thái" data-toggle="modal"
                                                   data-target="#update_status_modal_{{$guide->id}}">
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
                                            </td>
                                            <td>
                                                <span
                                                    id="behavior_score_{{$guide->id}}">{{$guide->behavior_score}}</span>
                                                <a href="#"
                                                   class="btn btn-sm btn-clean btn-icon mr-2"
                                                   title="Sửa điểm hành vi" data-toggle="modal"
                                                   data-target="#update_behavior_score_modal_{{$guide->id}}">
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
                                            </td>
                                            <td>
                                                <button onclick="removeGuide({{$guide->id}})"
                                                        class="btn btn-sm btn-clean btn-icon"
                                                        title="Xóa hướng dẫn viên">
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
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="update_status_modal_{{$guide->id}}"
                                             style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Sửa trạng thái</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <i aria-hidden="true" class="ki ki-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form">
                                                            <div class="form-group row">
                                                                <label class="text-right col-lg-3 col-sm-12">Trạng
                                                                    thái</label>
                                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                                    <div class="radio-inline"
                                                                         id="radio_guide_{{$guide->id}}">
                                                                        <label class="radio">
                                                                            <input type="radio" value="0" name="status"
                                                                                   @if($guide->status == 0) checked @endif>
                                                                            <span></span>Khóa</label>
                                                                        <label class="radio">
                                                                            <input type="radio" value="1" name="status"
                                                                                   @if($guide->status == 1) checked @endif>
                                                                            <span></span>Mở</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary mr-2"
                                                                data-dismiss="modal">Đóng
                                                        </button>
                                                        <button type="submit" class="btn btn-secondary"
                                                                onclick="updateStatus({{$guide->id}})">Lưu
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="update_behavior_score_modal_{{$guide->id}}"
                                             style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Sửa điểm hành vi</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <i aria-hidden="true" class="ki ki-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form">
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label text-right col-lg-3 col-sm-12">Điểm
                                                                    hành vi</label>
                                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                                    <input type="text" class="form-control"
                                                                           name="behavior_score" id="bh-{{$guide->id}}"
                                                                           value="{{$guide->behavior_score}}">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary mr-2"
                                                                data-dismiss="modal">Đóng
                                                        </button>
                                                        <button type="submit" class="btn btn-secondary"
                                                                onclick="updateBehaviorScore({{$guide->id}})">Lưu
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="row justify-content-center">
                                    {{$guides->links()}}
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
