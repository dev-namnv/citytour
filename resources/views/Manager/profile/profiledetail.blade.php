@extends('layouts.manager.app')

@section('title', 'Users')


@section('content')
    <style>
        li{
            list-style: none;
            font-size: 18px;
            padding: 10px;
        }
    </style>
            <section class="update-profile content bg-white" style="width: 100%; padding: 50px">
                <div class="row">
                    <div class="col-md-6">
                        <h3>{{ $profile->last_name }} {{ $profile->first_name }}</h3>
                        <ul id="profile_summary">
                            <li>@lang('pages.user.profile.label.phone')
                                <span>{{ $profile->phone }}</span>
                            </li>
                            <li>@lang('pages.user.profile.label.birthday')
                                <span>{{ $profile->birthday }}</span>
                            </li>
                            <li>@lang('pages.user.profile.label.address')
                                <span>{{ $profile->address }}</span>
                            </li>
                            <li>@lang('pages.user.profile.label.city')<span>{{ $profile->city }}</span>
                            </li>
                            <li>@lang('pages.user.profile.label.zipcode')
                                <span>{{ $profile->zipcode }}</span>
                            </li>
                            <li>@lang('pages.user.profile.label.country')
                                <span>{{ $profile->country }}</span>
                            </li>
                            <li>Trạng thái
                                @if ($profile->status === 1)
                                    <span class=" shadow-none badge outline-badge-primary">Active</span>
                                @elseif ($profile->status === 0)
                                    <span class=" shadow-none badge outline-badge-primary">Deactive</span>
                                @endif
                            </li>

                        </ul>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <img src="{{ $profile->avatar }}" alt="Image"
                                 class="img-fluid styled profile_pic">
                        </p>
                    </div>
                </div>
            </section>


@endsection
