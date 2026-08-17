@extends('web.layouts.app')

@section('content')
    <div class="body-wrapper">

        <style>
            .profile-upload {
                margin-bottom: 30px;
            }

            .image-upload {
                position: relative;
                display: inline-block;
                cursor: pointer;
            }


            .profile-image {
                width: 180px;
                height: 180px;
                object-fit: cover;
                border-radius: 50%;
                border: 5px solid #eee;
                transition: 0.3s;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            }


            .image-upload:hover .profile-image {
                transform: scale(1.05);
                opacity: .8;
            }


            .camera-icon {

                position: absolute;
                bottom: 10px;
                right: 10px;

                width: 45px;
                height: 45px;

                background: #198754;
                color: white;

                border-radius: 50%;

                display: flex;
                justify-content: center;
                align-items: center;

                font-size: 20px;

                border: 3px solid white;

            }


            .upload-text {

                margin-top: 15px;
                color: #777;
                font-size: 14px;

            }
        </style>
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image"
            style="height:auto; padding:12px 0;margin-bottom: 23px;      ">
            <div class="container" style="    border-right: 5px solid #442d66;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color"
                                    style="    font-size: 20px;    color: #4d3572 !important;"> طلب إنضمام مترجم


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
                    <div class="col-lg-8">
                        <div class="account-login-inner modern-box">

                            <h3 class="text-center mb-4"> طلب إنضمام مترجم</h3>
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
                            <form method="POST" action="{{ route('storedemande') }}" class="contact-form-box"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="profile-upload text-center">

                                    <label for="translatorPicture" class="image-upload">

                                        <img id="previewImage" src="{{ asset('includesAdmin/img/translator/default.jpg') }}"
                                            class="profile-image">

                                        <div class="camera-icon">
                                            <i class="fa fa-camera"></i>
                                        </div>

                                    </label>

                                    <input type="file" id="translatorPicture" name="translatorPicture" accept="image/*"
                                        hidden onchange="preview(event)">

                                    <p class="upload-text">
                                        اضغط على الصورة لتحميل صورة جديدة
                                    </p>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-icon mb-3">
                                            <i class="bi bi-person"></i>
                                            <input type="text" name="translatorfirstName" placeholder="أدخل الاسم الأول">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-icon mb-3">
                                            <i class="bi bi-people"></i>
                                            <input type="text" name="translatorLastName" placeholder="أدخل اسم العائلة">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-icon mb-3">
                                            <i class="bi bi-envelope"></i>
                                            <input type="email" name="translatorEmail" placeholder="البريد الإلكتروني">
                                            <input type="hidden" name="translatorPWD"
                                                value="$2y$12$VyI51zSZcUvkfPNdk6XZL.6XRiFnLprTGU.uoXEqsFlxmxspoPN86">
                                            <input type="hidden" name="translatorStatus" value="0">

                                        </div>
                                    </div>

                                </div>

                                <!-- button -->
                                <div class="text-center">
                                    <button type="submit" class="buttonPlus" style="height: 50px;">
                                        إرسال الطلب
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!-- REGISTER SIDE -->
                    <div class="col-lg-4">
                        <div class="account-create modern-box text-center">

                            <h4>كن جزءًا من مجتمع المترجمين</h4>

                            <p class="mt-3">
                                سجّل الآن وانضم إلى منصتنا كمترجم معتمد.
                                <br>
                                شارك خبرتك، وقدّم خدماتك للمستفيدين الباحثين عن الترجمة.
                                <br>
                                بعد إرسال الطلب، سيقوم المسؤول بمراجعته وسيتم التواصل معك عبر البريد الإلكتروني.
                            </p>



                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- LOGIN AREA END -->

        <!-- FEATURE AREA START ( Feature - 3) -->

        <!-- FEATURE AREA END -->



    </div>
    <script>
        function preview(event) {

            let image = document.getElementById('previewImage');

            let file = event.target.files[0];

            if (file) {

                let reader = new FileReader();

                reader.onload = function (e) {

                    image.src = e.target.result;

                }

                reader.readAsDataURL(file);

            }

        }
    </script>
@endsection