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
                                <div class="wizard-step" data-wizard-state="current">
                                        <div class="wizard-label">
                                            <h3 class="wizard-title">1. Thông tin</h3>
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
                                <form class="form" id="kt_form">
                                    <!--begin::Wizard Step 1-->
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                        <h3 class="mb-10 font-weight-bold text-dark">Thông tin Tour</h3>
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <strong>Tour</strong>
                                            <span class="ml-1">{{$tour->name}}</span>
                                        </div>
                                        <!--end::Input-->
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <strong>ĐIỂM XUẤT PHÁT: </strong>
                                            <span class="ml-1">{{ $tour->origin }}</span>
                                        </div>
                                        <div class="form-group">
                                            <strong>THỜI GIAN: </strong>
                                            <span class="ml-1">{{ $tour->schedules->count() }} ngày</span>
                                        </div>
                                        <div class="form-group">
                                            <strong>SỐ NGƯỜI: </strong>
                                            <span class="ml-1">{{ $invoice->adult_count + $invoice->child_count }}</span>
                                        </div>
                                        <div class="form-group">
                                            <strong>NGÀY KHỞI HÀNH: </strong>
                                            <span class="ml-1">{{ $invoice->start_date }}</span>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                        <div>
                                            <a href="{{route('step2',['slug' => $tour->slug])}}"> <button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4">
                                                Next</button></a>
                                        </div>
                                    </div>
                                    <!--end::Wizard Actions-->
                                </form>
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

@endsection
@section('extra-js')

@endsection

