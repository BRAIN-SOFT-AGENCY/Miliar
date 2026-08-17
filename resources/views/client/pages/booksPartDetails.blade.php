@extends('client.layouts.app')

@section('content')

<div class="body-wrapper">

    <!-- ===================== PAGE DETAILS ===================== -->

    <div class="book-details-area pt-50 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-lg-1 order-2">
                    <div class="custom-box custom-boxCateg">

                        {{-- ================= BOOK PARTS ================= --}}
                        <?php if (($groupedBooks != null) && count($groupedBooks) > 0) { ?>

                            <div class="row align-items-center">

                                <div class="col-md-2">
                                    <div class="section-line"></div>
                                </div>

                                <div class="col-md-8 text-center">
                                    <h3 class="section-title-custom" style="font-size: 16px; margin-bottom: 10px;">
                                        أجزاء الكتاب
                                    </h3>
                                </div>

                                <div class="col-md-2">
                                    <div class="section-line"></div>
                                </div>

                            </div>

                            <div class="book-section">

                                <div style=" align-items: flex-start; gap: 20px;padding: 5px;">
                                    <div class="row align-items-center">

                                        <div class="col-2 col-md-3">
                                            <a href="{{ route('client.booksDetails', $bookoriginal->booksID) }}">
                                                <img src="{{ asset('includesAdmin/img/books/defaultPart.jpeg') }}"
                                                    alt="Image" style="width:30px;height:auto;">
                                            </a>
                                        </div>

                                        <div class="col-10 col-md-9">
                                            <h2 style="font-size:14px;font-weight:bold;margin:0;">
                                                <a href="{{ route('client.booksDetails', $bookoriginal->booksID) }}"
                                                    style="color:#333;text-decoration:none;">
                                                    {{ $bookoriginal->Titre }}
                                                </a>
                                            </h2>
                                        </div>

                                    </div>





                                </div>


                            </div>
                            @foreach($groupedBooks as $group)
                            @foreach($group as $row)
                            <?php
                            if ($row->booksPartID == $book->booksPartID) { ?>
                                <div class="book-section-activate">

                                    <div style=" align-items: flex-start; gap: 20px;padding: 5px;">
                                        <div class="row align-items-center">

                                            <div class="col-2 col-md-3">
                                                <a href="{{ route('client.booksPartDetails', ['id' => $row->booksPartID]) }}">
                                                    <img src="{{ asset('includesAdmin/img/books/defaultPart.jpeg') }}"
                                                        alt="Image" style="width:30px;height:auto;">
                                                </a>
                                            </div>

                                            <div class="col-10 col-md-9">
                                                <h2 style="font-size:14px;font-weight:bold;margin:0;">
                                                    <a href="{{ route('client.booksPartDetails', ['id' => $row->booksPartID]) }}"
                                                        style="color:#333;text-decoration:none;">
                                                        {{ $row->booksPartTitre }}
                                                    </a>
                                                </h2>
                                            </div>

                                        </div>





                                    </div>


                                </div>
                            <?php } else { ?>

                                <div class="book-section">

                                    <div style=" align-items: flex-start; gap: 20px;padding: 5px;">
                                        <div class="row align-items-center">

                                            <div class="col-2 col-md-3">
                                                <a href="{{ route('client.booksPartDetails', ['id' => $row->booksPartID]) }}">
                                                    <img src="{{ asset('includesAdmin/img/books/defaultPart.jpeg') }}"
                                                        alt="Image" style="width:30px;height:auto;">
                                                </a>
                                            </div>

                                            <div class="col-10 col-md-9">
                                                <h2 style="font-size:14px;font-weight:bold;margin:0;">
                                                    <a href="{{ route('client.booksPartDetails', ['id' => $row->booksPartID]) }}"
                                                        style="color:#333;text-decoration:none;">
                                                        {{ $row->booksPartTitre }}
                                                    </a>
                                                </h2>
                                            </div>

                                        </div>





                                    </div>


                                </div>
                                <?php

                            } ?>

                            @endforeach
                            @endforeach






                        <?php } ?>

                    </div>


                </div>
                <div class="col-lg-9 order-lg-2 order-1">

                    <!-- category -->
                    <div class="article-category">
                        <i class="fa-solid fa-tag" style="    font-size: 10px;color: #d5ae69;"></i>
                        {{ $book->category->categoryName ?? '' }}

                    </div>

                    <div class="article-header">

                        <h1 class="article-title">
                            {{ $book->booksPartTitre }}
                        </h1>

                        <!-- meta -->
                        <div class="article-meta">
                            <img class="translator-img"
                                src="{{ asset('includesAdmin/img/translator/' . $book->translator->translatorPicture) }}"
                                alt="Image"
                                style="width: 32px;    height: 32px;    border-radius: 50%;    object-fit: cover;">

                            <span>
                                {{ $book->translator->translatorfirstName ?? '' }}
                                {{ $book->translator->translatorLastName ?? '' }}
                            </span>
                            <span>
                                <i class="far fa-user"></i>
                                {{ $book->bookspartMaisonEdition }}
                            </span>

                            <span>
                                <i class="far fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($book->PublierLe)->translatedFormat('d F Y') }}
                            </span>

                            <span>
                                <i class="far fa-eye"></i>
                                74
                            </span>

                            <!-- share -->
                            <span>
                                <i class="fas fa-share-alt"></i>
                                مشاركة
                            </span>

                        </div>

                    </div>

                    <!-- image -->
                    <div class="article-image">

                        <img src="{{ asset('includesAdmin/img/books/' . $book->booksPartImage) }}"
                            alt="{{ $book->booksPartTitre }}">

                    </div>

                    <!-- summary -->
                    <div class="article-summary">

                        <div class="article-summary-title">

                            <i class="far fa-file-alt"></i>

                            <strong>
                                ملخص الكتاب
                            </strong>

                        </div>

                        <div class="article-summary-text">

                            <p>
                                {{ $book->ResumeLivre }}
                            </p>

                        </div>

                    </div>

                    <!-- content -->
                    <div class="article-content" style="text-align: justify;">

                        {!! $book->bookpartarticle !!}

                    </div>

                    <div class="row">
                        <div class="col-lg-12 order-lg-1 order-2">


                            <div class="custom-box custom-boxCateg">


                                <div class="row align-items-center">

                                    <div class="col-md-2">
                                        <div class="section-line"></div>
                                    </div>

                                    <div class="col-md-8 text-center">

                                        <h3 class="section-title-custom"
                                            style="font-size: 16px;
                                                                                                                                                                                                                                                                                    margin-bottom: 10px;">
                                            كتب ذات صلة
                                        </h3>

                                    </div>

                                    <div class="col-md-2">
                                        <div class="section-line"></div>
                                    </div>

                                </div>

                                <div class="row">

                                    @foreach($booksType0categ as $row)

                                    <div class="col-lg-6 col-md-6 mb-3">

                                        <div class="ltn__small-product-item" style="flex-direction: column;">

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="">

                                                        <a href="{{ route(
                                                'client.booksDetails',
                                                ['id' => $row->booksID]
                                            ) }}">

                                                            <img src="{{ asset('includesAdmin/img/books/' . $row->Image) }}"
                                                                alt="Image" class="pictureCategdetail">

                                                        </a>

                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="small-product-item-info">

                                                        <h2 class="productTitleCateg">

                                                            <a href="{{ route(
                                                'client.booksDetails',
                                                ['id' => $row->booksID]
                                            ) }}">

                                                                {{ $row->Titre }}

                                                            </a>

                                                        </h2>
                                                        <h2 class="productTitleDesc">

                                                            <a href="{{ route(
                                                'client.booksDetails',
                                                ['id' => $row->booksID]
                                            ) }}">

                                                                {{ \Illuminate\Support\Str::limit(
                                                                $row->ResumeLivre,
                                                                180,
                                                                '...'
                                                                ) }}

                                                            </a>

                                                        </h2>

                                                        <div style="margin-top:5px;text-align:right;">

                                                            <i class="fa-solid fa-tag"
                                                                style="font-size:10px;color:#d5ae69;"></i>

                                                            <span style="font-size:11px;color:gray;">

                                                                {{ $row->categoryName }}

                                                            </span>

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

                </div>

            </div>


        </div>
    </div>



</div>







<!-- ===================== CSS ===================== -->

<style>
    @media (max-width: 768px) {
        .article-title {
            font-size: 30px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
    }

    .article-header {
        width: 100%;
        display: block;
        clear: both;
        margin-bottom: 30px;
    }



    .article-title {
        display: block;
        width: 100%;
        max-width: 1150px;

        font-size: 46px;
        line-height: 1.45;
        font-weight: 700;

        color: #30255f;

        text-align: center;

        margin: 0 auto 25px auto;

        white-space: normal;
        word-break: break-word;
        overflow-wrap: break-word;

        height: auto;
    }

    .article-meta {

        width: 100%;

        display: flex;

        justify-content: flex-start;

        gap: 25px;

        flex-wrap: wrap;

        direction: rtl;

        clear: both;
    }

    .book-details-area {
        direction: rtl;
        background: #fff;
    }

    .article-category {
        text-align: right;
        color: #b08d57;
        font-size: 15px;
        margin-bottom: 10px;
    }


    @media(max-width:768px) {

        .article-title {
            font-size: 30px;
            line-height: 1.8;
        }

    }

    @media (max-width: 768px) {
        .article-image {
            height: 260px;
            border-radius: 12px;
        }
    }

    .article-meta {
        display: flex;
        justify-content: right;
        gap: 30px;
        margin-bottom: 35px;
        color: #777;
        font-size: 14px;
        flex-wrap: wrap;
    }

    .article-image {
        width: 100%;
        height: 500px;
        overflow: hidden;
        border-radius: 18px;
        margin-bottom: 20px;
    }

    .article-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* don't stretch */
        object-position: center;
        /* crop equally from sides/top */
        display: block;
    }




    @media (max-width: 768px) {

        .article-summary {
            flex-direction: column;
            padding: 20px;
        }

        .article-summary-title {
            width: 100%;

            border-left: 0;
            border-bottom: 1px solid #ddd;

            padding: 0 0 15px 0;
            margin-bottom: 15px;
        }

        .article-summary-title i {
            font-size: 38px;
        }

        .article-summary-text {
            padding-right: 0;
        }

        .article-summary-text p {
            font-size: 14px;
        }
    }








    .article-summary {
        width: 100%;
        display: flex;
        direction: rtl;
        align-items: stretch;

        background: #fbfaff;

        border-radius: 18px;

        padding: 25px 30px;

        margin-top: 15px;
        margin-bottom: 40px;

        box-shadow: 0 5px 18px rgba(52, 38, 95, 0.08);
    }


    /* right section: icon + title */
    .article-summary-title {
        width: 190px;

        flex-shrink: 0;

        display: flex;
        flex-direction: column;

        justify-content: center;
        align-items: center;

        text-align: center;

        border-left: 1px solid #d7d3df;

        padding-left: 25px;

        color: #31255f;
    }


    .article-summary-title i {
        font-size: 48px;
        color: #744bb1;

        margin-bottom: 10px;
    }


    .article-summary-title strong {
        font-size: 18px;
        font-weight: 700;
        color: #30255f;
    }


    /* small purple line like screenshot */
    .article-summary-title::after {
        content: "";

        width: 38px;
        height: 3px;

        background: #744bb1;

        margin-top: 12px;
    }


    /* summary text */
    .article-summary-text {
        flex: 1;

        display: flex;
        align-items: center;

        padding-right: 30px;
    }


    .article-summary-text p {
        margin: 0;
        line-height: 1.5;
        font-size: 14px;

        color: #333;

        text-align: justify;
    }














    .article-content {
        font-size: 16px;
        line-height: 1.5;
        color: #444;
    }

    .article-content p {
        margin-bottom: 25px;
    }

    .article-content h1,
    .article-content h2,
    .article-content h3,
    .article-content h4 {
        color: #2d2350;
        margin-top: 35px;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .sidebar-widget {
        background: #fff;
        border: 1px solid #eee;
        padding: 25px;
        border-radius: 12px;
        position: sticky;
        top: 20px;
    }

    .widget-title {
        font-size: 24px;
        color: #2d2350;
        margin-bottom: 25px;
        font-weight: 700;
    }

    .related-post-item {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        align-items: center;
    }

    .related-post-item img {
        width: 90px;
        height: 90px;
        border-radius: 10px;
        object-fit: cover;
    }

    .related-post-content h6 {
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 8px;
    }

    .related-post-content h6 a {
        color: #222;
    }

    .related-post-content span {
        font-size: 13px;
        color: #888;
    }

    .related-articles-area {
        direction: rtl;
    }

    .related-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        transition: 0.3s;
        height: 100%;
    }

    .related-card:hover {
        transform: translateY(-5px);
    }

    .related-card img {
        width: 100%;
        height: 230px;
        object-fit: cover;
    }

    .related-card-body {
        padding: 20px;
    }

    .related-card-body h3 {
        font-size: 20px;
        line-height: 1.8;
    }

    .related-card-body h3 a {
        color: #2d2350;
    }

    .related-date {
        display: block;
        margin-bottom: 10px;
        color: #888;
        font-size: 14px;
    }

    @media(max-width:991px) {

        .article-title {
            font-size: 32px;
        }

        .sidebar-widget {
            margin-top: 40px;
        }

    }
</style>

@endsection