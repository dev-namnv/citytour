@extends('layouts.manager.app')
@section('title','Contact - '.$contact->subject)
@section('extra-css')

@endsection
@section('extra-js')

@endsection
@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-sm-5">
                            <span>Name: </span>
                            <p class="d-inline ml-2">{!! $contact->full_name !!}</p>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-sm-5">
                            <span>Email: </span>
                            <p class="d-inline ml-2">{!! $contact->email !!}</p>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-sm-2">
                            <p class="d-inline ml-2 small">{!! $contact->geoip !!}</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-xl-10 col-lg-10 col-sm-10">
                            <span>Subject: </span>
                            <p class="d-inline ml-2">{!! $contact->subject !!}</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <span class="col-auto">Message: </span>
                    </div>
                    <div class="shadow-none p-3 mb-5 bg-light rounded col-xl-12 col-lg-12 col-sm-12">
                        <code>
                             {!! htmlspecialchars($contact->message) !!}
                        </code>
                    </div>
                    <button class="btn shadow-none border-info" data-toggle="collapse" href="#collapseReply" role="button" aria-expanded="false" aria-controls="collapseReply">Reply</button>
                    <div class="row">
                        @if ($errors->any())
                            <div class="col-sm-12">
                                @foreach ($errors->all() as $error)
                                    <p class="text-danger small">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        @if(Session::has('success'))
                            <div class="alert alert-success col-sm-12" role="alert">
                                Send Mail Contact Success !
                            </div>
                        @endif
                        @if(Session::has('fails'))
                            <div class="alert alert-warning col-sm-12" role="alert">
                                Fails !
                            </div>
                        @endif
                    </div>
                </div>

                <div class="d-flex p-2"></div>

                <div class="widget-content widget-content-area br-6 collapse multi-collapse" id="collapseReply">
                    {{Form::open(['url'=>route('contacts.reply'),'method'=>'POST','class'=>'form-contact'])}}
                        <input type="hidden" name="reply_for" value="{!! $contact->id !!}">
                        <input type="hidden" name="email" value="{!! $contact->email !!}">
                        <input type="hidden" name="name" value="{!! $contact->full_name !!}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Subject</label>
                            <input type="text" name="subject" class="form-control" value="Re:{!! $contact->subject !!}" aria-describedby="Subject" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Message</label>
                            <textarea name="messages" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    {{Form::close()}}
                </div>
            </div>

        </div>

    </div>
@endsection
