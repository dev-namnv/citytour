@extends('layouts.manager.app')

@section('title', 'Users')


@section('content')
    <div id="tableCaption" class="col-lg-12 col-12 layout-spacing ">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Users</h4>
                    </div>
                </div>
            </div>
            <div class="container bg-white">
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table class="table table-hover non-hover text-center" style="width:100%">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Tên khách hàng</th>
                                        <th>Avatar</th>
                                        <th>Địa chỉ khách hàng</th>
                                        <th>Trạng Thái</th>
                                        <th>Vị trí</th>
                                        <th>Hành Động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($profile as $item)
                                        <tr>
                                            <td>
                                                <p><a href="profile-detail/{{$item['id']}}">{{$item['first_name']}} {{$item['last_name']}}</a></p>
                                            </td>
                                            <td>
                                                <img src="{{$item['avatar']}}" alt="{{$item['first_name']}} {{$item['last_name']}}" width="80"/>
                                            </td>
                                            <td>
                                                {{$item['address']}}
                                            </td>
                                            @if ($item['status'] === 1)
                                                <td class=""><span class=" shadow-none badge outline-badge-primary">Active</span>
                                                </td>
                                            @elseif ($item['status'] === 0)
                                                <td class=""><span class=" shadow-none badge outline-badge-primary">deactive</span>
                                                </td>
                                            @endif
                                            @if ($item['role'] === ADMIN)
                                                <td>Admin</td>
                                            @elseif ($item['role'] === GUIDE)
                                                <td>Guide</td>
                                            @else
                                                <td>User</td>
                                            @endif
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{route('user.detail',$item['id'])}}" class="btn btn-sm btn-light">Chi tiết</a>
                                                    </div>
                                                </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                                {{$profile->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
