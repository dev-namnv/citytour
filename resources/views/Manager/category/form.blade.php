@extends('layouts.manager.app')

@section('title', isset($category) ? $category->name : 'Thêm danh mục')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('Libraries/Main/css/fontello/css/all-fontello.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">
                    {{ isset($category) ? $category->name : 'Thêm danh mục' }}
                </h3>
            </div>
            <!--begin::Form-->
            <form class="form" method="post" action="{{ isset($category) ? route('category.update', ['id' => $category->id]) : route('category.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Input</label>
                        <input type="text" name="name" value="{{ isset($category) ? $category->name : old('name') }}"
                               class="form-control form-control-solid @error('name') is-invalid @enderror" placeholder="Tên danh mục" required/>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="col-6 float-left">
                            <label>Icon</label>
                            <div class="select_icon">
                                <input type="hidden" name="icon" value="{{isset($category) ? $category->icon : old('icon')}}">
                                @foreach($icons as $icon)
                                    @if(isset($category) && $category->icon == $icon['icon'])
                                        <i class="icon {!! $icon['icon'] !!}" style="color: blue" data-value="{!! $icon['icon'] !!}"></i>
                                    @else
                                        <i class="icon {!! $icon['icon'] !!}" data-value="{!! $icon['icon'] !!}"></i>
                                    @endif
                                @endforeach
                            </div>
                            @error('icon')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 float-left">
                            <label>Thứ tự sắp xếp</label>
                            <input type="number" name="sort_order" value="{{ isset($category) ? $category->sort_order : old('sort_order') }}"
                                   class="form-control form-control-solid" placeholder="Thứ tự sắp xếp" />
                            @error('sort_order')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea">Mô tả</label>
                        <textarea name="description" class="form-control form-control-solid"
                                  rows="3">{{ isset($category) ? $category->description : old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">@if(isset($category)) Cập nhật @else Tạo mới @endif</button>
                    <button type="reset" class="btn btn-secondary">Hủy</button>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
@endsection

@section('extra-js')
    <script>
        $('.icon').click(function (){
            $('.icon').each(function (){
                $(this).removeAttr('style')
            })
            $(`input[name='icon']`).val($(this).data('value'));
            $(this).css('color','blue')
        })
    </script>
    @if(old('icon'))
        <script>
            $('.icon').each(function (){
                if ($(this).data('value') === '{{old('icon')}}') {
                    $(this).css('color','blue')
                }
            })
        </script>
    @endif
@endsection
