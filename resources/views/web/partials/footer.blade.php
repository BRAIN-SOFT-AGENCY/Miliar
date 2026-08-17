<footer class="ltn__footer-area  ">
    <div class="footer-top-area  section-bg-1 plr--5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-about-widget">
                        <div class="footer-logo mt-40">
                            <div class="site-logo">
                            </div>
                        </div>

                        <div class="footer-address">
                            <ul>

                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-mail"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p><a href="mailto:info@miliar.org">info@miliar.org</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="ltn__social-media mt-20">
                            <ul>
                                <li><a href="https://www.facebook.com/share/1Eo6tCTXr6/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://x.com/miliarorg?lang=ar" title="Twitter" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com/showcase/miliarorg/" title="Linkedin" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="https://www.instagram.com/miliarorg?igsh=cTIwNjZrMng2cTg=" title="Youtube" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <br>
                        <h4 class="footer-title">مجالات الترجمات</h4>
                        <div class="footer-menu">

                            <ul>
                                <!-- categories من database -->
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('miliar.categoryID', ['category' => $category->categoryID])  }}">
                                            {{ $category->categoryName }}
                                        </a>
                                </li> @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <br>
                        <h4 class="footer-title">مواقع ذات صلة</h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="">مركز عبد الله بن إدريس</a></li>
                                <li><a href="">نشرة وجهة</a></li>
                                <li><a href=""> جائزة عبدالله بن إدريس الثقافية</a></li>
                                <li><a href="">كرسي اليونسكو </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <br>
                        <h4 class="footer-title">رعاية العملاء </h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="{{ route('miliar.inscription') }}">تسجيل الدخول</a></li>
                                <li><a href="{{ route('miliar.inscription') }}">حسابي</a></li>
                                <li><a href="{{ route('miliar.inscription') }}">قائمة الرغبات</a></li>
                                <li><a href="{{ route('miliar.inscription') }}">تتبع الطلب</a></li>
                                <li><a href="">الأسئلة الشائعة</a></li>
                                <li><a href="{{ route('miliar.about') }}"> من نحن</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                    <div class="footer-widget footer-newsletter-widget fix">
                        <br>
                        <h4 class="footer-title">النشرة الإخبارية
                        </h4>
                        <p style="    font-size: 14px;">اشترك في نشرتنا الإخبارية الأسبوعية واحصل على آخر التحديثات عبر
                            البريد الإلكتروني.
                        </p>
                        <div class="footer-newsletter">
                            <div id="mc_embed_signup">
                                <form action="{{ route('email.store') }}" method="POST">
                                    @csrf

                                    <div id="mc_embed_signup_scroll">
                                        <div class="mc-field-group">
                                            <input type="email" name="email" class="required email"
                                                placeholder="بريد إلكتروني*" value="{{ old('email') }}">
                                        </div>

                                        {{-- Message de succès --}}
                                        @if(session('success'))
                                            <div class="alert alert-success mt-2">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        {{-- Message d'erreur --}}
                                        @if(session('error'))
                                            <div class="alert alert-danger mt-2">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        {{-- Erreur de validation --}}
                                        @error('email')
                                            <div class="text-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div class="clear">
                                            <div class="btn-wrapper">
                                                <button class="submitsearch" type="submit" name="subscribe">
                                                    <i class="fas fa-location-arrow"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <script>
                                    setTimeout(function () {
                                        let alerts = document.querySelectorAll('.alert');
                                        alerts.forEach(function (alert) {
                                            alert.style.display = 'none';
                                        });
                                    }, 3000);
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>