@extends('layouts.manager.app')
@section('title', 'Contacts')

@section('content')
    <div class="container bg-white">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table class="table table-hover non-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Email</th>
                                <th>ip</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $key =>$contact)
                                    <tr>
                                        <td>{{$contact->full_name}}</td>
                                        <td>{{$contact->subject}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->geoip}}</td>
                                        <td>{{$contact->created_at}}</td>
                                        <td>{{$contact->updated_at}}</td>
                                        <td>
                                            <span class="tour-status-{{ $contact->id }} rounded p-1 {{ $contact->getColor() }}">
                                                {{ $contact->getStatus() }}
                                        </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('contacts.show',$contact->id)}}" class="btn btn-sm bg-light">Open</a>
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent"></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                                    <a class="dropdown-item" href="{{route('contacts.update',['id'=>$contact->id,'status'=>TICKET_ANSWERED])}}">Đã Phản hồi</a>
                                                    <a class="dropdown-item" href="{{route('contacts.update',['id'=>$contact->id,'status'=>TICKET_WAITING_FOR_PROGRESS])}}">Đang chờ xử lý</a>
                                                    <a class="dropdown-item" href="{{route('contacts.update',['id'=>$contact->id,'status'=>TICKET_PROCESSING])}}">Đang xử lý</a>
                                                    <a class="dropdown-item" href="{{route('contacts.update',['id'=>$contact->id,'status'=>TICKET_CLOSED])}}">Đẫ đóng</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
