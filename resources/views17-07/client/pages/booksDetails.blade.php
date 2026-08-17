@extends('client.layouts.app')

@section('content')

    <div class="body-wrapper">

        <!-- ===================== PAGE DETAILS ===================== -->

        <div class="book-details-area pt-50 pb-70">
            <div class="container">
                <?php if ($book->type == 0) { ?>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-9">

                        <!-- category -->
                        <div class="article-category">
                            <i class="fa-solid fa-tag" style="    font-size: 10px;color: #d5ae69;"></i>
                            {{ $book->category->categoryName ?? '' }}

                        </div>

                        <div class="article-header">

                            <h1 class="article-title">
                                {{ $book->Titre }}
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
                                    {{ $book->MaisonEdition }}
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

                            <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" alt="{{ $book->Titre }}">

                        </div>

                        <!-- summary -->
                        <div class="row" style="text-align: justify;background:#d9bb8d17;padding: 13px;">

                            <h5>
                                <strong>ملخص المقال :</strong>

                            </h5>

                            <p
                                style="text-align: justify;            line-height: 1.5;
                                                                                                                                                                                                                                                                                                                                                                                            ">

                                {{ $book->ResumeLivre }}

                            </p>

                        </div>

                        <!-- content -->
                        <div class="article-content" style="text-align: justify;">

                            {!! $book->article !!}

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
                                                مقالات ذات صلة
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
                    <div class="col-md-1"></div>

                </div>
                <?php

    } else {
                                                                                                                                                                                                                ?>

                <div class="row">


                    <div class="col-lg-3 order-lg-1 order-2">

                        <div class="custom-box custom-boxCateg">

                            {{-- ================= BOOK PARTS ================= --}}
                            <?php    if (($book->type == 1) && ($groupedBooks != null) && count($groupedBooks) > 0) { ?>

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
                            <!-------------------afficher books selectionner ---------------->
                            <div class="book-section-activate">

                                <div style=" align-items: flex-start; gap: 20px;padding: 5px;">
                                    <div class="row align-items-center">

                                        <div class="col-2 col-md-3">
                                            <a href="{{ route('client.booksDetails', $book->booksID) }}">
                                                <img src="{{ asset('includesAdmin/img/books/defaultPart.jpeg') }}"
                                                    alt="Image" style="width:30px;height:auto;">
                                            </a>
                                        </div>

                                        <div class="col-10 col-md-9">
                                            <h2 style="font-size:14px;font-weight:bold;margin:0;">
                                                <a href="{{ route('client.booksDetails', $book->booksID) }}"
                                                    style="color:#333;text-decoration:none;">
                                                    {{ $book->Titre }}
                                                </a>
                                            </h2>
                                        </div>

                                    </div>





                                </div>


                            </div>
                            @foreach($groupedBooks as $group)
                                @foreach($group as $row)

                                    <!-- Conteneur principal avec une bordure grise sous toute la section (premier soulignement) -->
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

                                @endforeach
                            @endforeach


                            {{-- ================= ETUDES PARTS ================= --}}
                            <?php    } else if (($book->type == 2) && ($groupedetudes != null) && count($groupedetudes) > 0) { ?>

                            <div class="row align-items-center">

                                <div class="col-md-2">
                                    <div class="section-line"></div>
                                </div>

                                <div class="col-md-8 text-center">
                                    <h3 class="section-title-custom" style="font-size: 16px; margin-bottom: 10px;">
                                        أجزاء الدراسة
                                    </h3>
                                </div>

                                <div class="col-md-2">
                                    <div class="section-line"></div>
                                </div>

                            </div>
                            <div class="book-section-activate">

                                <div style=" align-items: flex-start; gap: 20px;padding: 5px;">
                                    <div class="row align-items-center">

                                        <div class="col-2 col-md-3">
                                            <a href="{{ route('client.booksDetails', $book->booksID) }}">
                                                <img src="{{ asset('includesAdmin/img/books/defaultPart.jpeg') }}"
                                                    alt="Image" style="width:30px;height:auto;">
                                            </a>
                                        </div>

                                        <div class="col-10 col-md-9">
                                            <h2 style="font-size:14px;font-weight:bold;margin:0;">
                                                <a href="{{ route('client.booksDetails', $book->booksID) }}"
                                                    style="color:#333;text-decoration:none;">
                                                    {{ $book->Titre }}
                                                </a>
                                            </h2>
                                        </div>

                                    </div>





                                </div>


                            </div>
                            @foreach($groupedetudes as $group)
                                @foreach($group as $row)

                                    <div class="book-section">

                                        <div style=" align-items: flex-start; gap: 20px;padding: 5px;">
                                            <div class="row align-items-center">

                                                <div class="col-2 col-md-3">
                                                    <a href="{{ route('client.etudesPartDetails', ['id' => $row->etudespartID]) }}">
                                                        <img src="{{ asset('includesAdmin/img/books/defaultPart.jpeg') }}"
                                                            alt="Image" style="width:30px;height:auto;">
                                                    </a>
                                                </div>

                                                <div class="col-10 col-md-9">
                                                    <h2 style="font-size:14px;font-weight:bold;margin:0;">
                                                        <a href="{{ route('client.etudesPartDetails', ['id' => $row->etudespartID]) }}"
                                                            style="color:#333;text-decoration:none;">
                                                            {{ $row->etudespartTitre }}
                                                        </a>
                                                    </h2>
                                                </div>

                                            </div>





                                        </div>


                                    </div>

                                @endforeach
                            @endforeach


                            {{-- ================= EMPTY STATE ================= --}}
                            <?php        } else { ?>

                            <div style="padding:15px; text-align:center; color:#999;">

                            </div>

                            <?php        } ?>

                        </div>

                    </div>
                    <!-- ================= ARTICLE ================= -->
                    <div class="col-lg-9 order-lg-2 order-1">

                        <!-- category -->
                        <div class="article-category">
                            <i class="fa-solid fa-tag" style="    font-size: 10px;color: #d5ae69;"></i>
                            {{ $book->category->categoryName ?? '' }}

                        </div>

                        <div class="article-header">

                            <h1 class="article-title">
                                {{ $book->Titre }}
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
                                    {{ $book->MaisonEdition }}
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

                            <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" alt="{{ $book->Titre }}">

                        </div>

                        <!-- summary -->
                        <div class="row" style="text-align: justify;background:#d9bb8d17;padding: 13px;">

                            <h5>


                                <?php
        if ($book->type == 1) { ?>


                                <strong>ملخص الكتاب :</strong>


                                <?php
        } else if ($book->type == 2) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>

                                <strong>ملخص الدراسة :</strong>

                                <?php
            } ?>

                            </h5>

                            <p
                                style="text-align: justify;            line-height: 1.5;
                                                                                                                                                                                                                                                                                                                                                                                                        ">

                                {{ $book->ResumeLivre }}

                            </p>

                        </div>

                        <!-- content -->
                        <div class="article-content" style="text-align: justify;">

                            {!! $book->article !!}

                        </div>
                        <?php    if ($book->type == 0) {
                                                                                                                                                                                                                                                                                                                    ?>
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
                                                مقالات ذات صلة
                                            </h3>

                                        </div>

                                        <div class="col-md-2">
                                            <div class="section-line"></div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        @foreach($booksType0categ as $row)

                                            <div class="col-lg-6 col-md-6 mb-4">

                                                <div class="ltn__product-item ltn__product-item-3 h-100">

                                                    <!-- Image -->
                                                    <div class="product-img">
                                                        <a href="{{ route('client.booksDetails', ['id' => $row->booksID]) }}">
                                                            <img src="{{ asset('includesAdmin/img/books/' . $row->Image) }}"
                                                                alt="{{ $row->Titre }}" class="picturenews">
                                                        </a>
                                                    </div>

                                                    <!-- Infos -->
                                                    <div class="product-info p-3">

                                                        <!-- Titre -->
                                                        <h2 class="product-title titleInfo">
                                                            <a
                                                                href="{{ route('client.booksDetails', ['id' => $row->booksID]) }}">
                                                                {{ \Illuminate\Support\Str::limit($row->Titre, 100, '...') }}
                                                            </a>
                                                        </h2>

                                                        <!-- Catégorie -->
                                                        <div class="mb-2">
                                                            <i class="fa-solid fa-tag" style="color:#d5ae69"></i>
                                                            <span style="font-size:11px;color:#d5ae69;">
                                                                {{ $row->categoryName }}
                                                            </span>
                                                        </div>

                                                        <!-- Résumé -->
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

                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php    } else if ($book->type == 1) {
                                                                                                                                                                                                                                                            ?>
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

                                        @foreach($booksType1categ as $row)

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
                        <?php
            } else if ($book->type == 2) { ?>
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
                                                دراسات ذات صلة
                                            </h3>

                                        </div>

                                        <div class="col-md-2">
                                            <div class="section-line"></div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        @foreach($booksType2categ as $row)

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
                        <?php
            } ?>
                    </div>

                </div>

                <?php
    }?>













            </div>
        </div>



    </div>







    <!-- ===================== CSS ===================== -->

    <style>
        .article-header {
            width: 100%;
            display: block;
            clear: both;
            margin-bottom: 30px;
        }



        .article-title {
            display: block;

            width: 100%;

            font-size: 30px;

            line-height: 1.3;

            font-weight: 700;

            color: #2d2350;

            text-align: right;

            margin: 0 0 25px 0;

            white-space: normal;

            word-break: break-word;

            overflow-wrap: break-word;

            clear: both;
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
            margin-bottom: 40px;
        }

        .article-image img {
            width: 100%;
            border-radius: 12px;
            max-height: 500px;
            object-fit: contain;
        }

        .article-summary {
            background: #faf7f2;
            padding: 30px;
            border-radius: 12px;
            border-right: 4px solid #b08d57;
            margin-bottom: 40px;
        }

        .article-summary h4 {
            color: #2d2350;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .article-summary p {
            margin: 0;
            line-height: 2;
            color: #555;
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