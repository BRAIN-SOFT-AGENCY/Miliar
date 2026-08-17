@extends('web.layouts.app')

@section('content')
    <div class="body-wrapper">


        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image"
            style="height:auto; padding:12px 0;margin-bottom: 23px;      ">
            <div class="container" style="    border-right: 5px solid #442d66;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color"
                                    style="    font-size: 20px;    color: #4d3572 !important;"> تسجيل الدخول


                                </h6>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->

        <!-- LOGIN AREA START -->
        <div class="ltn__login-area pb-65">
            <div class="container">
                <div class="row align-items-center">

                    <!-- LOGIN -->
                    <div class="col-lg-6">
                        <div class="account-login-inner modern-box">

                            <h3 class="text-center mb-4">تسجيل الدخول</h3>

                            <form method="POST" action="{{ route('loginClient') }}" class="contact-form-box">
                                @csrf
                                <!-- email -->
                                <div class="input-icon mb-3">
                                    <i class="bi bi-envelope"></i>
                                    <input type="email" name="email" placeholder="البريد الإلكتروني">
                                </div>

                                <!-- password -->
                                <div class="input-icon mb-3">
                                    <i class="bi bi-lock"></i>
                                    <input type="password" name="password" placeholder="كلمة المرور">
                                </div>

                                <!-- forgot -->
                                <div class="text-end mb-3">
                                    <a href="#" class="forgot-link">نسيت كلمة المرور؟</a>
                                </div>

                                <!-- button -->
                                <div class="text-center">
                                    <button type="submit" class="buttonPlus" style="height: 50px;">
                                        تسجيل الدخول
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!-- REGISTER SIDE -->
                    <div class="col-lg-6">
                        <div class="account-create modern-box text-center">

                            <h4>ليس لديك حساب؟</h4>

                            <p class="mt-3">
                                أضف عناصر إلى قائمة رغباتك، واحصل على توصيات مخصصة، <br>
                                تحقق بسرعة من طلباتك وسجل الآن
                            </p>

                            <div class="mt-4">
                                <a href="{{ route('miliar.register') }}" class="buttonPlus" style="height: 50px;">
                                    إنشاء حساب
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- LOGIN AREA END -->

        <!-- FEATURE AREA START ( Feature - 3) -->

        <!-- FEATURE AREA END -->



    </div>
@endsection