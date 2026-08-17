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
                                    style="    font-size: 20px;    color: #4d3572 !important;"> طلب إنضمام مترجم


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
                    <div class="col-lg-8">
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
                            <form action="{{ route('storedemande') }}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="">

                                    <div class="box-header with-border text-center">
                                        <h3 class="box-title">
                                            <i class="fa fa-user-plus"></i>
                                            طلب انضمام مترجم
                                        </h3>
                                    </div>


                                    <div class="box-body">

                                        <div class="row">

                                            <!-- Image -->
                                            <div class="col-md-4 text-center">

                                                <div class="translator-photo">

                                                    <img id="previewImage"
                                                        src="{{ asset('includesAdmin/img/translator/default.jpg') }}"
                                                        class="img-circle"
                                                        style="width:180px;height:180px;object-fit:cover;border:4px solid #eee">

                                                    <br><br>

                                                    <label class="btn btn-success">
                                                        <i class="fa fa-camera"></i>
                                                        تحميل الصورة

                                                        <input type="file" name="translatorPicture" hidden
                                                            onchange="preview(event)">
                                                    </label>

                                                </div>

                                            </div>



                                            <!-- Informations -->
                                            <div class="col-md-8">


                                                <div class="form-group">

                                                    <label>
                                                        <i class="fa fa-user"></i>
                                                        الاسم الأول
                                                    </label>

                                                    <input type="text" name="translatorfirstName" class="form-control"
                                                        placeholder="أدخل الاسم الأول">

                                                </div>



                                                <div class="form-group">

                                                    <label>
                                                        <i class="fa fa-user"></i>
                                                        اسم العائلة
                                                    </label>

                                                    <input type="text" name="translatorLastName" class="form-control"
                                                        placeholder="أدخل اسم العائلة">

                                                </div>



                                                <div class="form-group">

                                                    <label>
                                                        <i class="fa fa-envelope"></i>
                                                        البريد الإلكتروني
                                                    </label>


                                                    <input type="email" name="translatorEmail" class="form-control"
                                                        placeholder="example@gmail.com">

                                                </div>



                                                <input type="hidden" name="translatorStatus" value="0">


                                                <input type="hidden" name="translatorPWD"
                                                    value="$2y$12$Lhm4fwl/EJjzmu/4i2JD9OUtktxdm41X0kaYBmePjm8vHXFJIlaIW">


                                            </div>


                                        </div>

                                    </div>



                                    <div class="box-footer text-center">

                                        <button type="submit" class="btn btn-success btn-lg">

                                            <i class="fa fa-save"></i>
                                            إرسال الطلب

                                        </button>


                                    </div>


                                </div>


                            </form>
                            <style>
                                .translator-photo {
                                    padding: 30px;
                                    border: 2px dashed #ddd;
                                    border-radius: 15px;
                                    background: #fafafa;
                                }


                                .form-group label {
                                    font-size: 16px;
                                    color: #555;
                                }


                                .form-control {
                                    height: 45px;
                                    border-radius: 8px;
                                }


                                .box {
                                    border-radius: 15px;
                                    box-shadow: 0 3px 15px rgba(0, 0, 0, .1);
                                }


                                .btn-lg {
                                    padding: 12px 35px;
                                    border-radius: 25px;
                                }
                            </style>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- LOGIN AREA END -->



    </div>
@endsection