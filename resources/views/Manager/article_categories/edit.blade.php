@extends('layouts.manager.app')



@section('title', 'Sửa danh mục bài viết')

@section('content')
    <div class="container">
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Sửa danh mục bài viết</h3>
            </div>
            <!--begin::Form-->
            <form method="POST" class="form-edit-article-category" action="{{route('article_categories.update', $article_category->id)}}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="article_category_name">Tên danh mục</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="article_title" name="name" value="{{old('name', $article_category->name)}}">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <div class="radio-inline @error('active') is-invalid @enderror">
                                <label class="radio">
                                    <input type="radio" value="{{NOT_ACTIVE}}" name="active" @if(old('active', $article_category->active) == NOT_ACTIVE) checked @endif>
                                    <span></span>Ẩn</label>
                                <label class="radio">
                                    <input type="radio" value="{{ACTIVE}}" name="active" @if(old('active', $article_category->active) == ACTIVE) checked @endif>
                                    <span></span>Hiện</label>
                            </div>
                            @error('active')
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
