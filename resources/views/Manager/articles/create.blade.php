@extends('layouts.manager.app')

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{asset('libraries/manager/plugins/bootstrap-select/bootstrap-select.min.css')}}">
    <link href="{{asset('libraries/manager/plugins/tagInput/tags-input.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('libraries/manager/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css">
    <style>
        .invalid-feedback {
            display: block;
        }

        .tags-input-wrapper input {
            margin: 0 auto;
        }
    </style>
@endsection

@section('extra-js')
    <script src="{{asset('libraries/manager/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('libraries/manager/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('libraries/manager/plugins/tagInput/tags-input.js')}}"></script>
    <script>
        // Block Enter event
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });

        var instance = new TagsInput({
            selector: 'tags'
        });
        instance.addData(
            $('#tags').val() !== "" ? $('#tags').val().split(',') : ""
        )


    </script>
@endsection

@section('title', 'Articles Create')

@section('content')
    <div class="container" style="max-width: 100%!important;">
        <div class="container">
            <div class="row">
                <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Articles Create</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form method="POST" class="form-article-create" action="{{route('articles.store')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-6">
                                        <div class="form-group ">
                                            <label for="article_title">Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                   id="article_title" name="title" value="{{old('title')}}">
                                            @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group ">
                                            <label for="article_heading">Heading</label>
                                            <input type="text"
                                                   class="form-control @error('heading') is-invalid @enderror"
                                                   id="article_heading" name="heading" value="{{old('heading')}}">
                                            @error('heading')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="article_category">Category</label>
                                            <select name="category_ids[]" id="article_category"
                                                    class="selectpicker @error('category_ids') is-invalid @enderror" multiple>
                                                @foreach($article_categories as $key => $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_ids')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="article_image">Image</label>
                                            <input type="file" name="image" id="article_image"
                                                   class="form-control @error('image') is-invalid @enderror"
                                                   accept="image/*">
                                            @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tags">Tag</label>
                                            <input type="text" name="tags" id="tags" class="@error('tags') is-invalid @enderror" value="{{ old('tags') }}">
                                            @error('tags')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="article_content">Content</label>
                                            <textarea class="@error('content') is-invalid @enderror" name="content"
                                                      id="articles_content_editor" rows="10" cols="80">
                                                {{old('content')}}
                                            </textarea>
                                            @error('content')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <script>
                                                CKEDITOR.replace('articles_content_editor', {
                                                    extraPlugins: ['easyimage'],
                                                    removePlugins: 'image',
                                                    cloudServices_tokenUrl: 'https://73727.cke-cs.com/token/dev/a19a88823af692f3cade293c34caa258c0615e44972466b8891f7647319f',
                                                    cloudServices_uploadUrl: 'https://73727.cke-cs.com/easyimage/upload/'
                                                });
                                            </script>
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
