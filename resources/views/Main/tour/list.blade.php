@extends('Main.tour.index')

@section('tour-list')
    @foreach($tours as $index => $tour)
        <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.{!! ++$index !!}s">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="wishlist">
                        <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">{!! __('Add to wishlist') !!}</span></span></a>
                    </div>
                    <div class="img_list">
                        <a href="{{route('Main.tour.show',['slug'=> $tour->slug])}}"><img src="{!! $tour->thumbnail !!}" alt="Image">
                            <div class="short_info"><i class="{!! $tour->category->icon !!}"></i>{!! $tour->category->name !!} </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="tour_list_desc">
                        <h3><strong>{!! $tour->name !!}</strong></h3>
                        @if($tour->reviews->count() != 0 )
                            <div class="small">
                                Điểm:
                                <span>{{ round($tour->reviews->avg('star'),1) }}</span>
                            </div>
                        @endif
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
                            @foreach($tour->batches as $key => $batch)
                                @if($key < 5)
                                    <li>
                                        <div class="tooltip_styled tooltip-effect-4">
                                        <span class="tooltip-item">
                                            {{ $batch->batch }}
                                        </span>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2" style="margin-left: -16px">
                    <div class="price_list" style="width: 145px">
                        <div class="price">
                            <p style="font-size: 50%" class="bg-danger text-white p-2">{!! $tour->getCurrentPrice() !!}</p>
                            <small class="mt-2">/người</small>
                            <p>
                                <a href="{{route('Main.tour.show',['slug'=> $tour->slug])}}" class="btn_1">Chi tiết</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
