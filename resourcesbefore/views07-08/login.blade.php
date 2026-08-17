<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="theme_ocean">
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title>Miliar</title>
    <!--! END:  Apps Title-->
    <!--! BEGIN: Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assetsLogin/assets/images/favicon.ico')}}">
    <!--! END: Favicon-->
    <!--! BEGIN: Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assetsLogin/assets/css/bootstrap.min.css')}}">
    <!--! END: Bootstrap CSS-->
    <!--! BEGIN: Vendors CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assetsLogin/assets/vendors/css/vendors.min.css')}}">
    <!--! END: Vendors CSS-->
    <!--! BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assetsLogin/assets/css/theme.min.css')}}">
    <link href="{{ asset('assetsLogin/assets/css/bootstrap.rtl.min.css') }}" rel="stylesheet">

    <!-- Droid Arabic Kufi -->
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/droid-arabic-kufi" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<style>
    .login-card {
        border: none;
        border-radius: 20px;
    }

    .login-card input,
    .login-card select {
        height: 50px;
        border-radius: 10px;
    }

    .login-card .btn {
        height: 50px;
        font-size: 18px;
    }

    .role-select {
        font-family: 'Kufi', sans-serif;
        background: #12284c;
        border: 1px solid #1c3b6b;
        color: white;
        height: 50px;
        padding-left: 20px;
        /* Décalage du texte par rapport au bord gauche */
        text-indent: 10px;
        /* Décalage supplémentaire si nécessaire */
        border-radius: 10px;
    }
</style>

<body>
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="auth-cover-wrapper" style="direction: rtl;">
        <div class="auth-cover-content-inner">
            <div class="auth-cover-content-wrapper">
                <div class="auth-img" style="width: 100%;">
                    <img src="{{ asset('assetsLogin/assets/images/auth/backwhite.jpeg')}}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="auth-cover-sidebar-inner">
            <div class="auth-cover-card-wrapper">
                <div class="auth-cover-card p-sm-5">
                    <div class="wd-50 mb-5">
                        <!--img src="{{ asset('assetsLogin/assets/images/logo.gif')}}" alt="" class="img-fluid"-->
                    </div>

                    <div class="" style="max-width:500px;margin:auto;">

                        <h3 class="text-center mb-4 fw-bold" style="font-family: 'Reem Kufi';">تسجيل الدخول</h3>

                        <form action="{{ route('login.check') }}" method="POST">
                            @csrf

                            @if(session('error'))
                                <div class="alert alert-danger text-center">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <!-- Email -->
                            <!-- Email -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold" style=" 'Kufi', sans-serif !important;">البريد
                                    الإلكتروني</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="أدخل البريد الإلكتروني" required
                                        style=" 'Kufi', sans-serif !important;">
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold" style=" 'Kufi', sans-serif !important;">كلمة
                                    المرور</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="أدخل كلمة المرور" required style=" 'Kufi', sans-serif !important;">
                                </div>
                            </div>

                            <!-- Role -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold" style=" 'Kufi', sans-serif !important;">نوع
                                    الحساب</label>
                                <select name="role" class="form-select">
                                    <option value="1" style=" 'Kufi', sans-serif !important;">مترجم</option>
                                    <option value="2" style=" 'Kufi', sans-serif !important;">مدقق</option>
                                    <option value="3" style=" 'Kufi', sans-serif !important;">مدير النظام
                                    </option>
                                </select>
                            </div>
                            <div class="text-end mb-3">
                                <a href="javascript:void(0);" id="forgotPassword"
                                    style="color:red;text-decoration:none;font-weight:bold;">
                                    نسيت كلمة المرور؟
                                </a>
                            </div>
                            <!-- Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg rounded-3"
                                    style="'Kufi', sans-serif !important;background-color:  #0c1730 !important;border: 1px solid #0c1730 !important;color: white;">
                                    تسجيل الدخول
                                </button>
                            </div>

                        </form>
                        <form id="forgotForm" action="{{ route('translator.forgot.password') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" id="forgotEmail">
                        </form>
                        <script>
                            document.getElementById('forgotPassword').addEventListener('click', function () {

                                let email = document.querySelector('input[name=email]').value;

                                if (email == "") {
                                    alert("الرجاء إدخال البريد الإلكتروني");
                                    return;
                                }

                                document.getElementById('forgotEmail').value = email;

                                document.getElementById('forgotForm').submit();

                            });
                        </script>
                    </div>



                </div>
            </div>
        </div>
    </main>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Theme Customizer !-->
    <!--! ================================================================ !-->

    <!--! ================================================================ !-->
    <!--! [End] Theme Customizer !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! Footer Script !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Vendors JS !-->
    <script src="{{ asset('assetsLogin/assets/vendors/js/vendors.min.js')}}"></script>
    <!-- vendors.min.js {always must need to be top} -->
    <!--! END: Vendors JS !-->
    <!--! BEGIN: Apps Init  !-->
    <script src="{{ asset('assetsLogin/assets/js/common-init.min.js')}}"></script>
    <!--! END: Apps Init !-->
    <!--! BEGIN: Theme Customizer  !-->
    <script src="{{ asset('assetsLogin/assets/js/theme-customizer-init.min.js')}}"></script>
    <!--! END: Theme Customizer !-->
</body>

</html>