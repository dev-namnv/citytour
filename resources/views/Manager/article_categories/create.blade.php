@extends('layouts.manager.app')

@section('extra-css')
    <link href="{{asset('Libraries/Manager/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css">
    <style>
        .invalid-feedback {
            display: block;
        }
    </style>
@endsection

@section('title', 'Thêm danh mục bài viết')

@section('content')
    <div class="container">
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Thêm danh mục bài viết</h3>
            </div>
            <!--begin::Form-->
            <form method="POST" action="{{route('article_categories.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body ">
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="article_category_name">Tên danh mục</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="article_category_name" name="name" value="{{old('name')}}">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{route('article_categories.index')}}" class="btn btn-secondary">Quay lại</a>
                </div>

            </form>
            <!--end::Form-->
        </div>
    </div>

@endsection
