@extends('Main.tour.index')

@section('tour-list')
    @php($i = 0)
    @foreach($tours as $tour)
        <div class="row">
            <div class="col-md-6 wow zoomIn" data-wow-delay="0.{!! $i !!}s">
                <div class="tour_container">
                    <div class="img_container">
                        <a href="{{route('Main.tour.show',['slug'=> $tour->slug])}}">
                            <img src="{!! $tour->thumbnail !!}" width="800" height="533" class="img-fluid" alt="Image">
                            <div class="short_info">
                                <i class="{!! $tour->category->icon !!}"></i>
                                {!! $tour->category->name !!}
                                <span class="price small" style="color: #ff8989">{!! $tour->getCurrentPrice() !!}</span>
                            </div>
                        </a>
                    </div>
                    <div class="tour_title">
                        <h3><strong>{{ $tour->name }}</strong></h3>
                        <div class="add_info">
                            <div class="tooltip-item">
                                Tour <span>
                                    {{ $tour->schedules->count() == 1 ? 'trong' : $tour->schedules->count() }}
                                </span> ngày
                            </div>
                        </div>
                        <ul class="add_info">
                            <li>
                                <div class="tooltip_styled tooltip-effect-4">
                                    Khởi hành:
                                </div>
                            </li>
                            @foreach($tour->batches as $batch)
                                <li>
                                    <div class="tooltip_styled tooltip-effect-4">
                                        <span class="tooltip-item">
                                            {{ $batch->batch }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        @if($tour->reviews->count() != 0 )
                            <div class="small mt-3 ">
                                Điểm: {{ round($tour->reviews->avg('star'),1) }}
                            </div>
                        @endif
                        <div class="wishlist">
                            <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 wow zoomIn" data-wow-delay="0.{!! $i++ !!}s">
                <div class="tour_container">
                    <div class="img_container">
                        <a href="{{route('Main.tour.show',['slug'=> $tour->slug])}}">
                            <img src="{!! $tour->thumbnail !!}" width="800" height="533" class="img-fluid" alt="Image">
                            <div class="short_info">
                                <i class="{!! $tour->category->icon !!}"></i>
                                {!! $tour->category->name !!}
                                <span class="price small" style="color: #ff8989">{!! $tour->getCurrentPrice() !!}</span>
                            </div>
                        </a>
                    </div>
                    <div class="tour_title">
                        <h3><strong>{{ $tour->name }}</strong></h3>
                        <div class="add_info">
                            <div class="tooltip-item">
                                Tour <span>
                                    {{ $tour->schedules->count() == 1 ? 'trong' : $tour->schedules->count() }}
                                </span> ngày
                            </div>
                        </div>
                        <ul class="add_info">
                            <li>
                                <div class="tooltip_styled tooltip-effect-4">
                                    Khởi hành:
                                </div>
                            </li>
                            @foreach($tour->batches as $batch)
                                <li>
                                    <div class="tooltip_styled tooltip-effect-4">
                                        <span class="tooltip-item">
                                            {{ $batch->batch }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        @if($tour->reviews->count() != 0 )
                            <div class="small mt-3 ">
                                Điểm: {{ round($tour->reviews->avg('star'),1) }}
                            </div>
                        @endif
                        <div class="wishlist">
                            <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
