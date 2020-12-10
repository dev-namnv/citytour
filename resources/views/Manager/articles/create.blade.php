@extends('layouts.manager.app')



@section('extra-js')
    <script src="{{asset('libraries/manager/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
    <script src="{{asset('libraries/manager/js/pages/crud/forms/widgets/tagify.js')}}"></script>

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

@section('title', 'Thêm bài viết')

@section('content')
    <div class="container">
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Thêm bài viết</h3>
            </div>
            <!--begin::Form-->
            <form method="POST" class="form-article-create" action="{{route('articles.store')}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="article_title">Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="article_title" name="title" value="{{old('title')}}">
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group ">
                        <label for="article_heading">Phần mở đầu</label>
                        <input type="text"
                               class="form-control @error('heading') is-invalid @enderror"
                               id="article_heading" name="heading" value="{{old('heading')}}">
                        @error('heading')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="article_category">Danh mục bài viết</label>
                        <div></div>
                        <select title="Hãy chọn danh mục bài viết" name="category_ids[]" id="article_category"
                                class="selectpicker custom-select form-control @error('category_ids') is-invalid @enderror"
                                multiple>
                            @foreach($article_categories as $key => $category)
                                <option
                                    value="{{$category->id}}" {{!empty(old('category_ids')) && in_array($category->id, old('category_ids'))   ? "selected" : ""}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="article_image">Ảnh</label>
                        <div></div>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="article_image"
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/*">
                            <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                        </div>
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Thẻ (Tag)</label>
                        <input id="kt_tagify_1" class="form-control tagify @error('tags') is-invalid @enderror"
                               value="{{old('tags')}}" name="tags" placeholder="type..." autofocus="">
                        @error('tags')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
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
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Lưu</button>
                    <a href="{{route('articles.index')}}" class="btn btn-secondary">Quay lại</a>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
@endsection
