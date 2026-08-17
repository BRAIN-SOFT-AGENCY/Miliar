@extends('web.layouts.app')

@section('content')
    <div class="body-wrapper">


        <!-- SLIDER AREA START (slider-3) -->
        <div class="ltn__slider-area ltn__slider-3---  section-bg-1--- mt-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 lg3proppictureInfo">
                        @foreach($bookBanner1 as $book)
                            <div class="article-box">
                                <div class="article-img" style="height: 205px;">
                                    <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">

                                        <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" alt="">
                                    </a>
                                </div>

                                <div class="article-content">
                                    <h3 class="article-title" title="{{ $book->Titre }}">
                                        <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">

                                            {{ $book->Titre }}
                                        </a>
                                    </h3>
                                    <p style="font-size: 12px;text-align: justify;">
                                        {{ \Illuminate\Support\Str::limit($book->ResumeLivre, 135, '...') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-9" style="padding: 0px 3px 1px 0px;">

                        <div class="tab-content">

                            <div class="tab-pane fade  active show" id="liton_product_list">
                                <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                    <div class="row">
                                        @foreach($bookBanner as $row)

                                            <div class="col-lg-6 bookbannerlg6prop2">
                                                <div class="ltn__product-item ltn__product-item-3" style="margin-bottom: 5px;">

                                                    <!-- 📷 الصورة -->
                                                    <div class="product-img">
                                                        <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                            <img class="bannerimgprotitle"
                                                                src="{{ asset('includesAdmin/img/books/' . $row->Image) }}"
                                                                alt="{{ $row->Titre }}">
                                                        </a>
                                                    </div>

                                                    <!-- 📦 المعلومات -->
                                                    <div class="product-info productinfostyle">

                                                        <!-- 📘 العنوان -->
                                                        <h2 class="product-title title-web">
                                                            <a
                                                                href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                                {{ $row->Titre}}
                                                            </a>
                                                        </h2>
                                                        <h2 class="product-title title-mobile">
                                                            <a
                                                                href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                                {{ $row->Titre}}
                                                            </a>

                                                        </h2>
                                                        <!-- 📝 الملخص -->
                                                        <div class="product-brief">
                                                            <p class="resume-web" style="font-size: 12px;text-align: justify;">
                                                                {{ \Illuminate\Support\Str::limit($row->ResumeLivre, 220, '...') }}
                                                            </p>
                                                            <p class="resume-mobile">
                                                                {{ \Illuminate\Support\Str::limit($row->ResumeLivre, 140, '...') }}
                                                            </p>

                                                        </div>




                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!--  -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- SLIDER AREA END -->



        <div class="ltn__product-area ltn__product-gutter mb-60 mt-30">
            <div class="container">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h1 class="section-title">أحدث الترجمات</h1>
                </div>
                <div class="row">
                    <div class="col-lg-8">

                        <div class="tab-content">

                            <div class="tab-pane fade  active show" id="liton_product_list">
                                <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                    <div class="row">
                                        @foreach($bookDerIndex as $row)

                                            <div class="col-lg-6">
                                                <div class="ltn__product-item ltn__product-item-3" style="margin-bottom: 10px;">

                                                    <!-- 📷 الصورة -->
                                                    <div class="product-img">
                                                        <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                            <img src="{{ asset('includesAdmin/img/books/' . $row->Image) }}"
                                                                alt="{{ $row->Titre }}" class="picturenews">
                                                        </a>
                                                    </div>

                                                    <!-- 📦 المعلومات -->
                                                    <div class="product-info" style="    padding: 10px 4px 0px 5px;">

                                                        <!-- 📘 العنوان -->
                                                        <h2 class="product-title titleInfo">
                                                            <a
                                                                href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                                {{ \Illuminate\Support\Str::limit($row->Titre, 25, '...') }}

                                                            </a>
                                                        </h2>

                                                        <!-- 📝 الملخص -->
                                                        <div class="product-brief briefInfo">
                                                            <p class="newsResumetWeb">
                                                                {{ \Illuminate\Support\Str::limit($row->ResumeLivre, 75, '...') }}
                                                            </p>
                                                            <p class="newsResumetMobile">
                                                                {{ \Illuminate\Support\Str::limit($row->ResumeLivre, 45, '...') }}
                                                            </p>
                                                        </div>

                                                        <div class="book-meta">

                                                            <div class="meta-item">
                                                                <i class="fas fa-book-open"></i>
                                                                <span>
                                                                    {{ $row->categoryName }}
                                                                </span>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!--  -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
                            @foreach($bookDerIndex2 as $row)


                                <div class="ltn__small-product-item">
                                    <div class="small-product-item-img">
                                        <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                            <img src="{{ asset('includesAdmin/img/books/' . $row->Image) }}" alt="Image"
                                                style="    min-width:100px;    max-height: 80px;"></a>
                                    </div>
                                    <div class="small-product-item-info">

                                        <h2 class="product-title" style="    height: 36px;">
                                            <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                {{ $row->Titre }}



                                            </a>
                                        </h2>
                                        <div class="book-meta">

                                            <div class="meta-item">
                                                <i class="fas fa-user-edit"></i>
                                                <span>
                                                    المؤلف: {{ $row->translatorfirstName }}
                                                    {{ $row->translatorlastName }}
                                                </span>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </aside>
                    </div>
                </div>
            </div>
        </div>



        <div class="ltn__small-product-list-area pt-80 pb-85">
            <div class="container">
                <div class="row custom-5-cols" style="    gap: 0px;">

                    {{-- 🔹 BOX 1 --}}
                    <div class="custom-box custom-boxCateg">
                        <div class="section-title-area text-center" style=" margin-bottom: 15px !important;">
                            <h1 class="section-title-2 border-bottom"
                                style="  margin-bottom: 0px;font-size:16px;text-align:right;">
                                الأدب و الثقافة
                            </h1>
                        </div>

                        @foreach($category1 as $book)
                            <div class="ltn__small-product-item">
                                <div class="small-product-item-img">
                                    <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                        <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" alt="Image"
                                            class="pictureCateg"></a>
                                </div>
                                <div class="small-product-item-info">

                                    <h2 class="productTitleCateg">
                                        <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                            {{ $book->Titre }}

                                        </a>
                                    </h2>

                                </div>
                            </div>
                        @endforeach

                        <a href="{{ route('miliar.books', ['categoryID' => 1]) }}" class="buttonPlus">المزيد</a>
                    </div>


                    {{-- 🔹 BOX 2 --}}
                    <div class="custom-box custom-boxCateg">
                        <h1 class="section-title-2 border-bottom" style="font-size:16px;text-align:right;">
                            الاقتصاد والأعمال
                        </h1>

                        @foreach($category2 as $book)
                            <div class="ltn__small-product-item">
                                <div class="small-product-item-img">
                                    <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                        <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" alt="Image"
                                            class="pictureCateg"></a>
                                </div>
                                <div class="small-product-item-info">

                                    <h2 class="productTitleCateg">
                                        <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                            {{ $book->Titre }}

                                        </a>
                                    </h2>

                                </div>
                            </div>
                        @endforeach

                        <a href="{{ route('miliar.books', ['categoryID' => 2]) }}" class="buttonPlus">المزيد</a>
                    </div>


                    {{-- 🔹 BOX 3 --}}
                    <div class="custom-box custom-boxCateg">
                        <h1 class="section-title-2 border-bottom" style="font-size:16px;text-align:right;">
                            العلوم والصحة
                        </h1>

                        @foreach($category3 as $book)
                            <div class="ltn__small-product-item">
                                <div class="small-product-item-img">
                                    <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                        <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" alt="Image"
                                            class="pictureCateg"></a>
                                </div>
                                <div class="small-product-item-info">

                                    <h2 class="productTitleCateg">
                                        <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                            {{ $book->Titre }}

                                        </a>
                                    </h2>

                                </div>
                            </div>
                        @endforeach

                        <a href="{{ route('miliar.books', ['categoryID' => 3]) }}" class="buttonPlus">المزيد</a>
                    </div>


                    {{-- 🔹 BOX 4 --}}
                    <div class="custom-box custom-boxCateg">
                        <h1 class="section-title-2 border-bottom" style="font-size:16px;text-align:right;">
                            التقنية والمستقبليات
                        </h1>

                        @foreach($category4 as $book)
                            <div class="ltn__small-product-item">
                                <div class="small-product-item-img">
                                    <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                        <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" alt="Image"
                                            class="pictureCateg"></a>
                                </div>
                                <div class="small-product-item-info">

                                    <h2 class="productTitleCateg">
                                        <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                            {{ $book->Titre }}

                                        </a>
                                    </h2>

                                </div>
                            </div>
                        @endforeach

                        <a href="{{ route('miliar.books', ['categoryID' => 4]) }}" class="buttonPlus">المزيد</a>
                    </div>


                    {{-- 🔹 BOX 5 --}}
                    <div class="custom-box custom-boxCateg">
                        <h1 class="section-title-2 border-bottom" style="font-size:16px;text-align:right;">
                            الفن والرياضة
                        </h1>

                        @foreach($category6 as $book)
                            <div class="ltn__small-product-item">
                                <div class="small-product-item-img">
                                    <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                        <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" alt="Image"
                                            class="pictureCateg"></a>
                                </div>
                                <div class="small-product-item-info">

                                    <h2 class="productTitleCateg">
                                        <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                            {{ $book->Titre }}

                                        </a>
                                    </h2>

                                </div>
                            </div>
                        @endforeach

                        <a href="{{ route('miliar.books', ['categoryID' => 6]) }}" class="buttonPlus">المزيد</a>
                    </div>

                </div>
            </div>
        </div>







        <!-- SMALL PRODUCT LIST AREA START -->
        <div class="ltn__small-product-list-area pt-80 pb-85">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-4 col-md-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title-area ltn__section-title-2--- text-center---">
                                    <h1 class="section-title-2 border-bottom" style="font-size: 16px;"> حديث الساعة
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row ltn__small-product-slider-active slick-arrow-1 slick-initialized slick-slider">
                            <!-- small-product-item -->
                            <div aria-live="polite" class="slick-list draggable">
                                <div role="listbox">
                                    <div
                                        class="col-lg-4 col-md-6 col-12 custom-width slick-slide slick-current slick-active">


                                        @foreach($bookDer as $row)


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

                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{ route('miliar.books') }}" class="buttonPlus">المزيد</a>

                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- small-product-item -->


                            <!--  -->
                        </div>
                    </div>




                    <div class="col-lg-4 col-md-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title-area ltn__section-title-2--- text-center---">
                                    <h1 class="section-title-2 border-bottom" style="font-size: 16px;"> الأكثر قراءة
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row ltn__small-product-slider-active slick-arrow-1 slick-initialized slick-slider">
                            <!-- small-product-item -->
                            <div aria-live="polite" class="slick-list draggable">
                                <div role="listbox">
                                    <div
                                        class="col-lg-4 col-md-6 col-12 custom-width slick-slide slick-current slick-active">

                                        @foreach($bookVue as $row)


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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{ route('miliar.books') }}" class="buttonPlus">المزيد</a>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- small-product-item -->


                            <!--  -->
                        </div>
                    </div>




                    <div class="col-lg-4 col-md-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title-area ltn__section-title-2--- text-center---">
                                    <h1 class="section-title-2 border-bottom" style="font-size: 16px;">اخترنا لك</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row ltn__small-product-slider-active slick-arrow-1 slick-initialized slick-slider">
                            <!-- small-product-item -->
                            <div aria-live="polite" class="slick-list draggable">
                                <div role="listbox">
                                    <div
                                        class="col-lg-4 col-md-6 col-12 custom-width slick-slide slick-current slick-active">
                                        @foreach($bookChoix as $row)


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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{ route('miliar.books') }}" class="buttonPlus">المزيد</a>

                                            </div>


                                        </div>
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
        
        <section class="stats-section text-center">



            <!-- BIG NUMBER -->


            <!-- DESCRIPTION -->
            <p class="description mt-4">
                مبادرة مليار كلمة تهدف إلى تعــزيــز المحتــوى الـعربـي مـن خـلال ترجمة مـليــار كلمـة فــي مختلف المجالات
                والمسـاهمـة فــي بنـاء جسر مــن المعـرفـة بيـن الثقـافـات
            </p>

            <!-- STATS -->
            <div class="row justify-content-center mt-5">

                <div class="col-md-3 stat-box">
                    <h3 id="translators">0</h3>
                    <p>عدد المترجمين</p>
                </div>
                <div class="col-md-4 big-counter-box">
                    <div class="">
                        <span id="mainCounter">0</span>
                        <p style="font-size: 14px;color: white;"> عدد الكلمات المترجمة حتى الآن
                        </p>
                    </div>
                </div>
                <div class="col-md-3 stat-box">
                    <h3 id="translations">0</h3>
                    <p>عدد الترجمات</p>
                </div>

            </div>

        </section>


        <div class="ltn__product-slider-area ltn__product-gutter pb-30 pt-50">
            <div class="container">

                <div class="row ltn__product-slider-item-four-active slick-arrow-1">
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part1.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part2.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part3.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part4.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part5.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part6.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part7.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part8.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part9.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part10.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part11.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part12.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part13.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part14.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part15.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part16.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part17.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img src="{{ asset('includesAdmin/img/part/part18.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BRAND LOGO AREA END -->



    </div>
    <!-- Body main wrapper end -->

    <!-- preloader area start -->
    <div class="preloader d-none" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->
    <script>
        function animateCounter(id, end, duration = 2000) {
            let start = 0;
            let range = end - start;
            let increment = Math.ceil(range / (duration / 16));
            let obj = document.getElementById(id);

            let timer = setInterval(() => {
                start += increment;
                if (start >= end) {
                    start = end;
                    clearInterval(timer);
                }
                obj.innerText = start.toLocaleString();
            }, 16);
        }

        // RUN
        window.onload = function () {
            animateCounter("mainCounter", 14984413, 2500);
            animateCounter("translators", 65, 1500);
            animateCounter("translations", 5827, 2000);
        };
    </script>
@endsection