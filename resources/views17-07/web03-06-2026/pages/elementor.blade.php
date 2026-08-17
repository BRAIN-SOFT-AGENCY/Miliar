@extends('web.layouts.app')

@section('content')
    <div class="body-wrapper">

        <!-- BREADCRUMB -->
 
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image"
            style="height:auto; padding:12px 0;margin-bottom: 23px;      ">
            <div class="container" style="    border-right: 5px solid #442d66;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color"
                                    style="    font-size: 20px;    color: #4d3572 !important;">
                                    الجهات المتخصصة في الترجمة
                                </h6>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- GALLERY SECTION -->
        <div class="container pb-5">

            <div class="row g-4">

                <!-- Card 1 -->
                <div class="col-lg-4 col-md-6">

                    <div class="modern-card">

                        <div class="img-box">
                            <img src="{{ asset('includes/img/agency1.PNG') }}" alt="">
                        </div>

                        <div class="content">
                            <h5>مكتب الترجمة المعتمد</h5>
                            <p>ترجمة قانونية وتقنية</p>

                            <a href="#" class="btn btn-sm btn-primary rounded-pill"
                                style="background-color: #cc9456;border: #cc9456;">
                                عرض التفاصيل
                            </a>
                        </div>

                    </div>

                </div>

                <!-- Card 2 -->
                <div class="col-lg-4 col-md-6">

                    <div class="modern-card">

                        <div class="img-box">
                            <img src="{{ asset('includes/img/agency2.PNG') }}" alt="">
                        </div>

                        <div class="content">
                            <h5>مركز الترجمة الدولية</h5>
                            <p>ترجمة طبية وأكاديمية</p>

                            <a href="#" class="btn btn-sm btn-primary rounded-pill"
                                style="background-color: #cc9456;border: #cc9456;">
                                عرض التفاصيل
                            </a>
                        </div>

                    </div>

                </div>

                <!-- Card 3 -->
                <div class="col-lg-4 col-md-6">

                    <div class="modern-card">

                        <div class="img-box">
                            <img src="{{ asset('includes/img/agency3.PNG') }}" alt="">
                        </div>

                        <div class="content">
                            <h5>شركة لغات العالم</h5>
                            <p>ترجمة متعددة اللغات</p>

                            <a href="#" class="btn btn-sm btn-primary rounded-pill"
                                style="background-color: #cc9456;border: #cc9456;">
                                عرض التفاصيل
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection