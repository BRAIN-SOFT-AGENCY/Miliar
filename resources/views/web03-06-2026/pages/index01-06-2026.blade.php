@extends('web.layouts.app')

@section('content')
    <div class="body-wrapper">
        <div class="ltn__slider-area ltn__slider-3---  section-bg-1--- mt-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 bannerpicturedroitePro1">
                        @foreach($bookBanner1 as $book)
                            <div class="">

                                <div class="article-img overlay-style articlebookBanner1">
                                    <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                        <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" alt=""
                                            style="height:377px;">
                                    </a>

                                    <!-- Overlay -->
                                    <div class="overlay-content">
                                        <span class="category">
                                            {{ $book->categoryName ?? 'بدون تصنيف' }}
                                        </span>

                                        <h3 class="title">
                                            <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">

                                                {{ $book->Titre }}
                                            </a>
                                        </h3>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-6" style="padding: 0px;">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="liton_product_list">
                                <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                    <div class="row g-0">

                                        @foreach($bookBanner as $row1)
                                            <div class="col-lg-6 bannerpicturedroiteprop14">
                                                <div class="">

                                                    <div class="product-img overlay-style">
                                                        <a href="{{ route('miliar.booksDetails', ['id' => $row1->booksID]) }}">
                                                            <img src="{{ asset('includesAdmin/img/books/' . $row1->Image) }}"
                                                                style="width: 448px;" alt="{{ $row1->Titre }}">
                                                        </a>

                                                        <!-- Overlay -->
                                                        <div class="overlay-content">
                                                            <span class="category">
                                                                {{ $row1->categoryName ?? 'بدون تصنيف' }}
                                                            </span>

                                                            <h3 class="title">
                                                                <a
                                                                    href="{{ route('miliar.booksDetails', ['id' => $row1->booksID]) }}">

                                                                    {{ $row1->Titre }}
                                                                </a>
                                                            </h3>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="ltn__product-area ltn__product-gutter mt-30">
            <div class="container">
                <div class="row align-items-center mb-10">

                    <div class="col-md-5">
                        <div class="section-line"></div>
                    </div>

                    <div class="col-md-2 text-center">

                        <h4 class="section-title-custom">
                            أحدث الترجمات
                        </h4>

                    </div>

                    <div class="col-md-5">
                        <div class="section-line"></div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-8">

                        <div class="tab-content">

                            <div class="tab-pane fade  active show" id="liton_product_list">
                                <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                    <div class="row">
                                        @foreach($bookDerIndex as $row)

                                            <div class="col-lg-12">
                                                <div class="ltn__product-item ltn__product-item-3" style="margin-bottom: 10px;">

                                                    <!-- 📷 الصورة -->
                                                    <div class="product-img">
                                                        <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                            <img src="{{ asset('includesAdmin/img/books/' . $row->Image) }}"
                                                                alt="{{ $row->Titre }}" class="picturenews">
                                                        </a>
                                                    </div>

                                                    <!-- 📦 المعلومات -->
                                                    <div class="product-info" style="    padding: 10px 11px 0px 2px">

                                                        <!-- 📘 العنوان -->
                                                        <h2 class="product-title titleInfo">
                                                            <a
                                                                href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                                {{ \Illuminate\Support\Str::limit($row->Titre, 100, '...') }}

                                                            </a>
                                                        </h2>

                                                        <!-- category -->
                                                        <i class="fa-solid fa-tag"></i>
                                                        <span style="font-size:11px;color:gray;">
                                                            {{ $row->categoryName }}
                                                        </span>
                                                        <!-- 📝 الملخص -->
                                                        <div class="product-brief briefInfo">
                                                            <p class="newsResumetWeb">
                                                                {{ \Illuminate\Support\Str::limit($row->ResumeLivre, 155, '...') }}
                                                            </p>
                                                            <p class="newsResumetMobile">
                                                                {{ \Illuminate\Support\Str::limit($row->ResumeLivre, 45, '...') }}
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
                                                <span>
                                                    <!-- category -->
                                                    <i class="fa-solid fa-tag" style="    font-size: 10px;color: #d5ae69;"></i>
                                                    <span style="    font-size: 11px;    color: gray;">
                                                        {{ $row->categoryName }}
                                                    </span>
                                                </span>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </aside>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4"></div>

                    <div class="col-md-4 text-center">

                        <a href="{{ route('miliar.books') }}" class="buttonPlusIndex">

                            عرض جميع الترجمات
                            <i class="fas fa-chevron-left"></i>
                        </a>

                    </div>

                    <div class="col-md-4"></div>

                </div>
            </div>
        </div>


        <div class="ltn__product-area ltn__product-gutter mt-30">
            <div class="container">
                <div class="row align-items-center mb-10">

                    <div class="col-md-5">
                        <div class="section-line"></div>
                    </div>

                    <div class="col-md-2 text-center">

                        <h4 class="section-title-custom">
                            التصنيفات </h4>

                    </div>

                    <div class="col-md-5">
                        <div class="section-line"></div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-8">

                        <!-- 📚 BOOKS (par défaut actif) -->
                        <div class="cat-content active" id="books">
                            <div class="col-lg-12">

                                <div class="tab-content">

                                    <div class="tab-pane fade  active show" id="liton_product_list">
                                        <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                            <div class="row">
                                                @foreach($booksindex as $row)

                                                    <div class="col-lg-12">
                                                        <div class="ltn__product-item ltn__product-item-3"
                                                            style="margin-bottom: 10px;">

                                                            <!-- 📷 الصورة -->
                                                            <div class="product-img">
                                                                <a
                                                                    href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                                    <img src="{{ asset('includesAdmin/img/books/' . $row->Image) }}"
                                                                        alt="{{ $row->Titre }}" class="picturenews">
                                                                </a>
                                                            </div>

                                                            <!-- 📦 المعلومات -->
                                                            <div class="product-info" style="    padding: 10px 11px 0px 2px">

                                                                <!-- 📘 العنوان -->
                                                                <h2 class="product-title titleInfo">
                                                                    <a
                                                                        href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                                        {{ \Illuminate\Support\Str::limit($row->Titre, 100, '...') }}

                                                                    </a>
                                                                </h2>

                                                                <!-- category -->
                                                                <i class="fa-solid fa-tag"></i>
                                                                <span style="font-size:11px;color:gray;">
                                                                    {{ $row->categoryName }}
                                                                </span>
                                                                <!-- 📝 الملخص -->
                                                                <div class="product-brief briefInfo">
                                                                    <p class="newsResumetWeb">
                                                                        {{ \Illuminate\Support\Str::limit($row->ResumeLivre, 155, '...') }}
                                                                    </p>
                                                                    <p class="newsResumetMobile">
                                                                        {{ \Illuminate\Support\Str::limit($row->ResumeLivre, 45, '...') }}
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

                        <!-- 📄 ARTICLES -->
                        <div class="cat-content" id="articles">
                            <div class="col-lg-12">

                                <div class="tab-content">

                                    <div class="tab-pane fade  active show" id="liton_product_list">
                                        <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                            <div class="row">
                                                @foreach($articlesindex as $row)

                                                    <div class="col-lg-12">
                                                        <div class="ltn__product-item ltn__product-item-3"
                                                            style="margin-bottom: 10px;">

                                                            <!-- 📷 الصورة -->
                                                            <div class="product-img">
                                                                <a
                                                                    href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                                    <img src="{{ asset('includesAdmin/img/books/' . $row->Image) }}"
                                                                        alt="{{ $row->Titre }}" class="picturenews">
                                                                </a>
                                                            </div>

                                                            <!-- 📦 المعلومات -->
                                                            <div class="product-info" style="    padding: 10px 11px 0px 2px">

                                                                <!-- 📘 العنوان -->
                                                                <h2 class="product-title titleInfo">
                                                                    <a
                                                                        href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                                        {{ \Illuminate\Support\Str::limit($row->Titre, 100, '...') }}

                                                                    </a>
                                                                </h2>

                                                                <!-- category -->
                                                                <i class="fa-solid fa-tag"></i>
                                                                <span style="font-size:11px;color:gray;">
                                                                    {{ $row->categoryName }}
                                                                </span>
                                                                <!-- 📝 الملخص -->
                                                                <div class="product-brief briefInfo">
                                                                    <p class="newsResumetWeb">
                                                                        {{ \Illuminate\Support\Str::limit($row->ResumeLivre, 155, '...') }}
                                                                    </p>
                                                                    <p class="newsResumetMobile">
                                                                        {{ \Illuminate\Support\Str::limit($row->ResumeLivre, 45, '...') }}
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

                        <!-- 📊 STUDIES -->
                        <div class="cat-content" id="studies">

                            <div class="col-lg-12">

                                <div class="tab-content">

                                    <div class="tab-pane fade  active show" id="liton_product_list">
                                        <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                            <div class="row">
                                                @foreach($etudesindex as $row)

                                                    <div class="col-lg-12">
                                                        <div class="ltn__product-item ltn__product-item-3"
                                                            style="margin-bottom: 10px;">

                                                            <!-- 📷 الصورة -->
                                                            <div class="product-img">
                                                                <a
                                                                    href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                                    <img src="{{ asset('includesAdmin/img/books/' . $row->Image) }}"
                                                                        alt="{{ $row->Titre }}" class="picturenews">
                                                                </a>
                                                            </div>

                                                            <!-- 📦 المعلومات -->
                                                            <div class="product-info" style="    padding: 10px 11px 0px 2px">

                                                                <!-- 📘 العنوان -->
                                                                <h2 class="product-title titleInfo">
                                                                    <a
                                                                        href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                                        {{ \Illuminate\Support\Str::limit($row->Titre, 100, '...') }}

                                                                    </a>
                                                                </h2>

                                                                <!-- category -->
                                                                <i class="fa-solid fa-tag"></i>
                                                                <span style="font-size:11px;color:gray;">
                                                                    {{ $row->categoryName }}
                                                                </span>
                                                                <!-- 📝 الملخص -->
                                                                <div class="product-brief briefInfo">
                                                                    <p class="newsResumetWeb">
                                                                        {{ \Illuminate\Support\Str::limit($row->ResumeLivre, 155, '...') }}
                                                                    </p>
                                                                    <p class="newsResumetMobile">
                                                                        {{ \Illuminate\Support\Str::limit($row->ResumeLivre, 45, '...') }}
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
                    <div class="col-lg-4 col-md-4">

                        <div class="category-box">

                            <!-- 📚 Books -->
                            <button class="cat-btn active" data-target="books">

                                <span class="cat-text">
                                    <i class="fas fa-book-open ms-2"></i>
                                    مئات الكتب اللتي ننشرها كاملة أو جزئية مقدمة من دور النشر للمشاركة معنا
                                </span>

                                <span class="cat-count">
                                    {{ $booksCount }}
                                </span>

                            </button>

                            <!-- 📊 Studies -->
                            <button class="cat-btn" data-target="studies">


                                <span class="cat-text">
                                    <i class="fas fa-chart-line ms-2"></i>
                                    الدراسات والبحوث و التقارير المتخصصة و العلمية و من المنظمات الدولية
                                </span>
                                <span class="cat-count">
                                    {{ $studiesCount }}
                                </span>

                            </button>

                            <!-- 📝 Articles -->
                            <button class="cat-btn" data-target="articles">



                                <span class="cat-text">
                                    <i class="fas fa-pen-nib ms-2"></i>
                                    مقالات متنوعة في شتى المجالات ومن مصادر ولغات مختلفة
                                </span>
                                <span class="cat-count">
                                    {{ $articlesCount }}
                                </span>
                            </button>

                        </div>

                    </div>
                    <style>
                        .category-box {
                            display: flex;
                            flex-direction: column;
                            gap: 12px;
                        }

                        .cat-btn {
                            width: 100%;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            text-align: right;
                            background: #fcfcf8;
                            border: 1px solid #eee;
                            padding: 22px;
                            border-radius: 10px;
                            cursor: pointer;
                            transition: .3s;
                        }

                        .cat-btn:hover {
                            transform: translateX(-3px);
                            background: #f7f5ff;
                        }

                        .cat-btn.active {
                            background: #442d66;
                            color: #fff;
                        }

                        .cat-text {
                            flex: 1;
                            line-height: 1.8;
                            font-size: 14px;
                        }

                        .cat-count {
                            min-width: 42px;
                            height: 42px;
                            border-radius: 50px;
                            background: #eee;
                            color: #442d66;
                            font-weight: bold;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin-left: 12px;
                            font-size: 14px;
                        }

                        .cat-btn.active .cat-count {
                            background: #fff;
                            color: #442d66;
                        }
                    </style>
                    <style>
                        .category-box {
                            display: flex;
                            flex-direction: column;
                            gap: 12px;
                        }

                        .cat-btn {
                            width: 100%;
                            text-align: right;
                            background: #fcfcf8;
                            border: 1px solid #eee;
                            padding: 27px;
                            font-size: 14px;
                            color: #333;
                            border-radius: 6px;
                            cursor: pointer;
                        }

                        .cat-btn.active {
                            background: #442d66;
                            color: #fff;
                        }

                        /* IMPORTANT */
                        .cat-content {
                            display: none;
                        }

                        .cat-content.active {
                            display: block;
                        }
                    </style>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {

                            const buttons = document.querySelectorAll(".cat-btn");
                            const contents = document.querySelectorAll(".cat-content");

                            buttons.forEach(function (btn) {

                                btn.addEventListener("click", function () {

                                    let target = this.getAttribute("data-target");

                                    // buttons
                                    buttons.forEach(function (b) {
                                        b.classList.remove("active");
                                    });

                                    this.classList.add("active");

                                    // sections
                                    contents.forEach(function (c) {
                                        c.classList.remove("active");
                                    });

                                    document
                                        .getElementById(target)
                                        .classList.add("active");

                                });

                            });

                        });
                    </script>
                </div>
                <div class="row">

                    <div class="col-md-4"></div>

                    <div class="col-md-4 text-center">

                        <a href="{{ route('miliar.books') }}" class="buttonPlusIndexwhite">

                            عرض جميع التصنيفات
                            <i class="fas fa-chevron-left"></i>
                        </a>

                    </div>

                    <div class="col-md-4"></div>

                </div>
            </div>
        </div>



        <div class="ltn__small-product-list-area pt-80 pb-85">
            <div class="container">
                <div class="row custom-5-cols" style="    gap: 0px;">

                    {{-- 🔹 BOX 1 --}}
                    <div class="custom-box custom-boxCateg">
                        <div class="section-title-area text-center"
                            style="margin-bottom: 0px;    font-size: 16px;    text-align: center;    border-right: 5px solid #442d66;    padding: 10px;    background: #fcfcf8;   color: #442d66;">
                            <h1 class="section-title-2 border-bottom"
                                style="  margin-bottom: 0px;font-size:16px;text-align:center;">
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
                        <h1 class="section-title-2 border-bottom"
                            style="margin-bottom: 0px;
                                                                                                                                                            font-size: 16px;
                                                                                                                                                            text-align: center;
                                                                                                                                                            border-right: 5px solid #442d66;
                                                                                                                                                            padding: 10px;
                                                                                                                                                            background: #fcfcf8;
                                                                                                                                                            color: #442d66;">
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
                        <h1 class="section-title-2 border-bottom"
                            style="margin-bottom: 0px;
                                                                                                                                                            font-size: 16px;
                                                                                                                                                            text-align: center;
                                                                                                                                                            border-right: 5px solid #442d66;
                                                                                                                                                            padding: 10px;
                                                                                                                                                            background: #fcfcf8;
                                                                                                                                                            color: #442d66;">
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
                        <h1 class="section-title-2 border-bottom"
                            style="margin-bottom: 0px;
                                                                                                                                                            font-size: 16px;
                                                                                                                                                            text-align: center;
                                                                                                                                                            border-right: 5px solid #442d66;
                                                                                                                                                            padding: 10px;
                                                                                                                                                            background: #fcfcf8;
                                                                                                                                                            color: #442d66;">
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
                        <h1 class="section-title-2 border-bottom"
                            style="margin-bottom: 0px;
                                                                                                                                                            font-size: 16px;
                                                                                                                                                            text-align: center;
                                                                                                                                                            border-right: 5px solid #442d66;
                                                                                                                                                            padding: 10px;
                                                                                                                                                            background: #fcfcf8;
                                                                                                                                                            color: #442d66;">
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
                                    <h1 class="section-title-2 border-bottom"
                                        style="margin-bottom: 0px;
                                                                                                                                                            font-size: 16px;
                                                                                                                                                            text-align: center;
                                                                                                                                                            border-right: 5px solid #442d66;
                                                                                                                                                            padding: 10px;
                                                                                                                                                            background: #fcfcf8;
                                                                                                                                                            color: #442d66;">
                                        حديث
                                        الساعة
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
                                    <h1 class="section-title-2 border-bottom"
                                        style="margin-bottom: 0px;
                                                                                                                                                            font-size: 16px;
                                                                                                                                                            text-align: center;
                                                                                                                                                            border-right: 5px solid #442d66;
                                                                                                                                                            padding: 10px;
                                                                                                                                                            background: #fcfcf8;
                                                                                                                                                            color: #442d66;">
                                        الأكثر
                                        قراءة
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
                                    <h1 class="section-title-2 border-bottom"
                                        style="margin-bottom: 0px;
                                                                                                                                                            font-size: 16px;
                                                                                                                                                            text-align: center;
                                                                                                                                                            border-right: 5px solid #442d66;
                                                                                                                                                            padding: 10px;
                                                                                                                                                            background: #fcfcf8;
                                                                                                                                                            color: #442d66;">
                                        اخترنا
                                        لك
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






        <section class="stats-section">
            <div class="stats-container">
                <h2 class="stats-title">إحصائيات المنصة</h2>

                <div class="stats-grid">
                    <div class="stat-card">
                        <h3 id="translators" data-count="{{ $translatorscount }}"
                            style="    font-size: 43px; color: #442d66;">0</h3>

                        <span> عدد الشركاء</span>
                    </div>

                    <div class="stat-card featured">
                        <h3 id="translations" data-count="{{ $mainCounter }}" style="    font-size: 43px; color: #442d66;">0
                        </h3>
                        <span>كلمة مترجمة حتى الآن</span>
                    </div>

                    <div class="stat-card">
                        <h3 id="categories" data-count="{{ $categorycount }}" style="    font-size: 43px; color: #442d66;">0
                        </h3>
                        <span>عدد المواد </span>
                    </div>

                </div>
            </div>
        </section>



        <div class="ltn__product-slider-area ltn__product-gutter pb-30 pt-50">
            <div class="container">
                <div class="row align-items-center mb-10">

                    <div class="col-md-5">
                        <div class="section-line"></div>
                    </div>

                    <div class="col-md-2 text-center">

                        <h4 class="section-title-custom">
                            شركاؤنا </h4>

                    </div>

                    <div class="col-md-5">
                        <div class="section-line"></div>
                    </div>

                </div>

                <div class="row ltn__product-slider-item-four-active slick-arrow-1">
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part1.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part2.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part3.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part4.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part5.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part6.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part7.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part8.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part9.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part10.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part11.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part12.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part13.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part14.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part15.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part16.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part17.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="#">
                                    <img src="{{ asset('includesAdmin/img/part/part18.PNG') }}" alt="Brand Logo"
                                        style="    height: 143px;">
                                </a>


                            </div>

                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-4"></div>

                    <div class="col-md-4 text-center">
                        <br>
                        <a href="#" class="buttonPlusIndex">

                            عرض جميع الشركاء
                            <i class="fas fa-chevron-left"></i>
                        </a>

                    </div>

                    <div class="col-md-4"></div>

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
    <script id="counter-dynamic">
        function animateCounter(el, duration = 2000) {
            let end = parseInt(el.getAttribute("data-count"));
            let start = 0;
            let increment = Math.ceil(end / (duration / 16));

            let timer = setInterval(() => {
                start += increment;
                if (start >= end) {
                    start = end;
                    clearInterval(timer);
                }
                el.innerText = start.toLocaleString();
            }, 16);
        }

        // RUN
        window.onload = function () {
            document.querySelectorAll("[data-count]").forEach(el => {
                animateCounter(el);
            });
        };
    </script>
@endsection