@extends('layouts.manager.app')

@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom">
                <div class="card-body p-0">
                    <!--begin::Wizard-->
                    <div class="wizard wizard-1" id="kt_wizard" data-wizard-state="step-first"
                         data-wizard-clickable="false">
                        <!--begin::Wizard Nav-->
                        <div class="wizard-nav border-bottom">
                            <div class="wizard-steps p-8 p-lg-10">
                                <!--begin::Wizard Step 1 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">1. Thông tin</h3>
                                    </div>
                                    <div class="wizard-step" data-wizard-type="step">
                                        <div class="wizard-label">
                                            <h3 class="wizard-title">2. Lịch Trình</h3>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 1 Nav-->
                            </div>
                        </div>
                        <!--end::Wizard Nav-->
                        <!--begin::Wizard Body-->
                        <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
                            <div class="col-xl-12 col-xxl-7">
                                <!--begin::Wizard Form-->
                                <!--begin::Wizard Step 1-->
                                <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <h3>Lịch trình</h3>
                                        </div>
                                        <div class="col-lg-9 image-schedule">
                                            @if(count($tour->schedules) > 1)
                                                @foreach($tour->schedules as $key => $schedule)
                                                    <h4><strong>Ngày {{ $key + 1 }}</strong></h4>
                                                    @if(isset($schedule->status['status']))
                                                        <input type="checkbox" checked disabled>
                                                    @else
                                                        @if(isset($schedule->status['start_date']) && \Carbon\Carbon::parse($schedule->status['start_date'])->addDays($key) <= \Carbon\Carbon::now())
                                                            <form class="form" id="kt_form" method="post"
                                                                  action="{{route('update.step2')}}">
                                                                @csrf
                                                                <p>{{\Carbon\Carbon::parse($schedule->status['start_date'])->addDays($key)}}</p>
                                                                <input type="text" name="start_date"
                                                                       value="{{$invoice->start_date}}" hidden>
                                                                <input type="text" name="start_date"
                                                                       value="{{$tour->id}}" hidden>
                                                                <input type="checkbox" name="status" class="status">
                                                                <input type="submit"
                                                                       class="btn btn-default checking"
                                                                       value="Cập nhật">
                                                            </form>
                                                        @endif
                                                    @endif
                                                    {!! $schedule->description !!}
                                                    <hr/>
                                                @endforeach
                                            @else
                                                <h4><strong>Đi trong ngày</strong></h4>
                                                {!! $tour->schedules->first()->description !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                    <div>
                                        <a href="{{route('step1',['slug' => $tour->slug])}}">
                                            <button type="button"
                                                    class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4">
                                                Previous
                                            </button>
                                        </a>

                                        <a href="{{route('step3',['id' => $tour->id])}}" class="next">
                                            <button type="button"
                                                    class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4">
                                                Next
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <!--end::Wizard Actions-->

                                <!--end::Wizard Form-->
                            </div>
                        </div>
                        <!--end::Wizard Body-->
                    </div>
                    <!--end::Wizard-->
                </div>
                <!--end::Wizard-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <style>
        .wizard-step {
            display: flex;
        }

        .wizard-label {
            margin-left: 50px;
        }
    </style>
@endsection
@section('extra-js')
    <script>
        $(document).ready(function () {
            $(".next").hide()
            var $submit = $(".checking").hide(),
                $cbs = $('input[name="status"]').click(function () {
                    $submit.toggle($cbs.is(":checked"));
                });
            if ($(".status").prop("checked", true)) {
                $(".next").show()
            }

        });
    </script>
@endsection

