@extends('layouts.manager.app')

@section('title', 'Users')


@section('content')
    <div id="tableCaption" class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Users</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <table class="table mb-4">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="">Status</th>
                            <th>Role</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1 ?>

                        @foreach ($profile as $item)

                            <tr>
                                <td class="text-center">{{$i++}}</td>
                                <td class="text-success"><a href="profile-detail/{{$item['id']}}">{{$item['first_name']}} {{$item['last_name']}}</a></td>
                                <td>{{$item['email']}}</td>
                                @if ($item['status'] === 1)
                                    <td class=""><span class=" shadow-none badge outline-badge-primary">Active</span>
                                    </td>
                                @elseif ($item['status'] === 0)
                                    <td class=""><span class=" shadow-none badge outline-badge-primary">deactive</span>
                                    </td>
                                @endif
                                @if ($item['role'] === 1)
                                    <td>Admin</td>
                                @elseif ($item['role'] === 2)
                                    <td>Editor</td>
                                @else
                                    <td>User</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


@endsection
