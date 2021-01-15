@extends('layouts.manager.app')

@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom">
                <div class="card-body p-0">
                    <!--begin::Wizard-->
                    <div class="wizard wizard-1" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="false">
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
                                        <div class="wizard-step" data-wizard-type="step">
                                            <div class="wizard-label">
                                                <h3 class="wizard-title">3. Hoàn thành</h3>
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
                                @if($count > 0)
                                    <div class="alert alert-success">
                                        <p>Bạn chưa hoàn thành xong lịch trình</p>
                                    </div>
                                    <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                        <div>
                                            <a href="{{route('step2',['slug' => $tour->slug])}}"><button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4">
                                                    Trở lại</button></a>
                                        </div>
                                    </div>
                                @else
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                        <button class="btn btn-bg-light">Đã Hoàn Thành</button>
                                    </div>
                                    <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                        <div>
                                            <a href="{{route('step2',['slug' => $tour->slug])}}"><button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4">
                                                    Trở lại</button></a>
                                            <a href="" class="next"><button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4">
                                                    Hoàn thành</button></a>
                                        </div>
                                    </div>
                                @endif


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
        .wizard-label{
            margin-left: 50px;
        }
    </style>
@endsection
@section('extra-js')

@endsection

