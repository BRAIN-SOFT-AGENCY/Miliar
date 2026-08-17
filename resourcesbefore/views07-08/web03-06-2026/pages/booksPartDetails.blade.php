@extends('web.layouts.app')

@section('content')

    <div class="body-wrapper">

        <!-- ===================== PAGE DETAILS ===================== -->

        <div class="book-details-area pt-50 pb-70">
            <div class="container">

                <div class="row">

                    <!-- ================= SIDEBAR ================= -->

                    <div class="col-lg-3 order-lg-1 order-2">


                        <div class="custom-box custom-boxCateg">
                            <div class="section-title-area text-center"
                                style="margin-bottom: 0px;    font-size: 16px;    text-align: center;    border-right: 5px solid #442d66;    padding: 10px;    background: #fcfcf8;   color: #442d66;">
                                <h1 class="section-title-2 border-bottom"
                                    style="  margin-bottom: 0px;font-size:16px;text-align:center;">

                                    كتب ذات صلة
                                </h1>
                            </div>

                            @foreach($relatedBooks as $row)
                                <div class="ltn__small-product-item">
                                    <div class="small-product-item-img">
                                        <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                            <img src="{{ asset('includesAdmin/img/books/' . $row->Image) }}" alt="Image"
                                                class="pictureCateg"></a>
                                    </div>
                                    <div class="small-product-item-info">

                                        <h2 class="productTitleCateg">
                                            <a href="{{ route('miliar.booksDetails', ['id' => $row->booksID]) }}">
                                                {{ $row->Titre }}

                                            </a>
                                        </h2>

                                    </div>
                                </div>
                            @endforeach

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
                                {{ $book->booksPartTitre }}
                            </h1>

                            <!-- meta -->
                            <div class="article-meta">

                                <span>
                                    <i class="far fa-user"></i>
                                    {{ $book->bookspartMaisonEdition }}
                                </span>

                                <span>
                                    <i class="far fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($book->bookspartPublierLe)->translatedFormat('d F Y') }}
                                </span>

                                <span>
                                    <i class="far fa-eye"></i>
                                    74
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

                            <h4>
                                ملخص الكتاب

                            </h4>

                            <p>

                                {{ $book->bookspartResumeLivre }}

                            </p>

                        </div>

                        <!-- content -->
                        <div class="article-content">
                            @if(!empty($book->bookspartpdf_file) && $book->bookspartpdf_file !== 'test.pdf')
                                <a href="{{ asset('includesAdmin/pdf/books/' . $book->bookspartpdf_file) }}" target="_blank"
                                    rel="noopener noreferrer" class="pdf-view-link">
                                    <i class="fa fa-file-pdf"></i>
                                    فتح الملف PDF
                                </a>
                            @else
                                <p class="text-muted">لا يوجد ملف PDF.</p>
                            @endif
                        </div>

                    </div>

                </div>

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
            object-fit: cover;
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
            font-size: 18px;
            line-height: 1.8;
            color: #444;
        }

        .article-content p {
            margin-bottom: 25px;
        }

        .pdf-view-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #d14836;
            font-weight: 700;
            text-decoration: none;
        }

        .pdf-view-link:hover {
            text-decoration: underline;
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