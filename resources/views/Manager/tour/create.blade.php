@extends('layouts.manager.app')

@section('title', 'Create Tour')

@section('extra-css')
    <link href="{{ asset('libraries/manager/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('extra-js')
    <script src="{{ asset('libraries/manager/assets/js/scrollspyNav.js') }}"></script>
@endsection

@section('content')

    <div class="row mt-lg-3" style="width: 100%">
        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Create Tour</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form class="form-service-create" method="post" action="{{ route('tour-store') }}">
                        @csrf
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputName">Name</label>
                                <input type="text" class="form-control" id="inputName"
                                       value="{{ old('name') }}" placeholder="Tên Tour">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Slug</label>
                                <input type="text" class="form-control" id="inputPassword4"
                                       value="{{ old('slug') }}" placeholder="Đường dẫn URL">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="pac-input">Address</label>
                            <input type="text" class="form-control" id="pac-input"
                                   value="{{ old('address') }}" placeholder="số 5 Phạm Văn Đồng ...">
                            <div id="map"></div>
                        </div>
                        {{--<div class="form-group mb-4">
                            <label for="inputAddress2">Address 2</label>
                            <input type="text" class="form-control" id="inputAddress2"
                                   placeholder="Apartment, studio, or floor">
                        </div>--}}
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Zip</label>
                                <input type="text" class="form-control" id="inputZip">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check pl-0">
                                <div class="custom-control custom-checkbox checkbox-info">
                                    <input type="checkbox" class="custom-control-input" id="gridCheck">
                                    <label class="custom-control-label" for="gridCheck">Check me out</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Sign in</button>
                    </form>

                    <div class="code-section-container">

                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                        <div class="code-section text-left">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
