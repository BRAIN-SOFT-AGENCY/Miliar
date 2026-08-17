@extends('web.layouts.app')

@section('content')
    <div class="wrapper">


        <!-- Utilize Cart Menu Start -->

        <!-- Utilize Cart Menu End -->

        <!-- Utilize Mobile Menu Start -->

        <!-- Utilize Mobile Menu End -->

        <div class="ltn__utilize-overlay"></div>

        <!-- BREADCRUMB AREA START -->
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image"
            style="height:auto; padding:12px 0;margin-bottom: 23px;      ">
            <div class="container" style="   ">


                <div class="row align-items-center">

                    <div class="col-md-5">
                        <div class="section-line"></div>
                    </div>

                    <div class="col-md-2 text-center">

                        <h3 class="section-title-custom">
                            قائمة الترجمات
                        </h3>

                    </div>

                    <div class="col-md-5">
                        <div class="section-line"></div>
                    </div>

                </div>

            </div>
        </div>
        <!-- BREADCRUMB AREA END -->
        <style>
            /****stype page books****/
            .translator-item {
                display: flex;
                align-items: center;
                gap: 4px;
                padding: 2px 3px;
                border: 1px solid #e5e5e5;
                border-radius: 12px;
                margin-bottom: 2px;
                cursor: pointer;
                background: #fff;
            }

            /* radio plus petit */
            .translator-item input[type="radio"] {
                width: 10px;
                height: 10px;
                accent-color: #3f2767;
                margin-top: 8px;
                display: flex;
                align-items: center;
            }

            /* image */
            .translator-img {
                width: 42px;
                height: 42px;
                border-radius: 50%;
                object-fit: cover;
            }

            /* nom */
            .translator-info {
                flex: 1;
            }

            .translator-name {
                font-weight: 600;
                color: #222;
                font-size: 11px;
            }

            /* compteur à gauche */
            .translator-count {
                margin: 0;
                font-size: 9px;
                color: #3f2767;
                border: 1px solid #ccc;
                padding: 4px 8px;
                border-radius: 20px;
                white-space: nowrap;
            }

            .translator-list {
                border-radius: 12px;
                overflow: hidden;
            }



            .translator-item:last-child {
                border-bottom: none;
            }

            .translator-item:hover {
                background: #f8f8f8;
            }

            .hidden-translator {
                display: none;
            }

            .show-more-btn {
                width: 100%;
                margin-top: 12px;
                border: none;
                background: #f7f7f7;
                border-radius: 10px;
                padding: 2px;
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 10px;
                cursor: pointer;
                transition: 0.3s;
                font-size: 14px;
                font-weight: 600;
                color: #3f2567;
            }

            .show-more-btn:hover {
                background: #ececec;
            }

            .show-more-btn i {
                transition: 0.3s;
            }

            .show-more-btn.active i {
                transform: rotate(180deg);
            }

            body {
                background: #fafafa;
            }

            .container {
                max-width: 1400px;
            }

            /* =========================================
                                                                                                                                                                                                                                                                                                                                                                   TOPBAR
                                                                                                                                                                                                                                                                                                                                                                ========================================= */

            .modern-topbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 35px;
            }

            .modern-count {
                color: #777;
                font-size: 14px;
            }

            .modern-sort select {
                border: none;
                background: transparent;
                font-size: 15px;
                color: #333;
                padding: 0 10px;
            }

            /* =========================================
                                                                                                                                                                                                                                                                                                                                                                   CARD
                                                                                                                                                                                                                                                                                                                                                                ========================================= */

            .article-card {
                background: #fff;
                border-radius: 18px;
                overflow: hidden;
                transition: 0.35s;
                height: 100%;
                position: relative;
            }

            .article-card:hover {
                transform: translateY(-5px);
            }

            .article-image {
                height: 220px;
                overflow: hidden;
                position: relative;
            }

            .article-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: 0.4s;
            }

            .article-card:hover .article-image img {
                transform: scale(1.05);
            }

            /* CATEGORY FLOATING */

            .article-category {
                position: absolute;
                bottom: 15px;
                right: 15px;
                background: #f4ede2;
                color: #b9853b;
                font-size: 12px;
                padding: 6px 14px;
                border-radius: 10px;
                font-weight: 600;
                z-index: 2;
            }

            /* CONTENT */

            .article-content {
                padding: 22px;
                text-align: center;
            }

            .article-title {
                font-size: 14px;
                text-align: right;
                line-height: 1.5;
                margin-bottom: 14px;
                font-weight: 700;
                min-height: 49px;
                -webkit-line-clamp: 2;
            }

            .article-title a {
                color: #111;
            }

            .article-title a:hover {
                color: #4d3572;
            }

            .article-desc {
                color: #777;
                line-height: 1.7;
                font-size: 12px;
                text-align: right;
                min-height: 95px;
                /* afficher seulement 5 lignes */
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 5;

                overflow: hidden;
                text-overflow: ellipsis;
            }

            .product-brief {
                color: #777;
                line-height: 1.7;
                font-size: 11px;
                text-align: right;
                /* afficher seulement 3 lignes */
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 4;

                overflow: hidden;
                text-overflow: ellipsis;
            }

            /* FOOTER */

            .article-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;

            }

            .article-meta {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .article-date {
                color: #999;
                font-size: 10px;
            }

            .article-author {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .article-author img {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                object-fit: cover;
            }

            .article-author span {
                font-size: 10px;
                color: #444;
            }

            /* ICON */

            .article-bookmark {
                color: #777;
                font-size: 17px;
                display: flex;
                gap: 15px;
            }

            /* =========================================
                                                                                                                                                                                                                                                                                                                                                                   SIDEBAR
                                                                                                                                                                                                                                                                                                                                                                ========================================= */

            .modern-widget {
                background: #fff;
                border-radius: 18px;
                padding: 10px;
                margin-bottom: 25px;
            }

            .modern-widget h4 {
                font-size: 20px;
                margin-bottom: 20px;
                font-weight: 700;
            }

            .modern-widget input {
                width: 100%;
                height: 50px;
                border: 1px solid #eee;
                border-radius: 12px;
                padding: 0 15px;
                background: #fafafa;
                margin-bottom: 10px !important;
            }

            .check-item {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            /* =========================================
                                                                                                                                                                                                                                                                                                                                                                   PAGINATION
                                                                                                                                                                                                                                                                                                                                                                ========================================= */

            .ltn__pagination ul {
                gap: 10px;
                justify-content: center;
            }

            .ltn__pagination ul li a {
                width: 42px;
                height: 42px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 12px;
                background: #fff;
                color: #222;
            }

            .ltn__pagination ul li.active a {
                background: #32235f;
                color: #fff;
            }

            /* =========================================
                                                                                                                                                                                                                                                                                                                                                                   RESPONSIVE
                                                                                                                                                                                                                                                                                                                                                                ========================================= */

            @media(max-width:991px) {

                .article-title {
                    font-size: 22px;
                    min-height: auto;
                }

                .article-desc {
                    min-height: auto;
                }

            }

            /* ================================
                                                                                                                       SIDEBAR GLOBAL BOX (NEW)
                                                                                                                    ================================ */
            .modern-sidebar-box {
                background: #fff;
                border: 1px solid #ddd;
                border-radius: 12px;
                overflow: hidden;
            }

            /* ================================
                                                                                                                       CHAQUE WIDGET = SECTION BORDER
                                                                                                                    ================================ */
            .modern-sidebar-box .modern-widget,
            .modern-sidebar-box .widget,
            .modern-sidebar-box .ltn__price-filter-widget {
                margin: 0;
                padding: 16px;
                /*   border-bottom: 1px solid #e5e5e5;*/
            }

            /* dernier bloc sans border */
            .modern-sidebar-box .modern-widget:last-child,
            .modern-sidebar-box .widget:last-child,
            .modern-sidebar-box .ltn__price-filter-widget:last-child {
                border-bottom: none;
            }

            /* ================================
                                                                                                                       TITRE (garder ton style + spacing clean)
                                                                                                                    ================================ */
            .modern-sidebar-box .ltn__widget-title {
                margin-bottom: 12px;
            }

            /* ================================
                                                                                                                       INPUTS / SEARCH CLEAN
                                                                                                                    ================================ */
            .modern-sidebar-box input[type="text"] {
                border-radius: 10px;
            }

            /* ================================
                                                                                                                       HOVER OPTIONNEL (look moderne)
                                                                                                                    ================================ */
            .modern-sidebar-box .modern-widget:hover,
            .modern-sidebar-box .widget:hover {
                background: #fafafa;
                transition: 0.2s;
            }

            /*****end style page books**********/

            .booking-calendar {

                width: 100%;
                height: 48px;

                border: 1px solid #ddd;

                border-radius: 12px;

                background: #fff;

                text-align: right;

                padding: 10px 15px;

                font-size: 14px;

                cursor: pointer;

                transition: .3s;
            }

            .booking-calendar:focus {

                border-color: #0d6efd;

                box-shadow: 0 0 0 4px rgba(13, 110, 253, .1);
            }
        </style>
        <!-- PRODUCT DETAILS AREA START -->
        <div class="ltn__product-area ltn__product-gutter">
            <div class="container">
                <div class="row" style="direction: ltr;">
              
<div class="col-lg-3 order-lg-2" style="direction: rtl;">

    <aside class="sidebar ltn__shop-sidebar modern-sidebar-box">

        <form id="filterForm"
              method="GET"
              action="{{ route('miliar.books') }}">

            {{-- ========================================================= --}}
            {{-- SEARCH KEYWORD --}}
            {{-- ========================================================= --}}

            <div class="modern-widget">

                <h4 class="ltn__widget-title ltn__widget-title-border">
                    البحث
                </h4>

                <div class="keyword-search">

                    <input   type="text"      name="search"        id="keywordSearch"      value="{{ request('search') }}"     placeholder="ابحث     ..."         autocomplete="off" >


                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- TYPE --}}
            {{-- ========================================================= --}}

            <div class="modern-widget">

                <h4 class="ltn__widget-title ltn__widget-title-border">
                    النوع
                </h4>

                <div class="checkbox-group custom-checkbox">

                    <label class="check-item">

                        <input
                            type="checkbox"
                            name="type[]"
                            value="0"
                            @checked(in_array(0, request('type', [])))
                        >

                        <span class="checkmark"></span>

                        المقالات

                    </label>


                    <label class="check-item">

                        <input
                            type="checkbox"
                            name="type[]"
                            value="1"
                            @checked(in_array(1, request('type', [])))
                        >

                        <span class="checkmark"></span>

                        الكتب

                    </label>


                    <label class="check-item">

                        <input
                            type="checkbox"
                            name="type[]"
                            value="2"
                            @checked(in_array(2, request('type', [])))
                        >

                        <span class="checkmark"></span>

                        الدراسات

                    </label>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- SOURCE --}}
            {{-- ========================================================= --}}

            <div class="modern-widget">

                <h4 class="ltn__widget-title ltn__widget-title-border">
                    المصدر
                </h4>

                <input
                    type="text"
                    name="MaisonEdition"
                    value="{{ request('MaisonEdition') }}"
                    placeholder="المصدر ..."
                >

            </div>


            {{-- ========================================================= --}}
            {{-- YEAR --}}
            {{-- ========================================================= --}}

            <div class="widget ltn__price-filter-widget">

                <h4 class="ltn__widget-title ltn__widget-title-border">
                    سنة الترجمة
                </h4>

                <div class="price_filter">

                    <div class="price_slider_amount">

                        <input
                            type="submit"
                            value="النطاق الخاص بك:"
                        >

                        <input
                            type="text"
                            class="amount"
                            id="yearRange"
                            readonly
                            placeholder="اختر السنوات"
                        >

                        <input
                            type="hidden"
                            name="year_from"
                            id="year_from"
                            value="{{ request('year_from', 2000) }}"
                        >

                        <input
                            type="hidden"
                            name="year_to"
                            id="year_to"
                            value="{{ request('year_to', 2026) }}"
                        >

                    </div>

                    <div id="year-slider"></div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- DATE PUBLICATION --}}
            {{-- ========================================================= --}}

            <div class="modern-widget">

                <h4 class="ltn__widget-title ltn__widget-title-border">
                    تاريخ النشر
                </h4>

                <div class="calendar-filter">

                    <input
                        type="date"
                        name="publish_date"
                        id="publish_date"
                        class="booking-calendar"
                        value="{{ request('publish_date') }}"
                    >

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- TRANSLATOR --}}
            {{-- ========================================================= --}}

            <div class="modern-widget">

                <h4 class="ltn__widget-title ltn__widget-title-border">
                    المترجم
                </h4>


                {{-- SEARCH TRANSLATOR --}}
                <div class="translator-search-box">

                    <input
                        type="text"
                        id="translatorSearch"
                        placeholder="ابحث عن المترجم ..."
                        autocomplete="off"
                    >

                    <i class="fas fa-search"></i>

                </div>


                <div class="translator-list" id="translatorList">

                    @foreach($translators as $translator)

                        @php

                            $translatorFullName =
                                trim(
                                    $translator->translatorfirstName .
                                    ' ' .
                                    $translator->translatorLastName
                                );

                        @endphp

                        <label
                            class="translator-item"
                            data-name="{{ mb_strtolower($translatorFullName) }}"
                        >

                            <input
                                type="radio"
                                name="translatorName"
                                value="{{ $translatorFullName }}"
                                {{ request('translatorName') == $translatorFullName ? 'checked' : '' }}
                            >


                            <img
                                class="translator-img"
                                src="{{ asset('includesAdmin/img/translator/' . $translator->translatorPicture) }}"
                                alt="{{ $translatorFullName }}"
                            >


                            <div class="translator-info">

                                <span class="translator-name">

                                    {{ $translator->translatorfirstName }}

                                    {{ $translator->translatorLastName }}

                                </span>

                            </div>


                            <p class="translator-count">

                                {{ $translator->books_count }}

                                ترجمة

                            </p>

                        </label>

                    @endforeach

                </div>


                @if(count($translators) > 5)

                    <button
                        type="button"
                        class="show-more-btn"
                        id="showMoreBtn"
                    >

                        <span>
                            عرض جميع المترجمين
                        </span>

                        <i class="fas fa-chevron-down"></i>

                    </button>

                @endif

            </div>


        </form>

    </aside>

