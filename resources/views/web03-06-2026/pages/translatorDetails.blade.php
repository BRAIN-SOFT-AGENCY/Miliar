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
                                    style="    font-size: 20px;    color: #4d3572 !important;">
                                    {{ $translator->translatorfirstName }}
                                    {{ $translator->translatorLastName }}


                                </h6>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->

        <!-- TEAM DETAILS AREA START -->
        <div class="ltn__team-details-area mb-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ltn__team-details-member-info text-center mb-40">
                            <div class="team-details-img">
                                <img src="{{ asset('includesAdmin/img/translator/' . $translator->translatorPicture) }}"
                                    alt="Team Member Image">
                            </div>
                            <h2>{{ $translator->translatorfirstName }} {{ $translator->translatorLastName }}</h2>
                            <h6 class="text-uppercase ltn__secondary-color">{{ $translator->translatorPosition }}</h6>
                            <div class="ltn__social-media-3">
                                <ul>
                                    <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="ltn__team-details-member-info-details text-end">

                            <!-- 🧾 Description -->
                            <p class="mb-4" style="text-align: right;">
                                {{ $translator->description ?? 'مترجم محترف يتمتع بخبرة واسعة في مجال الترجمة، يعمل على نقل المعاني بدقة واحترافية مع مراعاة السياق الثقافي واللغوي. يلتزم بتقديم محتوى عالي الجودة يلبي احتياجات العملاء في مختلف المجالات.' }}
                            </p>

                            <div class="row" style="text-align: right;">

                                <!-- 🧑‍💼 Infos générales -->
                                <div class="col-lg-6">
                                    <ul class="list-unstyled">

                                        <li class="mb-2">
                                            <strong>المسمى الوظيفي:</strong>
                                            {{ $translator->position ?? 'مترجم' }}
                                        </li>

                                        <li class="mb-2">
                                            <strong>الخبرة:</strong>
                                            {{ $translator->experience ?? 'خبرة في مجال الترجمة' }}
                                        </li>

                                        <li class="mb-2">
                                            <strong>الموقع:</strong>
                                            {{ $translator->location ?? 'الرياض، المملكة العربية السعودية' }}
                                        </li>

                                        <li class="mb-2">
                                            <strong>تاريخ الانضمام:</strong>
                                            {{ \Carbon\Carbon::parse($translator->created_at)->format('Y-m-d') }}
                                        </li>

                                    </ul>
                                </div>

                                <!-- 📞 Contact -->
                                <div class="col-lg-6">
                                    <ul class="list-unstyled">

                                        <li class="mb-2">
                                            <strong>البريد الإلكتروني:</strong>
                                            {{ $translator->translatoremail }}
                                        </li>

                                        <li class="mb-2">
                                            <strong>رقم الهاتف:</strong>
                                            +966 5X XXX XXXX
                                        </li>

                                        <li class="mb-2">
                                            <strong>المدينة:</strong>
                                            الرياض
                                        </li>

                                    </ul>
                                </div>

                            </div>


                            <!-- 💡 About Translator -->
                            <p class="mt-3" style="text-align: right;">
                                يتمتع هذا المترجم بقدرة عالية على التعامل مع النصوص المتخصصة، سواء في المجالات التقنية أو
                                الطبية أو القانونية،
                                مع الالتزام بالدقة اللغوية وسرعة الإنجاز. يسعى دائمًا إلى تطوير مهاراته ومواكبة أحدث أساليب
                                الترجمة لضمان تقديم أفضل النتائج.
                            </p>

                            <!-- 🔥 Skills Section -->
                            <div class="row mt-4">

                                <div class="col-md-4">
                                    <div class="feature-box text-center p-3 shadow-sm rounded-4">
                                        <i class="bi bi-translate fs-1 text-primary"></i>
                                        <h6 class="mt-2">ترجمة احترافية</h6>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="feature-box text-center p-3 shadow-sm rounded-4">
                                        <i class="bi bi-clock-history fs-1 text-success"></i>
                                        <h6 class="mt-2">الالتزام بالمواعيد</h6>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="feature-box text-center p-3 shadow-sm rounded-4">
                                        <i class="bi bi-award fs-1 text-warning"></i>
                                        <h6 class="mt-2">جودة عالية</h6>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TEAM DETAILS AREA END -->



        <div class="ltn__small-product-list-area pt-80 pb-85">
            <div class="container">
                <div class="section-title-area text-center" style="margin-bottom: 0px;    font-size: 16px;    text-align: center;    border-right: 5px solid #442d66;    padding: 10px;    background: #fcfcf8;   color: #442d66;">
                            <h1 class="section-title-2 border-bottom"
                                style="  margin-bottom: 0px;font-size:20px;text-align:center; padding:10px">
                               أحدث الترجمات
                            </h1>
                        </div>
                <div class="row justify-content-center">

                    <div class="col-lg-4 col-md-6">

                        <div class="row ltn__small-product-slider-active slick-arrow-1 slick-initialized slick-slider">
                            <!-- small-product-item -->
                            <div aria-live="polite" class="slick-list draggable">
                                <div role="listbox">
                                    <div
                                        class="col-lg-4 col-md-6 col-12 custom-width slick-slide slick-current slick-active">


                                        @foreach($books1 as $row)


                                            <div class="ltn__small-product-item">
                                                <div class="small-product-item-img">
                                                    <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                        <img src="{{ asset('includesAdmin/img/books/' . $row->Image) }}"
                                                            alt="Image" style="    min-width:100px;    max-height: 80px;"></a>
                                                </div>
                                                <div class="small-product-item-info">

                                                    <h2 class="product-title">
                                                        <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                            {{ $row->Titre }}

                                                        </a>
                                                    </h2>
                                                    <div class="product-date d-flex align-items-center"
                                                        style="gap:5px; font-size: 14px; color:#555;">
                                                        <!-- Icône Calendrier SVG -->
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="#555" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                                                            <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                                        </svg>
                                                        <!-- Date -->
                                                        <span class="datepub">
                                                            {{ \Carbon\Carbon::parse($row->PublierLe)->translatedFormat('F d, Y') }}

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                            <!-- small-product-item -->


                            <!--  -->
                        </div>
                    </div>




                    <div class="col-lg-4 col-md-6">

                        <div class="row ltn__small-product-slider-active slick-arrow-1 slick-initialized slick-slider">
                            <!-- small-product-item -->
                            <div aria-live="polite" class="slick-list draggable">
                                <div role="listbox">
                                    <div
                                        class="col-lg-4 col-md-6 col-12 custom-width slick-slide slick-current slick-active">

                                        @foreach($books2 as $row)


                                            <div class="ltn__small-product-item">
                                                <div class="small-product-item-img">
                                                    <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                        <img src="{{ asset('includesAdmin/img/books/' . $row->Image) }}"
                                                            alt="Image" style="    min-width:100px;    max-height: 80px;"></a>
                                                </div>
                                                <div class="small-product-item-info">

                                                    <h2 class="product-title">
                                                        <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                            {{ $row->Titre }}

                                                        </a>
                                                    </h2>
                                                    <div class="product-date d-flex align-items-center"
                                                        style="gap:5px; font-size: 14px; color:#555;">
                                                        <!-- Icône Calendrier SVG -->
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="#555" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                                                            <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                                        </svg>
                                                        <!-- Date -->
                                                        <span class="datepub">
                                                            {{ \Carbon\Carbon::parse($row->PublierLe)->translatedFormat('F d, Y') }}

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <!-- small-product-item -->


                            <!--  -->
                        </div>
                    </div>




                    <div class="col-lg-4 col-md-6">

                        <div class="row ltn__small-product-slider-active slick-arrow-1 slick-initialized slick-slider">
                            <!-- small-product-item -->
                            <div aria-live="polite" class="slick-list draggable">
                                <div role="listbox">
                                    <div
                                        class="col-lg-4 col-md-6 col-12 custom-width slick-slide slick-current slick-active">
                                        @foreach($books3 as $row)


                                            <div class="ltn__small-product-item">
                                                <div class="small-product-item-img">
                                                    <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                        <img src="{{ asset('includesAdmin/img/books/' . $row->Image) }}"
                                                            alt="Image" style="    min-width:100px;    max-height: 80px;"></a>
                                                </div>
                                                <div class="small-product-item-info">

                                                    <h2 class="product-title">
                                                        <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                            {{ $row->Titre }}



                                                        </a>
                                                    </h2>
                                                    <div class="product-date d-flex align-items-center"
                                                        style="gap:5px; font-size: 14px; color:#555;">
                                                        <!-- Icône Calendrier SVG -->
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="#555" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                                                            <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                                        </svg>
                                                        <!-- Date -->
                                                        <span class="datepub">
                                                            {{ \Carbon\Carbon::parse($row->PublierLe)->translatedFormat('F d, Y') }}

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <!-- small-product-item -->


                            <!--  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FEATURE AREA START ( Feature - 3) -->


@endsection