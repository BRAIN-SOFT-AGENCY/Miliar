@extends('web.layouts.app')

@section('content')
    <main>
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image"
            style="height:auto; padding:12px 0;margin-bottom: 23px;      ">
            <div class="container" style="    border-right: 5px solid #442d66;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color"
                                    style="    font-size: 20px;    color: #4d3572 !important;">
                                    النشرات الشهرية
                                </h6>
                            </div>

                        </div>
                    </div>

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
        <section>
            <div class="container">
                @if($newsMonthly->isEmpty())
                    <div class="text-center" style="padding:40px 20px; border:1px solid #eee;">
                        <i class="fa fa-file-pdf-o" style="font-size:40px; color:#442d66;"></i>
                        <h3>لا توجد نشرات شهرية لهذا العام</h3>
                    </div>
                @else


                    <div class="ltn__cards-section">
                        <div class="container">

                            <div class="ltn__cards-grid">
                                @foreach($newsMonthly as $row)
                                    <div class="ltn__book-card">
                                        <div class="ltn__book-card-img">

                                            <img src="{{ asset('includesAdmin/img/monthly/' . $row->picture) }}"
                                                alt="{{ $row->title }}">

                                        </div>
                                        <div class="ltn__book-card-body">
                                            <h3 class="ltn__book-card-title">
                                                {{ $row->title }}
                                            </h3>

                                            <div class="ltn__book-card-footer">
                                                <a href="{{ asset('includesAdmin/pdf/monthly/' . $row->pdf) }}" target="_blank"
                                                    class="read-btn">
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
                                                    {{ \Carbon\Carbon::parse($row->year)->translatedFormat('F d, Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>


                @endif
            </div>
        </section>
    </main>
@endsection