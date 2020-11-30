@extends('layouts.manager.app')

@section('title', $tour->name )

@section('extra-css')
    <link href="{{ asset('Libraries/Manager/plugins/summernote/summernote.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container bg-white pt-2 pb-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tab1">Tour</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab2">lịch trình</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab3">Ngày khởi hành</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <form action="{{ route('tour-store') }}" method="post" enctype="multipart/form-data" id="formAddTour" >
            @csrf
            <div class="tab-content">
                <div id="tab1" class="container tab-pane active"><br>
                    <div class="row">
                        <div class="col-xl-10 ml-auto">
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-2 col-lg-2 col-form-label">Tên tour<span class="text-danger">*</span></label>
                                <div class="col-lg-8 col-xl-8">
                                    <input class="form-control form-control-lg form-control-solid" name="tour_name"
                                           type="text" data-label="Tên tour" placeholder="Tên tour" required>
                                    <div class="fv-plugins-message-container"></div>
                                </div>
                            </div>
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-2 col-lg-2 col-form-label">Địa chỉ<span class="text-danger">*</span></label>
                                <div class="col-lg-8 col-xl-8">
                                    <input class="form-control form-control-lg form-control-solid" name="tour_address"
                                           type="text" placeholder="Địa chỉ" data-label="Địa chỉ" required>
                                    <div class="fv-plugins-message-container"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-2 col-lg-2 col-form-label">Ảnh thu nhỏ (800x533)<span class="text-danger">*</span></label>
                                <div class="col-lg-8 col-xl-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputThumb" name="thumbnail" placeholder="thumbnail" data-label="thumbnail" accept=".png, .jpg, .jpeg" required>
                                        <label class="custom-file-label" for="inputThumb" aria-describedby="inputGroupFileAddon">Choose image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-2 col-lg-2 col-form-label">Ảnh bìa (1450x750)<span class="text-danger">*</span></label>
                                <div class="col-lg-8 col-xl-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="Banner" name="banner" accept=".png, .jpg, .jpeg" placeholder="banner" data-label="banner" required>
                                        <label class="custom-file-label" for="Banner" aria-describedby="inputGroupFileAddon">Choose image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-2 col-lg-2 col-form-label">Giá người lớn<span class="text-danger">*</span></label>
                                <div class="col-lg-3 col-xl-3">
                                    <input class="form-control form-control-lg form-control-solid" name="price_adult"
                                           type="number" min="0" placeholder="Giá người lớn" data-label="Giá người lớn" required>
                                    <div class="fv-plugins-message-container"></div>
                                </div>
                                <label class="col-xl-2 col-lg-2 col-form-label text-right">Giá trẻ em<span class="text-danger">*</span></label>
                                <div class="col-lg-3 col-xl-3">
                                    <input class="form-control form-control-lg form-control-solid" name="price_child"
                                           type="number" min="0" placeholder="Giá trẻ em" data-label="Giá trẻ em" required>
                                    <div class="fv-plugins-message-container"></div>
                                </div>
                            </div>
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-2 col-lg-2 col-form-label">Danh mục<span class="text-danger">*</span></label>
                                <div class="col-lg-8 col-xl-8">
                                    <select class="form-control bg-light" name="tour_category" required data-label="Danh mục">
                                        <option value="">Danh mục</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container"></div>
                                </div>
                            </div>
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-2 col-lg-2 col-form-label">Trạng thái hiển thị</label>
                                <!-- Default checked -->
                                <div class="col-lg-8 col-xl-8 custom-control custom-switch">
                                    <input type="checkbox" name="publish" data-toggle="switchbutton" checked data-size="sm">
                                </div>
                            </div>
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-2 col-lg-2 col-form-label">Mô tả<span class="text-danger">*</span></label>
                                <div class="col-lg-8 col-xl-8">
                                <textarea class="form-control form-control-lg form-control-solid" id="description" name="tour_description" required data-label="Mô tả">
                                </textarea>
                                    <div class="fv-plugins-message-container"></div>
                                </div>
                            </div>
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-2 col-lg-2 col-form-label">Ghi chú<span class="text-danger">*</span></label>
                                <div class="col-lg-8 col-xl-8">
                                <textarea class="form-control form-control-lg form-control-solid" id="note" name="tour_note" required data-label="Ghi chú">
                                </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-2 col-lg-2 col-form-label">Ảnh slide (800x375)</label>
                                <div class="col-lg-8 col-xl-8 form-group" id="sliders">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="Slider" name="slide[]" accept=".png, .jpg, .jpeg" onchange="addSlide(1)">
                                        <label class="custom-file-label" for="Slider" aria-describedby="inputGroupFileAddon">Choose image</label>
                                    </div>
                                    <div class="custom-file mt-2 d-none">
                                        <input type="file" class="custom-file-input" id="Slider1" name="slide[]" accept=".png, .jpg, .jpeg" onchange="addSlide(2)">
                                        <label class="custom-file-label" for="Slider1" aria-describedby="inputGroupFileAddon">Choose image</label>
                                    </div>
                                    <div class="custom-file mt-2 d-none">
                                        <input type="file" class="custom-file-input" id="Slider2" name="slide[]" accept=".png, .jpg, .jpeg" onchange="addSlide(3)">
                                        <label class="custom-file-label" for="Slider2" aria-describedby="inputGroupFileAddon">Choose image</label>
                                    </div>
                                    <div class="custom-file mt-2 d-none">
                                        <input type="file" class="custom-file-input" id="Slider3" name="slide[]" accept=".png, .jpg, .jpeg" onchange="addSlide(4)">
                                        <label class="custom-file-label" for="Slider3" aria-describedby="inputGroupFileAddon">Choose image</label>
                                    </div>
                                    <div class="custom-file mt-2 d-none">
                                        <input type="file" class="custom-file-input" id="Slider4" name="slide[]" accept=".png, .jpg, .jpeg" onchange="addSlide(5)">
                                        <label class="custom-file-label" for="Slider4" aria-describedby="inputGroupFileAddon">Choose image</label>
                                    </div>
                                    <div class="custom-file mt-2 d-none">
                                        <input type="file" class="custom-file-input" id="Slider5" name="slide[]" accept=".png, .jpg, .jpeg">
                                        <label class="custom-file-label" for="Slider5" aria-describedby="inputGroupFileAddon">Choose image</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-2 float-right">
                        <div class="col-lg-auto">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link btn btn-success" onclick="nextStep(1)" data-toggle="tab" href="#tab2">Tiếp theo</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="tab2" class="container tab-pane fade"><br>
                    <h3>Lịch trình chuyến đi</h3>
                    <div class="row" id="schedule">
                        <div class="col-xl-10 ml-auto">
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-2 col-lg-2 col-form-label">Ngày 1<span class="text-danger">*</span></label>
                                <div class="col-lg-8 col-xl-8">
                                <textarea class="form-control form-control-lg form-control-solid" id="schedule1" name="schedule[]" required data-label="Lịch trình">
                                </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10 ml-auto">
                            <a href="#add" class="btn btn-secondary" onclick="addSchedule()">Thêm +</a>
                        </div>
                    </div>
                    <div class="row col-2 float-right">
                        <div class="col-lg-auto">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link btn btn-success" onclick="nextStep(2)" data-toggle="tab" href="#tab3">Tiếp theo</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="tab3" class="container tab-pane fade"><br>
                    <h3>Ngày khởi hành<span class="text-danger">*</span></h3>
                    <div class="row" id="batches">
                        <div class="col-xl-10 ml-auto">
                            <div class="form-group row m-3 fv-plugins-icon-container">
                                <div class="col-lg-3 col-xl-3">
                                    <input class="form-control" name="batches[]" type="date" id="example-date-input" required data-label="Ngày khởi hành">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10 ml-auto">
                            <a href="#add" class="btn btn-secondary" onclick="addBatch()">Thêm +</a>
                        </div>
                    </div>
                    <div class="row col-4 float-right">
                        <div class="col-lg-auto">
                            <button class="btn btn-info" type="submit" id="submit">Hoàn thành</button>
                        </div>
                    </div>
                    <div class="d-flex mt-6"></div>
                    <div class="row">
                        <div class="col-xl-10 ml-auto text-center error_message">
                            <!--//-->
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('extra-js')
    <!-- include summernote css/js -->
    <script src="{{ asset('Libraries/Manager/plugins/summernote/summernote.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'Mô tả',
                tabsize: 2,
                height: 250,
            });
            $('#note').summernote({
                placeholder: 'Ghi chú',
                tabsize: 2,
                height: 180,
            });
            $('#schedule1').summernote({
                placeholder: 'Lịch trình',
                tabsize: 2,
                height: 200,
            });
        });

        function addSlide(index) {
            $('#sliders').children().eq(index).removeClass('d-none')
        }

        function nextStep(index) {
            $(`.nav-tabs`).children().children().removeClass('active');
            setTimeout(function (){
                $(`a[href='#tab${index+1}']`).addClass('active')
            },300);
        }

        function addSchedule() {
            let index = $(`#schedule`).children().length + 1;
            $(`#schedule`).append(`
                <div class="col-xl-10 ml-auto">
                    <div class="form-group row fv-plugins-icon-container">
                        <label class="col-xl-2 col-lg-2 col-form-label">Ngày ${index}</label>
                        <div class="col-lg-8 col-xl-8">
                            <div class="bg-danger text-danger col-lg-12 col-xl-12 mb-0" onclick="$(this).parent().remove();">//</div>
                            <textarea class="form-control form-control-lg form-control-solid" id="schedule${index}" name="schedule[]" required data-label="Lịch Trình">
                            </textarea>
                        </div>
                    </div>
                </div>
            `)

            $(`#schedule${index}`).summernote({
                tabsize: 2,
                height: 200,
            });
        }
        function addBatch() {
            $(`#batches`).children().append(`
                <div class="form-group row m-3 fv-plugins-icon-container">
                    <div class="col-lg-3 col-xl-3">
                        <div class="bg-danger text-danger col-lg-12 col-xl-12 mb-0 small" onclick="$(this).parent().parent().remove();">--</div>
                        <input class="form-control" name="batches[]" type="date" id="example-date-input" required data-label="Ngày khởi hành">
                    </div>
                </div>
            `)
        }

        $(`#submit`).on('click',function (){
            $(`.error_message`).text('');
            $(`input[required],select[required],textarea[required]`).each(function (){
                let label = $(this).data('label') ?? 'TextArea';
                if ($(this).val() == ''){
                    $(`.error_message`).append(`
                        <p class="alert-danger d-inline-block">${label} không được để trống.</p><br/>
                    `)
                }
            })
        })

    </script>
@endsection
