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
    <div class="container" style="max-width: 100%!important;">
        <div class="container">
            <div class="row">
                <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Article Category Create</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form method="POST" class="form-create-article-category" action="{{route('article_categories.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-6">
                                        <div class="form-group ">
                                            <label for="article_category_name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="article_title" name="name" value="{{old('name')}}">
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
