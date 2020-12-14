@extends('Main.tour.index')

@section('tour-list')
    <div class="row">
        @for($i = 0; $i < count($tours); $i++)
            <div class="col-md-6 wow zoomIn" data-wow-delay="0.{!! $i !!}s">
                <div class="tour_container">
                    <div class="img_container">
                        <a href="{{route('Main.tour.show',$tours[$i]->slug)}}">
                            <img src="{!! $tours[$i]->thumbnail !!}" width="800" height="533" class="img-fluid" alt="Image">
                            <div class="short_info">
                                <i class="{!! $tours[$i]->category->icon !!}"></i>
                                {!! $tours[$i]->category->name !!}
                                <span class="price small" style="color: #ff8989">{!! $tours[$i]->getCurrentPrice() !!}</span>
                            </div>
                        </a>
                    </div>
                    <div class="tour_title">
                        <h3><strong>{{ $tours[$i]->name }}</strong></h3>
                        <div class="add_info">
                            <div class="tooltip-item">
                                Tour <span>
                                {{ $tours[$i]->schedules->count() == 1 ? 'trong' : $tours[$i]->schedules->count() }}
                            </span> ngày
                            </div>
                        </div>
                        <ul class="add_info">
                            <li>
                                <div class="tooltip_styled tooltip-effect-4">
                                    Khởi hành:
                                </div>
                            </li>
                            @foreach($tours[$i]->batches as $batch)
                                <li>
                                    <div class="tooltip_styled tooltip-effect-4">
                                    <span class="tooltip-item">
                                        {{ $batch->batch }}
                                    </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        @if($tours[$i]->reviews->count() != 0 )
                            <div class="small mt-3 ">
                                Điểm: {{ round($tours[$i]->reviews->avg('star'),1) }}
                            </div>
                        @endif
                        <div class="wishlist">
                            <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                        </div>

                    </div>
                </div>
            </div>
        @endfor
    </div>
@endsection
