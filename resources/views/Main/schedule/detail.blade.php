<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link href="{{ asset('libraries/main/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('libraries/main/css/vendors.css') }}" rel="stylesheet">

<!-- CUSTOM CSS -->
<link href="{{ asset('libraries/main/css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('libraries/main/css/timeline.css') }}" rel="stylesheet">

<style>
    .blur {
        background-size:cover;
        filter: blur(1px);
    }
</style>

<div class="container margin_60">
    <div class="main_title">
        <h2>Lịch trình chi tiết của <span>{{$invoice->tour->name }} </span></h2>
        <h4>
            Ngày bắt đầu: <span class="text-danger">{{$invoice->start_date }}</span>
        </h4>
        <h4>
            Ngày kết thúc: <span class="text-danger">{{$invoice->end_date }}</span>
        </h4>
        <h4>
            Hướng dẫn viên: <span class="text-danger">{{$invoice->guide->getFullName() }}</span>
        </h4>
        <h4>
            Trạng thái: <span class="text-success">Hoàn tất</span>
        </h4>
    </div>
    <hr>
    <ul class="cbp_tmtimeline">
        @foreach($invoice->tour->schedules as $key => $schedule)
            <li>
                <time class="cbp_tmtime"><span></span> <span>{{$invoice->getDayAddFromStart($key)}}</span>
                </time>
                <div class="cbp_tmicon timeline_icon_point"></div>
                <div class="cbp_tmlabel">
                    <div class="float-right d-none d-md-block">Hướng dẫn viên <strong>{{$invoice->guide->getFullName()}}</strong><img src="{{$invoice->guide->avatar}}" alt="Image" class="rounded-circle speaker">
                    </div>
                    <h2>
                        @if($key == 0)
                            Ngày đầu tiên
                        @elseif ($key == count($invoice->tour->schedules) - 1)
                            Ngày cuối cùng
                        @else
                            Ngày thứ {{$key+1}}
                        @endif
                    </h2>
                    <p>{{$schedule->description}}</p>
                    <img src="{{$schedule->image}}" alt="">
                </div>
            </li>
        @endforeach


    </ul>
</div>
