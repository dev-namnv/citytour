@if(!isset($reply_for))
    <p style="color: green">
        <span>Mail to : <b>{{$lastName}}</b></span> <br/>
        <span>Email : <i>{{$email}}</i></span>
        <span>Phone : <i>{{$phone}}</i></span>
    </p>
    <p>
        <sub style="font-weight: bold; color: #0e88b1">
            {!! $messages !!}
        </sub>
    </p>

    --Admin CityTours--
@else
    <p>
        {{$messages}}
    </p>
    <hr/>
    <p>
        -----Thank-----
        <br/>
        Admin CityTours
    </p>

@endif
