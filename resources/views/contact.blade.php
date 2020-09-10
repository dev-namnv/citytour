@extends('layouts.main.app')

@section('title', 'sendContact')

@section('content')
    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">Home</a>
                    </li>
                    <li><a href="#">Category</a>
                    </li>
                    <li>Page active</li>
                </ul>
            </div>
        </div>
        <!-- End Position -->

        <div class="container margin_60">
            <div class="row">
                <div class="col-md-8">
                    <div class="form_title">
                        <h3><strong><i class="icon-pencil"></i></strong>Fill the form below</h3>
                        <p>
                            Mussum ipsum cacilds, vidis litro abertis.
                        </p>
                    </div>
                    <div class="step">

                        <div id="message-contact"></div>
                        {{Form::open(['url'=>route('contact.store'), 'method'=>'post', 'id'=>'contactform'])}}
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
                                        <label>First Name</label>
                                        <input type="text" class="form-control" id="name_contact" name="firstName" placeholder="Enter Name">
                                        @error('firstName')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" id="lastname_contact" name="lastName" placeholder="Enter Last Name">
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
                                        <label>Email</label>
                                        <input type="email" id="email_contact" name="email" class="form-control" placeholder="Enter Email">
                                        @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone</label>
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
                                        <label>Subject</label>
                                        <input id="message_subject" name="title" class="form-control" placeholder="Subject" />
                                        @error('title')
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
                                        <label>Message</label>
                                        <textarea rows="5" id="message_contact" name="content" class="form-control" placeholder="Write your message" style="height:200px;"></textarea>
                                        @error('content')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Mail</button>
                        {{Form::close()}}
                    </div>
                </div>
                <!-- End col-md-8 -->

                <div class="col-md-4">
                    <div class="box_style_1">
                        <span class="tape"></span>
                        <h4>Address <span><i class="icon-pin pull-right"></i></span></h4>
                        <p>
                            Place Charles de Gaulle, 75008 Paris
                        </p>
                        <hr>
                        <h4>Help center <span><i class="icon-help pull-right"></i></span></h4>
                        <p>
                            Lorem ipsum dolor sit amet, vim id accusata sensibus, id ridens quaeque qui. Ne qui vocent ornatus molestie.
                        </p>
                        <ul id="contact-info">
                            <li>+ 61 (2) 8093 3400 / + 61 (2) 8093 3402</li>
                            <li><a href="#">info@domain.com</a>
                            </li>
                        </ul>
                    </div>
                    <div class="box_style_4">
                        <i class="icon_set_1_icon-57"></i>
                        <h4>Need <span>Help?</span></h4>
                        <a href="tel://004542344599" class="phone">+45 423 445 99</a>
                        <small>Monday to Friday 9.00am - 7.30pm</small>
                    </div>
                </div>
                <!-- End col-md-4 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->

        <div id="map_contact"></div>
        <!-- end map-->
        <div id="directions">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <form action="http://maps.google.com/maps" method="get" target="_blank">
                            <div class="input-group">
                                <input type="text" name="saddr" placeholder="Enter your starting point" class="form-control style-2" />
                                <input type="hidden" name="daddr" value="New York, NY 11430" />
                                <!-- Write here your end point -->
                                <span class="input-group-btn">
								<button class="btn" type="submit" value="Get directions" style="margin-left:0;">GET DIRECTIONS</button>
								</span>
                            </div>
                            <!-- /input-group -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end directions-->
    </main>
    <!-- End main -->
@endsection
