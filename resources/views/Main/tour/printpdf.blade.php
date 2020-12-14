<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Phần css này quan trọng nhé cho vào phần extra-js của detail tour -->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            ​
            #section-to-print,
            #section-to-print * {
                visibility: visible;
            }
            ​
            #section-to-print {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>
<body>
<!-- Mình sẽ chỉ in lịch trình và các ảnh thôi, còn booking ko cho vào nên anh em cho ảnh và mô tả lịch trình vào 1 cái div nhé -->
<div id="section-to-print" style="width: 40%; margin: auto">
    <h2>{{$tour->name}}</h2>
    <div class="row">
        <div class="col-lg-3">
            <h3>Lịch trình</h3>
        </div>
        <div class="col-lg-9">
            @if(count($tour->schedules) > 1)
                @foreach($tour->schedules as $key => $schedule)
                    <h4><strong>Ngày {{ $key + 1 }}</strong></h4>
                    {!! $schedule->description !!}
                    <hr/>
                @endforeach
            @else
                <h4><strong>Đi trong ngày</strong></h4>
                {!! $tour->schedules->first()->description !!}
            @endif
        </div>
    </div>
    <button id="printButton" style="width: 150px; height: 50px; background: gray; border: none; cursor: pointer; font-size: 16px; color: white">In ra</button>
</div>

<script>
    $('#printButton').on('click', () => {
        window.print()
    })
</script>
</body>
</html>
