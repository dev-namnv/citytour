@extends('layouts.manager.app')

@section('extra-css')
    <link href="{{asset('Libraries/Manager/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css">
    <style>
        .invalid-feedback {
            display: block;
        }
    </style>
@endsection

@section('extra-js')
    <script src="{{asset('Libraries/Manager/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
    <script>
        // Class definition

        var KTCkeditor = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create(document.querySelector('#kt-ckeditor-1'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function () {
            KTCkeditor.init();
        });
    </script>
@endsection

@section('title', 'Thêm FAQ')

@section('content')
    <div class="container">
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Thêm FAQ</h3>
            </div>
            <!--begin::Form-->
            <form method="POST" action="{{route('faqs.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body ">
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="heading_faq">Phần mở đầu</label>
                            <input type="text" class="form-control @error('heading') is-invalid @enderror" id="heading_faq" name="heading" value="{{old('heading')}}">
                            @error('heading')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group ">
                            <label for="kt-ckeditor-1">Nội dung bài viết</label>
                            <div class="card card-custom">
                                <div class="card-body">
                                <textarea name="content" class="@error('content') is-invalid @enderror"
                                          id="kt-ckeditor-1">
                                    {{old('content')}}
                                </textarea>
                                </div>
                            </div>
                            @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{route('faqs.index')}}" class="btn btn-secondary">Quay lại</a>
                </div>

            </form>
            <!--end::Form-->
        </div>
    </div>

@endsection
