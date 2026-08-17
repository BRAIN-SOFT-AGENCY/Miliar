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
                                    style="    font-size: 20px;    color: #4d3572 !important;"> اتصل بنا

                                </h6>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="ltn__contact-address-area mb-90">
            <div class="container">
                <div class="row text-center">
                    <!-- Email -->
                    <div class="col-lg-4">
                        <div class="ltn__contact-address-item box-shadow p-4 rounded-4">
                            <div class="mb-3">
                                <i class="bi bi-envelope-fill fs-1 text-primary"></i>
                            </div>
                            <h4 class="fw-bold">البريد الإلكتروني</h4>
                            <p>
                                info@miliar.org
                            </p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-lg-4">
                        <div class="ltn__contact-address-item box-shadow p-4 rounded-4">
                            <div class="mb-3">
                                <i class="bi bi-telephone-fill fs-1 text-success"></i>
                            </div>
                            <h4 class="fw-bold">رقم الهاتف</h4>
                            <p>
                                966123462555 +
                            </p>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-lg-4">
                        <div class="ltn__contact-address-item box-shadow p-4 rounded-4">
                            <div class="mb-3">
                                <i class="bi bi-geo-alt-fill fs-1 text-danger"></i>
                            </div>
                            <h4 class="fw-bold">العنوان</h4>
                            <p>
                                مركز عبد الله بن إدريس هيئة الأدب والنشر والترجمة مركز صالح الرخيص الثقافي كرسي اليونسكو
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="ltn__contact-message-area mb-120 mb--100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__form-box contact-form-box box-shadow white-bg">

                            <form id="contact-form" action="mail.php" method="post">
                                <div class="row">

                                    <div class="col-md-6">
                                        <input type="text" name="name" placeholder="أدخل اسمك">
                                    </div>

                                    <div class="col-md-6">
                                        <input type="email" name="email" placeholder="أدخل بريدك الإلكتروني">
                                    </div>



                                    <div class="col-md-12">
                                        <input type="text" name="phone" placeholder="رقم الهاتف">
                                    </div>

                                </div>

                                <textarea name="message" placeholder="اكتب رسالتك هنا"></textarea>

                                <div class="text-end">
                                    <button class="btn btn-primary px-4 py-2 rounded-pill"
                                        style="background-color: #cc9456;border: #cc9456;">
                                        إرسال الطلب
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="google-map mb-120" style="    height: 300px;">
            <iframe src="https://www.google.com/maps?q=Riyadh+Saudi+Arabia&output=embed" width="100%" height="400"
                style="border:0;" allowfullscreen="">
            </iframe>

        </div>







    </div>
    <!-- Body main wrapper end -->
@endsection