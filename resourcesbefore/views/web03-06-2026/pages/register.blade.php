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
                                    style="    font-size: 20px;    color: #4d3572 !important;"> تسجيل جديد


                                </h6>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->

        <!-- LOGIN AREA START (Register) -->
        <div class="ltn__login-area pb-110">
            <div class="container">
                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="account-login-inner modern-box">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form action="{{ route('registerClient') }}" method="POST">
                                @csrf

                                <!-- الاسم + اللقب -->
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="input-icon">
                                            <i class="bi bi-person"></i>
                                            <input type="text" name="clientFirstName" placeholder="الاسم الأول">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-icon">
                                            <i class="bi bi-person-badge"></i>
                                            <input type="text" name="clientLastName" placeholder="اسم العائلة">
                                        </div>
                                    </div>
                                </div>

                                <!-- email -->
                                <div class="input-icon mt-3">
                                    <i class="bi bi-envelope"></i>
                                    <input type="email" name="clientemail" placeholder="البريد الإلكتروني">
                                </div>

                                <!-- password -->
                                <div class="row g-3 mt-1">
                                    <div class="col-md-6">
                                        <div class="input-icon">
                                            <i class="bi bi-lock"></i>
                                            <input type="password" name="clientPwd" placeholder="كلمة المرور">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-icon">
                                            <i class="bi bi-shield-lock"></i>
                                            <input type="password" name="clientPwd_confirmation"
                                                placeholder="تأكيد كلمة المرور">
                                        </div>
                                    </div>
                                </div>

                                <!-- button -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="buttonPlus" style="height: 50px;">
                                        إنشاء حساب
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- LOGIN AREA END -->



    </div>
@endsection