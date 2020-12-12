<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link href="{{ asset('libraries/main/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('libraries/main/css/vendors.css') }}" rel="stylesheet">

<!-- CUSTOM CSS -->
<link href="{{ asset('libraries/main/css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('libraries/main/css/timeline.css') }}" rel="stylesheet">

<style>
    .cbp_tmtimeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 5px;
        background: none;
        left: 20%;
        margin-left: -8px;
    }

    .cbp_tmtimeline > li .cbp_tmlabel {
        background: none;
    }

    .cbp_tmtimeline > li .cbp_tmicon {
        width: 48px;
        height: 48px;
        font-family: 'fontello';
        speak: none;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        font-size: 24px;
        line-height: 48px;
        -webkit-font-smoothing: antialiased;
        position: absolute;
        color: #e04f67;
        background:#f9f9f9;
        border-radius: 50%;
        box-shadow: 0 0 0 3px #e04f67;
        text-align: center;
        left: 19.6%;
        top: 15%;
        margin: 0 0 0 -25px;
    }

    .cbp_tmtimeline > li .cbp_tmtime {
        display: block;
        width: 25%;
        padding-right: 100px;
        position: absolute;
        margin-top: 37px;
    }
</style>

<div class="container margin_60">
    <div class="main_title">
        <h2>Lịch trình chi tiết của <span>{{$invoice->tour->name }} </span></h2>
        <h4>
            Ngày bắt đầu: <span class="text-danger">{{ date_format(new DateTime($invoice->start_date), 'd-m-Y') }}</span>
        </h4>
        <h4>
            Ngày kết thúc: <span class="text-danger">{{date_format(new DateTime($invoice->end_date), 'd-m-Y') }}</span>
        </h4>
        <h4>
            Hướng dẫn viên: <span class="text-danger">{{$invoice->guide->getFullName() }}</span>
        </h4>
        <h4>
            Trạng thái: <span class="text-success">{{$invoice->getStatus()}}</span>
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
