@extends('client.layouts.app')

@section('content')
    <div class="body-wrapper">

        <!-- BREADCRUMB AREA START -->
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image"
            style="height:auto; padding:12px 0;margin-bottom: 23px;      ">
            <div class="container" style="    border-right: 5px solid #442d66;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color"
                                    style="    font-size: 20px;    color: #4d3572 !important;"> من نحن
                                </h6>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->
        <div class="ltn__about-us-area pt-120--- pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 align-self-center">
                        <div class="about-us-img-wrap about-img-left">
                            <img src="{{ asset('includesAdmin/img/aboutpage.PNG') }}" alt="About Us Image">
                        </div>
                    </div>
                    <div class="col-lg-6 align-self-center">
                        <div class="about-us-info-wrap">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color">انضم إلى مجتمع مترجمينا</h6>
                                <h1 class="section-title">مليار كلمة </h1>
                                <p>لماذا تنضم إلينا
                                </p>
                            </div>
                            <p>هل أنت مترجم محترف تتطلع إلى مشاركة أعمالك مع العالم؟ <br>انضم إلى مجتمع مترجمينا وساهم في
                                ترجمة مليار كلمة إلى العربية. نرحب بجميع المترجمين الموهوبين والمتخصصين في مختلف المجالات
                            </p>
                            <div class="about-author-info d-flex">
                                <div class="author-name-designation  align-self-center">
                                    <button class="buttonPlus" style="width: 144px;height: 50px;">قدم طلبك الآن</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-5">
            <div class="row g-4">

                <!-- Vision -->
                <div class="col-md-4">
                    <div class="card h-100 text-center p-4 shadow-sm border-0 rounded-4 feature-card">
                        <div class="icon mb-3">
                            <i class="bi bi-eye-fill fs-1 text-primary"></i>
                        </div>
                        <h4 class="fw-bold">رؤيتنا</h4>
                        <p class="text-muted">
                            توفير ترجمات عالية الجودة وموثوقة تلبي احتياجات القراء
                        </p>
                    </div>
                </div>

                <!-- Mission -->
                <div class="col-md-4">
                    <div class="card h-100 text-center p-4 shadow-sm border-0 rounded-4 feature-card">
                        <div class="icon mb-3">
                            <i class="bi bi-bullseye fs-1 text-success"></i>
                        </div>
                        <h4 class="fw-bold">رسالتنا</h4>
                        <p class="text-muted">
                            بناء مكتبة رقمية للترجمات من لغات العالم المختلفة
                        </p>
                    </div>
                </div>

                <!-- Values / Team -->
                <div class="col-md-4">
                    <div class="card h-100 text-center p-4 shadow-sm border-0 rounded-4 feature-card">
                        <div class="icon mb-3">
                            <i class="bi bi-people-fill fs-1 text-danger"></i>
                        </div>
                        <h4 class="fw-bold">فريقنا</h4>
                        <p class="text-muted">
                            فريق من المترجمين المحترفين بخبرات متعددة
                        </p>
                    </div>
                </div>

            </div>
        </div>







    </div>
    <!-- Body main wrapper end -->
@endsection