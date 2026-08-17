<div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
    <div class="ltn__utilize-menu-inner ltn__scrollbar">

        <!-- رأس الموبايل -->
        <div class="ltn__utilize-menu-head">
            <div class="site-logo">
                <a href="{{ route('miliar.index') }}">
                    <img src="{{ asset('includes/img/logo.png') }}" alt="Logo">
                </a>
            </div>
            <button class="ltn__utilize-close">×</button>
        </div>


        <!-- القائمة -->
        <div class="ltn__utilize-menu">
            <ul>
                <li><a href="{{ route('miliar.index') }}">الصفحة الرئيسية</a></li>
                <!-- مجالات الترجمات -->
                <li><a href="#">مجالات الترجمات</a>
                    <ul class="sub-menu">

                        <!-- categories من database -->


                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('miliar.categoryID', ['category' => $category->categoryID])  }}">
                                    {{ $category->categoryName }}
                                </a>
                        </li> @endforeach

                    </ul>
                </li>
                <li><a href="{{ route('miliar.books') }}"> الأرشيف</a></li>
                <li><a href="{{ route('miliar.translatorweb') }}">المترجمون</a></li>
                <li><a href="{{ route('miliar.elementor') }}">دليل الجهات و المترجمون</a></li>



                <li><a href="{{ route('miliar.contact') }}">اتصل بنا</a></li>
            </ul>
        </div>

        <!-- وسائل التواصل -->
        <div class="ltn__social-media-2">
            <ul>
                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>

    </div>
</div>
<div class="mobile-header-menu-fullwidth">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Mobile Menu Button -->
                <div class="mobile-menu-toggle d-lg-none">
                    <span>القائمة الرئيسية</span>
                    <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                        <svg viewBox="0 0 800 600">
                            <path
                                d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                                id="top"></path>
                            <path d="M300,320 L540,320" id="middle"></path>
                            <path
                                d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                                id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>