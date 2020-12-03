@extends('layouts.manager.app')

@section('extra-css')
    <link href="{{asset('libraries/manager/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css">
    <style>
        .invalid-feedback {
            display: block;
        }
    </style>
@endsection

@section('title', 'Article Category Create')

@section('content')
    <div class="container">
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Thêm bài viết</h3>
            </div>
            <!--begin::Form-->
            <form method="POST" class="form-create-article-category" action="{{route('article_categories.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body ">
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="article_category_name">Tên danh mục</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="article_title" name="name" value="{{old('name')}}">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <button onclick="window.history.go(-1); return false;" class="btn btn-secondary">Quay lại</button>
                </div>

            </form>
            <!--end::Form-->
        </div>
    </div>

@endsection