</div>


                    <div class="col-lg-9 order-lg-1" style="direction: rtl;">

                        <div class="ltn__shop-options">
                            <ul class="filter-bar">

                                <!-- GRID / LIST -->
                                <li>
                                    <div class="ltn__grid-list-tab-menu">
                                        <div class="nav">
                                            <a class="active show" data-bs-toggle="tab" href="#liton_product_grid">
                                                <i class="fas fa-th-large"></i>
                                            </a>
                                            <a data-bs-toggle="tab" href="#liton_product_list">
                                                <i class="fas fa-list"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <!-- SORT -->
                           
<li>

    <div class="short-by text-center">

        <form
            method="GET"
            action="{{ route('miliar.books') }}"
            id="sortForm"
        >

            {{-- ===================================================== --}}
            {{-- CONSERVATION AUTOMATIQUE DE TOUS LES FILTRES --}}
            {{-- ===================================================== --}}

            @foreach(request()->except(['sort', 'page']) as $key => $value)

                @if(is_array($value))

                    @foreach($value as $subKey => $subValue)

                        <input
                            type="hidden"
                            name="{{ $key }}[{{ $subKey }}]"
                            value="{{ $subValue }}"
                        >

                    @endforeach

                @else

                    <input
                        type="hidden"
                        name="{{ $key }}"
                        value="{{ $value }}"
                    >

                @endif

            @endforeach


            {{-- ===================================================== --}}
            {{-- SORT --}}
            {{-- ===================================================== --}}

            <select
                name="sort"
                class="nice-select"
                onchange="this.form.submit()"
            >

                <option
                    value=""
                    {{ request('sort') === null || request('sort') === '' ? 'selected' : '' }}
                >
                    الترتيب الافتراضي
                </option>


                <option
                    value="popular"
                    {{ request('sort') === 'popular' ? 'selected' : '' }}
                >
                    الترتيب حسب الأكثر شهرة
                </option>


                <option
                    value="newest"
                    {{ request('sort') === 'newest' ? 'selected' : '' }}
                >
                    الترتيب حسب الإصدارات الجديدة
                </option>


                <option
                    value="title_asc"
                    {{ request('sort') === 'title_asc' ? 'selected' : '' }}
                >
                    الترتيب حسب العنوان: من الألف إلى الياء
                </option>


                <option
                    value="title_desc"
                    {{ request('sort') === 'title_desc' ? 'selected' : '' }}
                >
                    الترتيب حسب العنوان: من الياء إلى الألف
                </option>

            </select>

        </form>

    </div>

