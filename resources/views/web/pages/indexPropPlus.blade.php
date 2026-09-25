@extends('web.layouts.app')

@section('content')
    <style>
        p {
            font-family: var(--ltn__heading-font) !important;
        }
    </style>
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
                                                        <i class="fa-solid fa-tag" style="color:#d5ae69"></i>
                                                        <span style="font-size:11px;color:gray;color:#d5ae69;">
                                                            {{ $row->categoryName }}
                                                        </span>
                                                        <!-- 📝 الملخص -->
                                                        <div class="product-brief briefInfo">
                                                            <p class="newsResumetWeb">
                                                                {{ \Illuminate\Support\Str::limit($row->ResumeLivre, 155, '...')
                                                                                                }}
                                                            </p>
                                                            <p class="newsResumetMobile">
                                                                {{ \Illuminate\Support\Str::limit($row->ResumeLivre, 45, '...')
                                                                                                }}
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
                                            <!--img src="{{ !empty($row->Image) && file_exists(public_path('includesAdmin/img/books/' . $row->Image))
                                                                                                                        ? asset('includesAdmin/img/books/' . $row->Image)
                                                                                                                        : asset('includesAdmin/img/books/default.jpg') }}" alt="Image"
                                                                                                                                                        style="    min-width:100px;    max-height: 80px;"-->
                                            <img src="{{asset('includesAdmin/img/books/' . $row->Image) }}" alt="Image"
                                                style="    min-width:100px;    max-height: 80px;">
                                        </a>
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
                                                    <span style="    font-size: 11px;    color: #d5ae69;">
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
                                                                                                            <img src="{{asset('includesAdmin/img/books/' . $row->Image) }}"
                                                                                                                alt="{{ $row->Titre }}" class="picturenews">
                                                                                                        </a>
                                                                                                    </div>

                                                                                                    <!-- 📦 المعلومات -->
                                                                                                    <div class="product-info" style="    padding: 10px 11px 0px 2px">

                                                                                                        <!-- 📘 العنوان -->
                                                                                                        <h2 class="product-title titleInfo">
                                                                                                            <a
                                                                                                                href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                                                                                {{ \Illuminate\Support\Str::limit(
                                                        $row->Titre,
                                                        100,
                                                        '...'
                                                    ) }}

                                                                                                            </a>
                                                                                                        </h2>

                                                                                                        <!-- category -->
                                                                                                        <i class="fa-solid fa-tag" style="color:#d5ae69"></i>
                                                                                                        <span style="font-size:11px;color:gray;color:#d5ae69;">
                                                                                                            {{ $row->categoryName }}
                                                                                                        </span>
                                                                                                        <!-- 📝 الملخص -->
                                                                                                        <div class="product-brief briefInfo">
                                                                                                            <p class="newsResumetWeb">
                                                                                                                {{ \Illuminate\Support\Str::limit(
                                                        $row->ResumeLivre,
                                                        155,
                                                        '...'
                                                    ) }}
                                                                                                            </p>
                                                                                                            <p class="newsResumetMobile">
                                                                                                                {{ \Illuminate\Support\Str::limit(
                                                        $row->ResumeLivre,
                                                        45,
                                                        '...'
                                                    ) }}
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
                                                                                                                {{ \Illuminate\Support\Str::limit(
                                                        $row->Titre,
                                                        100,
                                                        '...'
                                                    ) }}

                                                                                                            </a>
                                                                                                        </h2>

                                                                                                        <!-- category -->
                                                                                                        <i class="fa-solid fa-tag" style="color:#d5ae69"></i>
                                                                                                        <span style="font-size:11px;color:gray;color:#d5ae69;">
                                                                                                            {{ $row->categoryName }}
                                                                                                        </span>
                                                                                                        <!-- 📝 الملخص -->
                                                                                                        <div class="product-brief briefInfo">
                                                                                                            <p class="newsResumetWeb">
                                                                                                                {{ \Illuminate\Support\Str::limit(
                                                        $row->ResumeLivre,
                                                        155,
                                                        '...'
                                                    ) }}
                                                                                                            </p>
                                                                                                            <p class="newsResumetMobile">
                                                                                                                {{ \Illuminate\Support\Str::limit(
                                                        $row->ResumeLivre,
                                                        45,
                                                        '...'
                                                    ) }}
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
                                                                                                                {{ \Illuminate\Support\Str::limit(
                                                        $row->Titre,
                                                        100,
                                                        '...'
                                                    ) }}

                                                                                                            </a>
                                                                                                        </h2>

                                                                                                        <!-- category -->
                                                                                                        <i class="fa-solid fa-tag" style="color:#d5ae69"></i>
                                                                                                        <span style="font-size:11px;color:gray;color:#d5ae69;">
                                                                                                            {{ $row->categoryName }}
                                                                                                        </span>
                                                                                                        <!-- 📝 الملخص -->
                                                                                                        <div class="product-brief briefInfo">
                                                                                                            <p class="newsResumetWeb">
                                                                                                                {{ \Illuminate\Support\Str::limit(
                                                        $row->ResumeLivre,
                                                        155,
                                                        '...'
                                                    ) }}
                                                                                                            </p>
                                                                                                            <p class="newsResumetMobile">
                                                                                                                {{ \Illuminate\Support\Str::limit(
                                                        $row->ResumeLivre,
                                                        45,
                                                        '...'
                                                    ) }}
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
                                    {{ $booksCountmodal }}
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

                            عرض جميع المنشورات
                            <i class="fas fa-chevron-left"></i>
                        </a>

                    </div>

                    <div class="col-md-4"></div>

                </div>
            </div>
        </div>


        <style>
            .ltn__book-card-img {
                position: relative;
                /* nécessaire pour positionner le badge */
                width: 100%;
                height: 170px;
                overflow: hidden;
            }

            .ltn__book-card-category {
                position: absolute;
                top: 130px;
                right: 12px;
                /* à gauche si le design est en LTR : left: 12px; */
                background: #d5ae69;
                /* couleur orange/rouge comme sur votre capture */
                color: #fff;
                font-size: 12px;
                font-weight: 700;
                padding: 5px 14px;
                border-radius: 20px;
                z-index: 2;
                white-space: nowrap;
            }

            /* ====== Section titre + lien "المزيد" ====== */
            .ltn__cards-section {
                padding: 40px 0;
            }

            .ltn__cards-section-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 30px;
            }

            .ltn__cards-section-header .more-link {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                color: #442d66;
                font-weight: 600;
                font-size: 15px;
                text-decoration: none;
                direction: ltr;
            }

            .ltn__cards-section-header .more-link .arrow-circle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background: #f4ead9;
                color: #442d66;
                font-size: 16px;
            }

            .ltn__cards-section-header .more-link:hover {
                opacity: 0.8;
            }

            .ltn__cards-section-title {
                display: flex;
                align-items: center;
                gap: 15px;
                font-size: 24px;
                font-weight: 800;
                color: #442d66;
                margin: 0;
            }

            .ltn__cards-section-title .title-line {
                flex: 0 0 70px;
                height: 3px;
                background: #442d66;
                border-radius: 2px;
            }

            /* ====== Grille de cartes ====== */
            .ltn__cards-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 25px;
            }

            @media (max-width: 991px) {
                .ltn__cards-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 575px) {
                .ltn__cards-grid {
                    grid-template-columns: 1fr;
                }
            }

            .ltn__book-card {
                background: #fff;
                border-radius: 14px;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
                display: flex;
                flex-direction: column;
                transition: transform .2s ease, box-shadow .2s ease;
            }

            .ltn__book-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            }

            .ltn__book-card-img {
                width: 100%;
                height: 170px;
                overflow: hidden;
            }

            .ltn__book-card-img img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .ltn__book-card-body {
                padding: 18px 20px 20px;
                display: flex;
                flex-direction: column;
                flex: 1;
            }

            .ltn__book-card-title {
                font-size: 17px;
                font-weight: 700;
                line-height: 1.45;
                margin: 0 0 10px;
            }

            .ltn__book-card-title a {
                color: #2b1c4f;
                text-decoration: none;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .ltn__book-card-title a:hover {
                color: #442d66;
            }

            .ltn__book-card-excerpt {
                font-size: 13.5px;
                color: #6c6c6c;
                line-height: 1.7;
                margin: 0 0 18px;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
                flex: 1;
            }

            .ltn__book-card-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-top: auto;
                direction: ltr;
            }

            .ltn__book-card-footer .read-btn {
                display: inline-block;
                background: #f4ead9;
                color: #2b1c4f;
                font-size: 13px;
                font-weight: 700;
                padding: 6px 20px;
                border-radius: 20px;
                text-decoration: none;
                white-space: nowrap;
            }

            .ltn__book-card-footer .read-btn:hover {
                background: #eaddc2;
            }

            .ltn__book-card-footer .book-date {
                display: flex;
                align-items: center;
                gap: 5px;
                font-size: 13px;
                color: #888;
                white-space: nowrap;
            }
        </style>


        {{-- ============================= --}}
        {{-- SECTION 2 : الأكثر قراءة --}}
        {{-- ============================= --}}
        <div class="ltn__cards-section">
            <div class="container">

                <div class="ltn__cards-section-header">
                    <h2 class="ltn__cards-section-title">
                        الأكثر قراءة
                        <span class="title-line"></span>
                    </h2>
                    <a href="{{ route('miliar.books') }}" class="more-link">
                        <span class="arrow-circle">&larr;</span>
                        المزيد
                    </a>
                </div>

                <div class="ltn__cards-grid">
                    @foreach($bookVue as $row)
                        <div class="ltn__book-card">
                            <div class="ltn__book-card-img">
                                <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                    <img src="{{ asset('includesAdmin/img/books/' . $row->Image) }}" alt="{{ $row->Titre }}">
                                </a>
                                @if(!empty($row->categoryName))
                                    <span class="ltn__book-card-category">{{ $row->categoryName }}</span>
                                @endif
                            </div>
                            <div class="ltn__book-card-body">
                                <h3 class="ltn__book-card-title">
                                    <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                        {{ $row->Titre }}
                                    </a>
                                </h3>

                                <p class="ltn__book-card-excerpt">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($row->Description ?? ''), 130) }}
                                </p>

                                <div class="ltn__book-card-footer">
                                    <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}" class="read-btn">
                                        اقرأ
                                    </a>
                                    <span class="book-date">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#888"
                                            stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($row->PublierLe)->translatedFormat('F d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        {{-- ============================= --}}
        {{-- SECTION 3 : اخترنا لك --}}
        {{-- ============================= --}}
        <div class="ltn__cards-section">
            <div class="container">

                <div class="ltn__cards-section-header">
                    <h2 class="ltn__cards-section-title">
                        اخترنا لك
                        <span class="title-line"></span>
                    </h2>
                    <a href="{{ route('miliar.books') }}" class="more-link">
                        <span class="arrow-circle">&larr;</span>
                        المزيد
                    </a>
                </div>

                <div class="ltn__cards-grid">
                    @foreach($bookChoix as $row)
                        <div class="ltn__book-card">
                            <div class="ltn__book-card-img">
                                <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                    <img src="{{ asset('includesAdmin/img/books/' . $row->Image) }}" alt="{{ $row->Titre }}">
                                </a>
                                @if(!empty($row->categoryName))
                                    <span class="ltn__book-card-category">{{ $row->categoryName }}</span>
                                @endif
                            </div>
                            <div class="ltn__book-card-body">
                                <h3 class="ltn__book-card-title">
                                    <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                        {{ $row->Titre }}
                                    </a>
                                </h3>

                                <p class="ltn__book-card-excerpt">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($row->Description ?? ''), 130) }}
                                </p>

                                <div class="ltn__book-card-footer">
                                    <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}" class="read-btn">
                                        اقرأ
                                    </a>
                                    <span class="book-date">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#888"
                                            stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($row->PublierLe)->translatedFormat('F d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>








        <section class="stats-section" dir="rtl">
            <div class="stats-bg"></div>

            <div class="stats-header">
                <span></span>
                <h2>إحصائيات المنصة</h2>
                <span></span>
                <p>نقدم لك نظرة شاملة على المحتوى والشركاء في المنصة</p>
            </div>

            <div class="stats-container">
                <div class="stat-card">
                    <!--div class="icon"><i class="fas fa-book-open"></i></div-->
                    <h3>{{ number_format($bookscount) }}</h3>
                    <small></small>
                    <p>عدد المواد</p>
                </div>

                <div class="stat-card featured">
                    <!--div class="icon gold"><i class="fas fa-language"></i></div-->
                    <h3>{{ number_format($articlescountmots) }}</h3>
                    <div class="shine"></div>
                    <p>كلمة مترجمة حتى الآن</p>
                </div>

                <div class="stat-card">
                    <!--div class="icon"><i class="fas fa-handshake"></i></div-->
                    <h3>{{ number_format($partnerscount) }}</h3>
                    <small></small>
                    <p>عدد الشركاء</p>
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
                    @foreach($partners as $row)

                        <div class="col-lg-12">
                            <div class="ltn__product-item ltn__product-item-3 text-center">
                                <div class="product-img">
                                    <a href="#">
                                        <img src="{{ asset('includesAdmin/img/part/' . $row->partnersPicture) }}"
                                            alt="Brand Logo" style="    height: 143px;">
                                    </a>


                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>


                <!--div class="row">

                                                                            <div class="col-md-4"></div>

                                                                            <div class="col-md-4 text-center">
                                                                                <br>
                                                                                <a href="#" class="buttonPlusIndex">

                                                                                    عرض جميع الشركاء
                                                                                    <i class="fas fa-chevron-left"></i>
                                                                                </a>

                                                                            </div>

                                                                            <div class="col-md-4"></div>

                                                                        </div-->
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