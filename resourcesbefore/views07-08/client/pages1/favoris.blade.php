@extends('client.layouts.app')

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
            <div class="container" style="    border-right: 5px solid #442d66;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color"
                                    style="    font-size: 20px;    color: #4d3572 !important;"> قائمة الكتب المفضلة
                                </h6>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->

        <!-- PRODUCT DETAILS AREA START -->
        <div class="ltn__product-area ltn__product-gutter">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 order-lg-2 mb-120">
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


                            </ul>
                        </div>
                        <div class="tab-content">
                            <!-- GRID VIEW -->
                            <div class="tab-pane fade show active" id="liton_product_grid">
                                <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                    <div class="row">
                                        @foreach($favorisList as $book)
                                                            <div class="col-xl-4 col-sm-6 col-6">
                                                                <div class="ltn__product-item ltn__product-item-3 text-center"
                                                                    style="height: 335px;">
                                                                    {{-- IMAGE --}}
                                                                    <div class="product-img" style="height: 180px; overflow: hidden;">
                                                                        <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}">
                                                                            <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}"
                                                                                alt="{{ $book->Titre }}"
                                                                                style="width: 100%; height: 170px; object-fit: cover;    padding: 5px;    border-top-right-radius: 10px;">

                                                                        </a>

                                                                        <div class="product-hover-action">
                                                                            <ul>
                                                                                <li>
                                                                                    <a href="{{ route('miliar.booksDetails', ['id' => $book->booksID]) }}"
                                                                                        title="Quick View" data-bs-target="#quick_view_modal">
                                                                                        <i class="far fa-eye"></i>
                                                                                    </a>
                                                                                </li>
                                            @php
                                                $isFavoris = false;

                                                if (session()->has('clientID')) {

                                                    $isFavoris = \App\Models\favoris::where('clientID', session('clientID'))
                                                        ->where('booksID', $book->booksID)
                                                        ->exists();
                                                }
                                             @endphp
                                                                                <li>
                                                                                    <a href="javascript:void(0);"
                                                                                        class="btn-favoris {{ $isFavoris ? 'favoris-active' : '' }}"
                                                                                        data-booksid="{{ $book->booksID }}" title="Wishlist">

                                                                                        <i class="far fa-heart"></i>
                                                                                    </a>

                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="product-info" style="height: 200px; overflow: hidden;">
                                                                        <h2 class="product-title" style="    height: 33px;">
                                                                            <a href="">
                                                                                {{ \Illuminate\Support\Str::limit($book->Titre, 30, '...') }}
                                                                            </a>
                                                                        </h2>

                                                                        <div class="product-brief" style="height:60px; overflow:hidden;">
                                                                            <p style="font-size:10px; margin:0;">
                                                                                {{ $book->article ? \Illuminate\Support\Str::limit($book->article, 80, '...') : '...' }}
                                                                            </p>
                                                                        </div>

                                                                        <div class="product-price">
                                                                            <i class="far fa-calendar-alt"></i>
                                                                            <span>{{ \Carbon\Carbon::parse($book->PublierLe)->format('d M Y') }}</span>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- LIST VIEW -->
                            <div class="tab-pane fade" id="liton_product_list">
                                <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                    <div class="row">
                                        @foreach($favorisList as $book)
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
                                                        <div class="product-brief" style="    height: 60px;">
                                                            <p style="font-size: 10px;">
                                                                {{ \Illuminate\Support\Str::limit($book->article, 180, '...') }}
                                                            </p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-9" style="height:0px;" padding:0;>
                                                                <div class="product-hover-action">
                                                                    <ul style="margin-top:-19px">
                                                                        <li>
                                                                            <a href="#" title="Quick View"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#quick_view_modal">
                                                                                <i class="far fa-eye"></i>
                                                                            </a>
                                                                        </li>

                                                                        @php
                                                                            $isFavoris = false;

                                                                            if (session()->has('clientID')) {

                                                                                $isFavoris = \App\Models\favoris::where('clientID', session('clientID'))
                                                                                    ->where('booksID', $book->booksID)
                                                                                    ->exists();
                                                                            }
                                                                         @endphp
                                                                        <li>
                                                                            <a href="javascript:void(0);"
                                                                                class="btn-favoris {{ $isFavoris ? 'favoris-active' : '' }}"
                                                                                data-booksid="{{ $book->booksID }}"
                                                                                title="Wishlist">

                                                                                <i class="far fa-heart"></i>
                                                                            </a>

                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="product-price"
                                                                    style="display:flex; align-items:center; gap:5px;">
                                                                    <i class="far fa-calendar-alt"></i>
                                                                    <span>{{ \Carbon\Carbon::parse($book->PublierLe)->format('d M Y') }}</span>
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
                                    @if ($favorisList->onFirstPage())
                                        <li class="disabled"><span><i class="fas fa-angle-double-right"></i></span></li>
                                    @else
                                        <li><a href="{{ $favorisList->previousPageUrl() }}"><i
                                                    class="fas fa-angle-double-right"></i></a>
                                        </li>
                                    @endif

                                    {{-- Pagination dynamique 10 pages à la fois --}}
                                    @php
                                        $current = $favorisList->currentPage();
                                        $last = $favorisList->lastPage();
                                        $start = max($current - 5, 1); // première page visible
                                        $end = min($start + 9, $last); // dernière page visible
                                    @endphp

                                    @for ($i = $start; $i <= $end; $i++)
                                        <li class="{{ $i == $current ? 'active' : '' }}">
                                            <a href="{{ $favorisList->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    {{-- Flèche suivante --}}
                                    @if ($favorisList->hasMorePages())
                                        <li><a href="{{ $favorisList->nextPageUrl() }}"><i
                                                    class="fas fa-angle-double-left"></i></a>
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
        </div>
        <!-- PRODUCT DETAILS AREA END -->



    </div>
    <!-- Body main wrapper end -->
@endsection