</li>



                            </ul>
                        </div>
                        <div class="tab-content">
                            <!-- GRID VIEW -->
                            <div class="tab-pane fade show active" id="liton_product_grid">
                                <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                    <div class="row g-4">

                                        @foreach($books as $book)

                                            <div class="col-xl-4 col-md-6">

                                                <article class="article-card">

                                                    {{-- IMAGE --}}
                                                    <div class="article-image">

                                                        <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">

                                                            <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}"
                                                                alt="{{ $book->Titre }}">

                                                        </a>

                                                        {{-- CATEGORY --}}
                                                        <span class="article-category">

                                                            {{ $book->category->categoryName ?? '' }}

                                                        </span>

                                                    </div>

                                                    {{-- CONTENT --}}
                                                    <div class="article-content">

                                                        {{-- TITLE --}}
                                                        <h3 class="article-title">

                                                            <a
                                                                href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">

                                                                {{ \Illuminate\Support\Str::limit($book->Titre, 65, '...') }}

                                                            </a>

                                                        </h3>

                                                        {{-- DESCRIPTION --}}
                                                        <p class="article-desc">

                                                            {{$book->ResumeLivre }}

                                                        </p>

                                                        {{-- FOOTER --}}
                                                        <div class="article-footer">

                                                            {{-- RIGHT --}}
                                                            <div class="article-meta">

                                                                <div class="article-author">

                                                                    <img src="{{ asset('includesAdmin/img/translator/' . $book->translator->translatorPicture) }}"
                                                                        alt="author">

                                                                    <span>
                                                                        {{ $book->translator->translatorfirstName }}
                                                                        {{ $book->translator->translatorLastName }}
                                                                    </span>

                                                                </div>

                                                                <span class="article-date">

                                                                    {{ \Carbon\Carbon::parse($book->PublierLe)->format('d M Y') }}

                                                                </span>

                                                            </div>

                                                            {{-- LEFT --}}
                                                            <div class="article-bookmark">

                                                                <i class="far fa-bookmark"></i>

                                                                <i class="far fa-heart"></i>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </article>

                                            </div>

                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <!-- LIST VIEW -->
                            <div class="tab-pane fade" id="liton_product_list">
                                <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                    <div class="row">
                                        @foreach($books as $book)
                                            <div class="col-lg-12">
                                                <div class="ltn__product-item ltn__product-item-3">
                                                    <div class="product-img">
                                                        <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                                            <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}"
                                                                alt="{{ $book->Titre }}"
                                                                style="height: 180px;padding: 5px;width: 276px;    border-top-right-radius: 10px;           border-top-left-radius: 10px;">
                                                        </a>

                                                    </div>
                                                    <div class="product-info">
                                                        <h2 class="product-title" style="    height: 18px;">
                                                            <a
                                                                href="">{{ \Illuminate\Support\Str::limit($book->Titre, 50, '...') }}</a>
                                                        </h2>
                                                        <div class="product-brief">
                                                            <p>
                                                                {{ $book->ResumeLivre }}
                                                            </p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="article-footer" style="margin-top: 0px;">

                                                                {{-- RIGHT --}}
                                                                <div class="article-meta">

                                                                    <div class="article-author">

                                                                        <img src="{{ asset('includesAdmin/img/translator/' . $book->translator->translatorPicture) }}"
                                                                            alt="author">

                                                                        <span>
                                                                            {{ $book->translator->translatorfirstName }}
                                                                            {{ $book->translator->translatorLastName }}
                                                                        </span>

                                                                    </div>

                                                                    <span class="article-date">

                                                                        {{ \Carbon\Carbon::parse($book->PublierLe)->format('d M Y') }}

                                                                    </span>

                                                                </div>

                                                                {{-- LEFT --}}
                                                                <div class="article-bookmark">

                                                                    <i class="far fa-bookmark"></i>

                                                                    <i class="far fa-heart"></i>

                                                                </div>

                                                            </div>

                                                        </div>





                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PAGINATION -->

                        <div class="ltn__pagination-area text-center" style="padding-bottom:40px">
                            <div class="ltn__pagination">
                                <ul>
                                    {{-- Flèche précédente --}}
                                    @if ($books->onFirstPage())
                                        <li class="disabled"><span><i class="fas fa-angle-double-right"></i></span></li>
                                    @else
                                        <li><a href="{{ $books->previousPageUrl() }}"><i
                                                    class="fas fa-angle-double-right"></i></a>
                                        </li>
                                    @endif

                                    {{-- Pagination dynamique 10 pages à la fois --}}
                                    @php
                                        $current = $books->currentPage();
                                        $last = $books->lastPage();
                                        $start = max($current - 5, 1); // première page visible
                                        $end = min($start + 9, $last); // dernière page visible
                                    @endphp

                                    @for ($i = $start; $i <= $end; $i++)
                                        <li class="{{ $i == $current ? 'active' : '' }}">
                                            <a href="{{ $books->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    {{-- Flèche suivante --}}
                                    @if ($books->hasMorePages())
                                        <li><a href="{{ $books->nextPageUrl() }}"><i class="fas fa-angle-double-left"></i></a>
                                        </li>
                                    @else
                                        <li class="disabled"><span><i class="fas fa-angle-double-left"></i></span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!-- PRODUCT DETAILS AREA END -->



        </div>
        <!-- Body main wrapper end -->

        </div>

    @push('scripts')

