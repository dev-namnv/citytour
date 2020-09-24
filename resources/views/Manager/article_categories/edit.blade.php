@extends('layouts.manager.app')

@section('extra-css')
    <link href="{{asset('libraries/manager/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('libraries/manager/assets/css/forms/theme-checkbox-radio.css')}}">
    <style>
        .invalid-feedback {
            display: block;
        }
    </style>
@endsection

@section('title', 'Article Category Edit')

@section('content')
    <div class="container" style="max-width: 100%!important;">
        <div class="container">
            <div class="row">
                <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Article Category Edit</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form method="POST" class="form-create-article-category" action="{{route('article_categories.update', $article_category->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row ">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="article_category_name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="article_title" name="name" value="{{old('name', $article_category->name)}}">
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-primary">
                                                    <input type="radio" class="new-control-input" value="{{ACTIVE}}" name="active" @if($article_category->active === ACTIVE) checked @endif>
                                                    <span class="new-control-indicator"></span>Active
                                                </label>
                                                <div class="n-chk">
                                                    <label class="new-control new-radio radio-danger">
                                                        <input type="radio" class="new-control-input" value="{{NOT_ACTIVE}}" name="active" @if($article_category->active === NOT_ACTIVE) checked @endif>
                                                        <span class="new-control-indicator"></span>Not Active
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                <a href="{{route('article_categories.index')}}" type="button" class="btn btn-secondary mt-3 ml-1">Go Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
