<header class="ltn__header-area ltn__header-3 section-bg-6">
  <!-- ltn__header-top-area start -->
  <div class="ltn__header-top-area">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <div class="ltn__top-bar-menu">
            <ul>
              <li><a href="mailto:info@webmail.com?Subject=Flower%20greetings%20to%20you"><i class="icon-mail"></i>
                  info@client.org</a></li>
              <li><a href=""><i class="icon-placeholder"></i> المملكة العربية
                  السعودية، الرياض</a></li>
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
        <div class="col">
          <div class="site-logo">
            <a href="{{ route('client.index') }}"><img src="{{ asset('includes/img/logo.png') }}" alt="Logo"></a>
          </div>
        </div>
        <div class="col header-contact-serarch-column d-none d-lg-block">
          <div class="header-contact-search">
            <!-- header-feature-item -->

            <!-- header-search-2 -->
            <div class="header-search-2">
              <form method="GET" action="{{ route('client.books') }}">

                <!-- نحافظو على الفلاتر الحالية (اختياري لكن مهم) -->
                <input type="hidden" name="sort" value="{{ request('sort') }}">
                <input type="hidden" name="search_date" value="{{ request('search_date') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <input type="hidden" name="translator" value="{{ request('translator') }}">

                <!-- input search -->
                <input type="text" name="search" value="{{ request('search') }}" placeholder="ابحث هنا..." />

                <!-- button -->
                <button type="submit">
                  <span><i class="icon-search"></i></span>
                </button>

              </form>
            </div>
          </div>
        </div>
        <div class="col">
          <!-- header-options -->
          <div class="ltn__header-options">
            <ul>
              <li class="d-none">
                <!-- ltn__currency-menu -->
                <div class="ltn__drop-menu ltn__currency-menu">
                  <ul>
                    <li><a href="#" class="dropdown-toggle"><span class="active-currency">USD</span></a>
                      <ul>
                        <li><a href="">USD - US Dollar</a></li>
                        <li><a href="">CAD - Canada Dollar</a></li>
                        <li><a href="">EUR - Euro</a></li>
                        <li><a href="">GBP - British Pound</a></li>
                        <li><a href="">INR - Indian Rupee</a></li>
                        <li><a href="">BDT - Bangladesh Taka</a></li>
                        <li><a href="">JPY - Japan Yen</a></li>
                        <li><a href="">AUD - Australian Dollar</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
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
                    <li>
                      <a href="#"><i class="icon-user"></i></a>
                      <ul>
                        <li><a href="{{ route('client.pages.favoris') }}"> الإعلانات المفضلة</a></li>

                        <li><a href="{{ route('logoutClient') }}">تسجيل الخروج</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </li>
              <li>
                <div class="header-feature-item">
                  <div class="header-feature-icon">
                    <i class="icon-call"></i>
                  </div>
                  <div class="header-feature-info">
                    <h6>الهاتف</h6>
                    <p><a href="tel:0123456789">966123462555 +</a></p>
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
  <!-- header-bottom-area start -->
  <div
    class="header-bottom-area ltn__border-top ltn__header-sticky  ltn__sticky-bg-white ltn__primary-bg--- section-bg-1 menu-color-white--- d-none d-lg-block">
    <div class="container">
      <div class="row">
        <div class="col header-menu-column justify-content-center">
          <div class="sticky-logo">
            <div class="site-logo">
              <a href="{{ route('client.index') }}"><img src="{{ asset('includes/img/logo.png') }}" alt="Logo"></a>
            </div>
          </div>
          <div class="header-menu header-menu-2">
            <nav>
              <div class="ltn__main-menu">
                <ul>
                  <li><a href="{{ route('client.index') }}">الصفحة الرئيسية</a></li>
                  <li><a href="{{ route('client.books') }}">البحث المتقدم</a></li>
                  <li><a href="{{ route('client.translatorweb') }}"> المترجمون</a></li>
                  <li><a href="{{ route('client.elementor') }}"> دليل الجهات و المترجمون</a></li>
                  <li class=" menu-icon"> <a href="#">مجالات الترجمات</a>
                    <ul class="sub-menu">

                      <!-- categories من database -->
                      @foreach($categories as $category)
                        <li>
                          <a href="{{ route('client.books', ['category' => $category->categoryID]) }}">
                            {{ $category->categoryName }}
                          </a>
                      </li> @endforeach
                    </ul>
                  </li>


                  <li><a href="{{ route('client.contact') }}">اتصل بنا</a></li>


                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- header-bottom-area end -->
</header>