<script>

$(document).ready(function () {


    /*
    |--------------------------------------------------------------------------
    | FORM
    |--------------------------------------------------------------------------
    */

    const filterForm = $('#filterForm');


    /*
    |--------------------------------------------------------------------------
    | TYPE
    |--------------------------------------------------------------------------
    |
    | Quand on coche/décoche un type :
    | tous les autres paramètres du formulaire sont envoyés aussi.
    |
    */

    filterForm.find('input[name="type[]"]').on('change', function () {

        filterForm.submit();

    });


    /*
    |--------------------------------------------------------------------------
    | SOURCE
    |--------------------------------------------------------------------------
    |
    | On évite d'envoyer le formulaire à chaque caractère.
    | Le formulaire est envoyé quand l'utilisateur quitte le champ.
    |
    */

    $('input[name="MaisonEdition"]').on('change', function () {

        filterForm.submit();

    });


    /*
    |--------------------------------------------------------------------------
    | DATE
    |--------------------------------------------------------------------------
    */

    $('#publish_date').on('change', function () {

        filterForm.submit();

    });


    /*
    |--------------------------------------------------------------------------
    | TRANSLATOR
    |--------------------------------------------------------------------------
    */

    $('input[name="translatorName"]').on('change', function () {

        filterForm.submit();

    });


    /*
    |--------------------------------------------------------------------------
    | KEYWORD SEARCH
    |--------------------------------------------------------------------------
    */

    $('#keywordSearch').on('keypress', function (e) {

        if (e.which === 13) {

            e.preventDefault();

            filterForm.submit();

        }

    });


    /*
    |--------------------------------------------------------------------------
    | YEAR SLIDER
    |--------------------------------------------------------------------------
    */

    if ($('#year-slider').length) {

        let yearFrom =
            parseInt(
                $('#year_from').val()
            ) || 2000;

        let yearTo =
            parseInt(
                $('#year_to').val()
            ) || 2026;


        $('#year-slider').slider({

            range: true,

            min: 2000,

            max: 2026,

            values: [
                yearFrom,
                yearTo
            ],


            slide: function (event, ui) {

                $('#yearRange').val(
                    ui.values[0] +
                    ' - ' +
                    ui.values[1]
                );


                $('#year_from').val(
                    ui.values[0]
                );


                $('#year_to').val(
                    ui.values[1]
                );

            },


            stop: function () {

                filterForm.submit();

            }

        });


        /*
        | Initialisation affichage
        */

        $('#yearRange').val(

            $('#year-slider').slider(
                'values',
                0
            )
            +
            ' - ' +
            $('#year-slider').slider(
                'values',
                1
            )

        );

    }


    /*
    |--------------------------------------------------------------------------
    | TRANSLATOR SEARCH LOCAL
    |--------------------------------------------------------------------------
    |
    | Cette recherche sert uniquement à filtrer visuellement
    | la liste des traducteurs.
    |
    | Elle ne remplace PAS translatorName.
    |
    */

    $('#translatorSearch').on('keyup', function () {

        let value =
            $(this).val()
                .toLowerCase()
                .trim();


        $('#translatorList .translator-item').each(function () {

            let name =
                $(this)
                    .data('name')
                    .toString()
                    .toLowerCase();


            if (
                value === '' ||
                name.indexOf(value) !== -1
            ) {

                $(this).show();

            } else {

                $(this).hide();

            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | SHOW MORE TRANSLATORS
    |--------------------------------------------------------------------------
    */

    let translatorItems =
        $('#translatorList .translator-item');


    if (translatorItems.length > 5) {

        translatorItems.slice(5).hide();

    }


    $('#showMoreBtn').on('click', function () {

        let hiddenItems =
            translatorItems.slice(5);


        if (hiddenItems.first().is(':visible')) {

            hiddenItems.hide();

            $(this)
                .find('span')
                .text('عرض جميع المترجمين');


            $(this)
                .find('i')
                .removeClass('fa-chevron-up')
                .addClass('fa-chevron-down');

        } else {

            hiddenItems.show();

            $(this)
                .find('span')
                 .text('إخفاء المترجمين');


            $(this)
                .find('i')
                .removeClass('fa-chevron-down')
                .addClass('fa-chevron-up');

        }

    });


});

</script>

@endpush

@endsection