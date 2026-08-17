@extends('web.layouts.app')

@section('content')
    <div class="body-wrapper">
        <div class="ltn__slider-area ltn__slider-3---  section-bg-1--- mt-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 bannerpicturedroitePro1">
                        @if($bookBanner1->count())

                            @php $book = $bookBanner1->first(); @endphp

                            <div class="article-img overlay-style articlebookBanner1">
                                <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                    <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" alt="{{ $book->Titre }}"
                                        style="height:377px;">
                                </a>

                                <div class="overlay-content">
                                    <span class="category">
                                        {{ $book->categoryName }}
                                    </span>

                                    <h3 class="title">
                                        <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                            {{ $book->Titre }}
                                        </a>
                                    </h3>
                                </div>
                            </div>

                        @endif
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


        <div class="ltn__product-area ltn__product-gutter mt-30 mb-30">
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
                                        @foreach($books as $row)

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
                            @foreach($bookscol4 as $row)


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