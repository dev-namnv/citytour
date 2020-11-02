@extends('layouts.main.app')

@section('title', __('pages.contact.title'))

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="Libraries/Main/img/header_bg.jpg" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>{!! __('pages.contact.section.title') !!}</h1>
                <p>{!! __('pages.contact.section.desc') !!}</p>
            </div>
        </div>
    </section>
    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">Home</a>
                    </li>
                    <li>{!! __('pages.contact.title') !!}</li>
                </ul>
            </div>
        </div>
        <!-- End Position -->

        <div class="container margin_60">
            <div class="row">
                <div class="col-md-8">
                    <div class="form_title">
                        <h3>
                            <strong><i class="icon-pencil"></i></strong>
                            {!! __('pages.contact.main.form-title') !!}
                        </h3>
                        <p>
                            {!! __('pages.contact.main.form-desc') !!}
                        </p>
                    </div>
                    <div class="step">
                        <div id="message-contact"></div>
                        <form action="{{ route('contact.store') }}" method="POST" class="form-contact">
                            @csrf
                            <div class="row">
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
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{!! __('pages.contact.main.first-name') !!}</label>
                                        <input type="text" class="form-control" id="first-name" name="firstName" placeholder="Enter Name">
                                        @error('firstName')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{!! __('pages.contact.main.last-name') !!}</label>
                                        <input type="text" class="form-control" id="last-name" name="lastName" placeholder="Enter Last Name">
                                        @error('lastName')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{!! __('pages.contact.main.email') !!}</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                                        @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{!! __('pages.contact.main.phone') !!}</label>
                                        <input type="text" id="phone_contact" name="phone" class="form-control" placeholder="Enter Phone number">
                                        @error('phone')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>{!! __('pages.contact.main.subject') !!}</label>
                                        <input id="message_subject" name="subject" class="form-control" placeholder="Subject" />
                                        @error('subject')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>{!! __('pages.contact.main.message') !!}</label>
                                        <textarea rows="5" id="message_contact" name="messages" class="form-control" placeholder="Write your message" style="height:200px;"></textarea>
                                        @error('message')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{!! __('pages.contact.main.send') !!}</button>
                        </form>
                    </div>
                </div>
                <!-- End col-md-8 -->

                <div class="col-md-4">
                    <div class="box_style_1">
                        <span class="tape"></span>
                        <h4>{!! __('pages.contact.main.address') !!} <span><i class="icon-pin pull-right"></i></span></h4>
                        <p>
                            Place Charles de Gaulle, 75008 Paris
                        </p>
                        <hr>
                        <h4>{!! __('pages.contact.main.help') !!} <span><i class="icon-help pull-right"></i></span></h4>
                        <p>
                            Lorem ipsum dolor sit amet, vim id accusata sensibus, id ridens quaeque qui. Ne qui vocent ornatus molestie.
                        </p>
                        <ul id="contact-info">
                            <li>{{ __('info.hotline') }}</li>
                            <li><a href="#">info@domain.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End col-md-4 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->

    </main>
    <!-- End main -->
@endsection
