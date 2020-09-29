@extends('layouts.manager.app')

@section('extra-css')
    <link rel="stylesheet" type="text/css"
          href="{{asset('libraries/manager/plugins/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('libraries/manager/plugins/table/datatable/custom_dt_multiple_tables.css')}}">
    <style>
        ul{
            justify-content: center;
        }
    </style>
@endsection


@section('title', 'Articles List')

@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table class="table" style="width:100%">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>User</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $key => $article)
                            <tr>
                                <td>{{$article->title}}</td>
                                <td>{{$article->slug}}</td>
                                <td>
                                    <img src="{{$article->image}}" alt="{{$article->title}}" class="img-thumbnail" width="200">
                                </td>
                                <td>{{$article->user->getFullname()}}</td>

                                <td class="text-center">
                                    <div class="btn-group">
                                        <a  href="{{route('articles.edit', $article->id)}}" class="btn btn-primary mr-2">Edit</a>
                                        <form action="{{route('articles.destroy', $article->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$articles->links()}}
                    </div>

                </div>
            </div>

        </div>

    </div>


@endsection
