@extends('layouts.main.app')

@section('content')
    <main>
        <section id="hero" class="login">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8">
                        <div id="login">
                            <div class="text-center"><img src="img/logo_sticky.png" alt="Image" data-retina="true" ></div>
                            <hr>
                            <form class="form-login" method="post" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"  placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password1" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm password</label>
                                    <input type="password" class=" form-control @error('email') is-invalid @enderror" id="password2" placeholder="Confirm password">
                                </div>
                                <div id="pass-info" class="clearfix"></div>
                                <input type="submit" class="btn_full">Create aln account/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End main -->
@endsection
