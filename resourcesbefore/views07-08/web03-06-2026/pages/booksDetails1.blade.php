@extends('web.layouts.app')

@section('content')
    <div class="body-wrapper">

        <!-- BREADCRUMB AREA START -->

        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image"
            style="height:auto; padding:12px 0;margin-bottom: 23px;      ">
            <div class="container" style="    border-right: 5px solid #442d66;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color"
                                    style="    font-size: 20px;    color: #4d3572 !important;"> {{ $book->Titre }}

                                </h6>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->

        <!--  0 : ma9al , 1 : livre -->
        <?php if ($book->type == 0) {
                                                                                                                                                        ?>
        <div class="ltn__team-details-area mb-10">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ltn__team-details-member-info text-center mb-40">
                            <div class="team-details-img">
                                <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" alt="Team Member Image">
                                <h4 style="    text-align: justify;        margin-top: 20px;        font-size: 15px;">
                                    {{ $book->Titre }}
                                </h4>

                            </div>
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



                            <div class="row" style="text-align: justify;background:#d9bb8d17;padding: 13px;">

                                <strong>ملخص المقال :</strong>
                                <p>{{ $book->ResumeLivre }}</p>
                               
                            </div>





                        </div>
                    </div>
                </div>
                <div class="row">
                    <strong>محتوى المقال :</strong>

                    <textarea id="editor" name="article" readonly> {{ $book->article }}</textarea>
                    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
                    <script>
                        ClassicEditor.create(document.querySelector('#editor'), {
                            language: 'ar',

                            toolbar: [], // cache la toolbar
                        }).then(editor => {

                            // mode lecture seule
                            editor.enableReadOnlyMode('editor');

                            // RTL arabe
                            editor.editing.view.change(writer => {
                                writer.setAttribute(
                                    'dir',
                                    'rtl',
                                    editor.editing.view.document.getRoot()
                                );
                            });

                        });
                    </script>

                    <style>
                        .ck-editor__editable {
                            min-height: 300px;
                            direction: rtl !important;
                            text-align: right !important;
                            border: none !important;
                        }
                    </style>
                </div>
            </div>
        </div>
        <div class="ltn__small-product-list-area pt-10 pb-85">
            <div class="container">
             
                <div class="section-title-area text-center" style="margin-bottom: 0px;    font-size: 16px;    text-align: center;    border-right: 5px solid #442d66;    padding: 10px;    background: #fcfcf8;   color: #442d66;">
                            <h1 class="section-title-2 border-bottom"
                                style="  margin-bottom: 0px;font-size:20px;text-align:center; padding:10px">
                              مقالات من نفس الصنف</h1>
                        </div>
                <div class="row justify-content-center">

                    <div class="col-lg-4 col-md-6">

                        <div class="row ltn__small-product-slider-active slick-arrow-1 slick-initialized slick-slider">
                            <!-- small-product-item -->
                            <div aria-live="polite" class="slick-list draggable">
                                <div role="listbox">
                                    <div
                                        class="col-lg-4 col-md-6 col-12 custom-width slick-slide slick-current slick-active">


                                        @foreach($relatedBooks1 as $row)


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

                                        @foreach($relatedBooks2 as $row)


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
                                        @foreach($relatedBooks3 as $row)


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
        <?php 
                                                                                                                                } else if ((int) $book->type == 1) { ?>

        <div class="ltn__team-details-area mb-10">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ltn__team-details-member-info text-center mb-40">
                            <div class="team-details-img">
                                <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" alt="Team Member Image">
                                <h4 style="    text-align: justify;        margin-top: 20px;        font-size: 15px;">
                                    {{ $book->Titre }}
                                </h4>

                            </div>
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




                            <div class="row" style="text-align: justify;background:#d9bb8d17;padding: 13px;">

                                <strong>ملخص الكتاب :</strong>
                                <p>{{  $book->ResumeLivre }}</p>
                            </div>



                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php        if (($groupedBooks != null) && count($groupedBooks) > 0) { ?>

        <div class="ltn__small-product-list-area pt-10 pb-85">
            <div class="container">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h1 class="section-title" style="    font-size: 30px;">
                        <img src="{{ asset('includesAdmin/img/part/icon.jpg') }}" alt="#" style="height: 50px;">

                        أجزاء الكتاب

                    </h1>
                </div>
                <div class="row justify-content-center">

                    @foreach($groupedBooks as $group)

                        <div class="col-lg-4 col-md-6">

                            <div class="row ltn__small-product-slider-active slick-arrow-1">

                                <div class="slick-list draggable">
                                    <div role="listbox">

                                        <div class="col-lg-4 col-md-6 col-12 custom-width">

                                            @foreach($group as $row)

                                                <div class="ltn__small-product-item">

                                                    <div class="small-product-item-img">
                                                        <img src="{{ asset('includesAdmin/img/books/' . $row->booksPartImage) }}"
                                                            alt="Image" style="min-width:100px; max-height:80px;">
                                                    </div>

                                                    <div class="small-product-item-info">

                                                        <h2 class="product-title">
                                                            {{ $row->booksPartTitre }}
                                                        </h2>

                                                        <div class="product-date d-flex align-items-center"
                                                            style="gap:5px; font-size:14px; color:#555;">

                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                                stroke="#555" stroke-width="2">
                                                                <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                                            </svg>

                                                            <span class="datepub">
                                                                {{ \Carbon\Carbon::parse($row->booksPartPublierLe)->translatedFormat('F d, Y') }}
                                                            </span>

                                                        </div>

                                                    </div>

                                                </div>

                                            @endforeach

                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>
            </div>
        </div>
        <?php        }
    } else if ($book->type == 2) {
                                                                                                                                                                        ?>

        <div class="ltn__team-details-area mb-10">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ltn__team-details-member-info text-center mb-40">
                            <div class="team-details-img">
                                <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" alt="Team Member Image">
                                <h4 style="    text-align: justify;        margin-top: 20px;        font-size: 15px;">
                                    {{ $book->Titre }}
                                </h4>

                            </div>
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



                            <div class="row" style="text-align: justify;backgroud:#d9bb8d17;padding: 13px;">

                                <strong>ملخص الدراسة :</strong>
                                <p>{{ $book->ResumeLivre }}</p>
                            </div>





                        </div>
                    </div>
                </div>
                <strong> الدراسة : </strong>

                <textarea id="editor" name="article" readonly> {{ $book->article }}</textarea>
                <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
                <script>
                    ClassicEditor.create(document.querySelector('#editor'), {
                        language: 'ar',

                        toolbar: [], // cache la toolbar
                    }).then(editor => {

                        // mode lecture seule
                        editor.enableReadOnlyMode('editor');

                        // RTL arabe
                        editor.editing.view.change(writer => {
                            writer.setAttribute(
                                'dir',
                                'rtl',
                                editor.editing.view.document.getRoot()
                            );
                        });

                    });
                </script>

                <style>
                    .ck-editor__editable {
                        min-height: 300px;
                        direction: rtl !important;
                        text-align: right !important;
                        border: none !important;
                    }
                </style>
            </div>
        </div>
        <?php        if (($groupedetudes != null) && count($groupedetudes) > 0) { ?>
        <div class="ltn__small-product-list-area pt-10 pb-85">
            <div class="container">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h1 class="section-title" style="    font-size: 30px;">
                        <img src="{{ asset('includesAdmin/img/part/icon.jpg') }}" alt="#" style="height: 50px;">

                        أجزاء الدراسة

                    </h1>
                </div>
                <div class="row justify-content-center">

                    @foreach($groupedetudes as $group)

                        <div class="col-lg-4 col-md-6">

                            <div class="row ltn__small-product-slider-active slick-arrow-1">

                                <div class="slick-list draggable">
                                    <div role="listbox">

                                        <div class="col-lg-4 col-md-6 col-12 custom-width">

                                            @foreach($group as $row)

                                                <div class="ltn__small-product-item">

                                                    <div class="small-product-item-img">
                                                        <img src="{{ asset('includesAdmin/img/books/' . $row->etudespartImage) }}"
                                                            alt="Image" style="min-width:100px; max-height:80px;">
                                                    </div>

                                                    <div class="small-product-item-info">

                                                        <h2 class="product-title">
                                                            {{ $row->etudespartTitre }}
                                                        </h2>

                                                        <div class="product-date d-flex align-items-center"
                                                            style="gap:5px; font-size:14px; color:#555;">

                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                                stroke="#555" stroke-width="2">
                                                                <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                                            </svg>

                                                            <span class="datepub">
                                                                {{ \Carbon\Carbon::parse($row->etudespartPublierLe)->translatedFormat('F d, Y') }}
                                                            </span>

                                                        </div>

                                                    </div>

                                                </div>

                                            @endforeach

                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>
            </div>
        </div>



        <?php
            }
    } ?>
        <!-- SHOP DETAILS AREA END -->

        <!-- PRODUCT SLIDER AREA START -->

        <!-- PRODUCT SLIDER AREA END -->





    </div>
    <!-- Body main wrapper end -->
@endsection