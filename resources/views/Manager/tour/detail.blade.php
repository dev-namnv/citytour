@extends('layouts.manager.app')

@section('title', $tour->name)

@section('extra-css')
    <link href="{{ asset('libraries/manager/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/manager/assets/css/forms/switches.css') }}">
@endsection

@section('extra-js')
    <script src="{{ asset('libraries/manager/assets/js/scrollspyNav.js') }}"></script>
    <script>
        CKEDITOR.replace('service_desc_editor', {
            extraPlugins: ['easyimage'],
            removePlugins: 'image',
            cloudServices_tokenUrl: 'https://73727.cke-cs.com/token/dev/a19a88823af692f3cade293c34caa258c0615e44972466b8891f7647319f',
            cloudServices_uploadUrl: 'https://73727.cke-cs.com/easyimage/upload/'
        });

        CKEDITOR.replace('service_content_editor', {
            extraPlugins: ['easyimage'],
            removePlugins: 'image',
            cloudServices_tokenUrl: 'https://73727.cke-cs.com/token/dev/a19a88823af692f3cade293c34caa258c0615e44972466b8891f7647319f',
            cloudServices_uploadUrl: 'https://73727.cke-cs.com/easyimage/upload/'
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mt-lg-3">
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Chi tiết Tour: {{ $tour->name }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form class="form-service-create" method="post" action="{{ route('tour-store') }}">
                            @csrf
                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputName">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName"
                                           value="{{ old('name') }}" placeholder="Tên Tour">
                                    @error('name')
                                    <span id="password-error" class="is-invalid invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Slug</label>
                                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="inputPassword4"
                                           value="{{ old('slug') }}" placeholder="Đường dẫn URL">
                                    @error('slug')
                                    <span id="password-error" class="is-invalid invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="pac-input">Address</label>
                                <input type="text" name="address" class="form-control" id="pac-input"
                                       value="{{ old('address') }}" placeholder="số 5 Phạm Văn Đồng ...">
                                @error('address')
                                <span id="password-error" class="is-invalid invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div id="map"></div>
                            </div>
                            <div class="form-group">
                                <label for="service_desc_editor">Description</label>
                                <textarea class="@error('description') is-invalid @enderror" name="description" id="service_desc_editor" rows="10" cols="80">
                                {{old('description')}}
                            </textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="service_content_editor">Content</label>
                                <textarea class="@error('content') is-invalid @enderror" name="content" id="service_content_editor" rows="10" cols="80">
                                {{old('content')}}
                            </textarea>
                                @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-check pl-0">
                                    <div class="custom-control custom-checkbox checkbox-info">
                                        <input type="checkbox" checked class="custom-control-input" id="gridCheck">
                                        <label class="custom-control-label" for="gridCheck">Active</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        CKEDITOR.replace('service_desc_editor', {
            extraPlugins: ['easyimage'],
            removePlugins: 'image',
            cloudServices_tokenUrl: 'https://73727.cke-cs.com/token/dev/a19a88823af692f3cade293c34caa258c0615e44972466b8891f7647319f',
            cloudServices_uploadUrl: 'https://73727.cke-cs.com/easyimage/upload/'
        });

        CKEDITOR.replace('service_content_editor', {
            extraPlugins: ['easyimage'],
            removePlugins: 'image',
            cloudServices_tokenUrl: 'https://73727.cke-cs.com/token/dev/a19a88823af692f3cade293c34caa258c0615e44972466b8891f7647319f',
            cloudServices_uploadUrl: 'https://73727.cke-cs.com/easyimage/upload/'
        });
    </script>
@endsection
