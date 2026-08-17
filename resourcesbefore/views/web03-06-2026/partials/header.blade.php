<header class="ltn__header-area ltn__header-3 section-bg-6">
  <!-- ltn__header-top-area start -->
  <div class="ltn__header-top-area">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <div class="ltn__top-bar-menu">
            <ul>
              <li><a href="#"><i class="fa fa-home"></i>
                  من نحن</a></li>

              <li><a href="{{ route('miliar.contact') }}"><i class="icon-mail"></i>
                  التواصل معنا</a></li>


            </ul>
          </div>
        </div>
        <div class="col-md-5">
          <div class="top-bar-right text-right text-end">
            <div class="ltn__top-bar-menu">
              <ul>
                <li>
                  <!-- ltn__language-menu -->
                  <div class="ltn__drop-menu ltn__currency-menu ltn__language-menu">

                  </div>
                </li>
                <li>
                  <!-- ltn__social-media -->
                  <div class="ltn__social-media">
                    <ul>
                      <li>
                        <?php
// تحديد الإعدادات المحلية للغة العربية والمنطقة الزمنية
$locale = 'ar_SA';
$timezone = 'Asia/Riyadh';

// إنشاء منسق التاريخ بالتنسيق المخصص
$formatter = new IntlDateFormatter(
  $locale,
  IntlDateFormatter::FULL, // لا يهم كثيراً لأننا سنحدد تنسيقاً مخصصاً
  IntlDateFormatter::NONE,
  $timezone,
  IntlDateFormatter::GREGORIAN,
  "EEEE, MMMM d, yyyy" // التنسيق المطلوب: اسم اليوم, اسم الشهر اليوم, السنة
);

// طباعة التاريخ الحالي
echo $formatter->format(new DateTime());
?>
                      </li>
                      <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                      </li>

                      <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                      <li><a href="#" title="Dribbble"><i class="fab fa-dribbble"></i></a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ltn__header-top-area end -->
  <!-- ltn__header-middle-area start -->
  <div class="ltn__header-middle-area">
    <div class="container">
      <div class="row">
        <div class="col-md-1">
          <div class="site-logo">
            <a href="{{ route('miliar.index') }}"><img src="{{ asset('includes/img/logo.png') }}" alt="Logo"></a>
          </div>
        </div>
        <div class="col-md-9 header-contact-serarch-column d-none d-lg-block">
          <div class="header-contact-search">
            <!-- header-feature-item -->

            <!-- header-search-2 -->
            <div class="header-search-2">


              <div class="header-menu header-menu-2">
                <nav>
                  <div class="ltn__main-menu">
                    <ul>
                      <li><a href="{{ route('miliar.index') }}">الصفحة الرئيسية</a></li>
                      <li class=" menu-icon"> <a href="#">مجالات الترجمات</a>
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
                      <li><a href="{{ route('miliar.translatorweb') }}"> المترجمون</a></li>
                      <li><a href="{{ route('miliar.elementor') }}"> دليل الجهات و المترجمون</a></li>

                    </ul>
                  </div>
                </nav>
              </div>


            </div>
          </div>
        </div>
        <div class="col-md-2" style="    padding: 0px;">
          <!-- header-options -->
          <div class="ltn__header-options">
            <ul>
              <li class="d-none">
                <!-- ltn__currency-menu -->

              </li>
              <li class="d-lg-none">
                <!-- header-search-1 -->
                <div class="header-search-wrap">
                  <div class="header-search-1">
                    <div class="search-icon">
                      <i class="icon-search  for-search-show"></i>
                      <i class="icon-cancel  for-search-close"></i>
                    </div>
                  </div>
                  <div class="header-search-1-form">
                    <form id="#" method="get" action="#">
                      <input type="text" name="search" value="" placeholder="Search here..." />
                      <button type="submit">
                        <span><i class="icon-search" style="color:#3b2166"></i></span>
                      </button>
                    </form>
                  </div>
                </div>
              </li>
              <li class="d-none---">
                <div class="ltn__drop-menu user-menu">
                  <ul>
                    <li style="margin-left:3px">
                      <a href="#"><i class="icon-user"></i></a>
                      <ul>
                        <li><a href="{{ route('miliar.inscription') }}">تسجيل الدخول</a></li>
                        <li><a href="{{ route('miliar.register') }}">تسجيل جديد</a></li>
                      </ul>
                    </li>
                    <li style="margin-left:3px">
                      <a href="{{ route('miliar.books') }}"><i class="icon-search"></i></a>
                    </li>
                    <li class="header-icon-item" style="margin-left:3px">

                      <a href="#" title="النشرية الأسبوعية">

                        <i class="fa-solid fa-newspaper"></i>
                      </a>

                    </li>

                    <li class="header-icon-item">

                      <a href="#" title="النشرة الشهرية">

                        <i class="fa-solid fa-calendar-days"></i>
                      </a>

                    </li>





                  </ul>
                </div>
              </li>
              <li>
                <div class="header-feature-item">
                  <div class="header-feature-icon">
                  </div>
                  <div class="header-feature-info">

                  </div>
                </div>
              </li>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- ltn__header-middle-area end -->

  <!-- header-bottom-area end -->
</header>