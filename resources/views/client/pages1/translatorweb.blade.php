@extends('client.layouts.app')

@section('content')
    <div class="body-wrapper">


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
                                    style="    font-size: 20px;    color: #4d3572 !important;">
                                    قائمة المترجمين

                                </h6>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->

        <!-- TEAM AREA START (Team - 3) -->
        <div class="ltn__team-area pt-110--- pb-90" style="padding-bottom:0px">
            <div class="container">
                <div class="row justify-content-center">

                    @foreach($translators as $translator)
                        <div class="col-custom-5 text-center mb-4">

                            <div class="team-item-custom">

                                <!-- IMAGE RONDE -->
                                <div class="team-img-custom">
                                    <img src="{{ asset('includesAdmin/img/translator/' . $translator->translatorPicture) }}"
                                        alt="Image">
                                </div>

                                <!-- NAME -->
                                <h5 class="mt-3">
                                    <a href="{{ route('client.translatorDetails', ['id' => $translator->translatorID]) }}">
                                        {{ $translator->translatorfirstName }} {{ $translator->translatorLastName }}
                                    </a>
                                </h5>
                                <p style="    color: #3f2767;">عدد الترجمات: {{ $translator->books_count }}</p>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="ltn__pagination-area text-center" style="padding-bottom:40px">
            <div class="ltn__pagination">
                <ul>
                    {{-- Flèche précédente --}}
                    @if ($translators->onFirstPage())
                        <li class="disabled"><span><i class="fas fa-angle-double-right"></i></span></li>
                    @else
                        <li><a href="{{ $translators->previousPageUrl() }}"><i class="fas fa-angle-double-right"></i></a></li>
                    @endif

                    {{-- Numéros --}}
                    @foreach ($translators->getUrlRange(1, $translators->lastPage()) as $page => $url)
                        <li class="{{ $page == $translators->currentPage() ? 'active' : '' }}">
                            <a href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    {{-- Flèche suivante --}}
                    @if ($translators->hasMorePages())
                        <li><a href="{{ $translators->nextPageUrl() }}"><i class="fas fa-angle-double-left"></i></a></li>
                    @else
                        <li class="disabled"><span><i class="fas fa-angle-double-left"></i></span></li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- TEAM AREA END -->

@endsection