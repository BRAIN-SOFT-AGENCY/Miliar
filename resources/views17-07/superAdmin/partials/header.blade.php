<aside class="main-sidebar" style="background-color: #303748 !important;">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-right image">
        <img src="{{ asset('includesAdmin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> متصل</a>
      </div>
    </div>
    <!-- search form -->

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">

      <!-- 1. Accueil principal (sans sous-menu) -->
      <li class="{{ request()->routeIs('superAdmin.pages.index') ? 'active' : '' }}">
        <a href="{{ route('superAdmin.pages.index') }}">
          <i class="fa fa-dashboard"></i> <span>الواجهة الرئيسية</span>
        </a>
      </li>

      <!-- 2. Menu parent avec sous-menu (Banner) -->
      <!-- La classe "active" s'ajoute ici si on est sur la page "banner" -->
      <li class="treeview {{ request()->routeIs('superAdmin.pages.banner') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>الصفحة الرئيسية</span> <i class="fa fa-angle-left pull-left"></i>
        </a>
        <ul class="treeview-menu">
          <!-- L'élément enfant reçoit aussi "active" -->
          <li class="{{ request()->routeIs('superAdmin.pages.banner') ? 'active' : '' }}">
            <a href="{{ route('superAdmin.pages.banner') }}">
              <i class="fa fa-circle-o"></i> قائمة البانر
            </a>
          </li>
        </ul>
      </li>

      <!-- 3. Liste des articles -->
      <li class="{{ request()->routeIs('superAdmin.pages.article') ? 'active' : '' }}">
        <a href="{{ route('superAdmin.pages.article') }}">
          <i class="fa fa-newspaper-o"></i>

          <span>
            قائمة المقالات الغير منشورة
          </span>

          @if($articleCount > 0)
            <small class="label pull-left bg-red">
              {{ $articleCount }}
            </small>
          @endif

        </a>
      </li>
      <li class="{{ request()->routeIs('superAdmin.pages.etudes') ? 'active' : '' }}">
        <a href="{{ route('superAdmin.pages.etudes') }}">
          <i class="fa fa-newspaper-o"></i>

          <span>
            قائمة الدراسات الغير منشورة
          </span>

          @if($etudesCount > 0)
            <small class="label pull-left bg-red">
              {{ $etudesCount }}
            </small>
          @endif

        </a>
      </li>


      <li class="{{ request()->routeIs('superAdmin.pages.books') ? 'active' : '' }}">
        <a href="{{ route('superAdmin.pages.books') }}">
          <i class="fa fa-book"></i>

          <span>
            قائمة الكتب الغير منشورة
          </span>

          @if($booksCount > 0)
            <small class="label pull-left bg-red">
              {{ $booksCount }}
            </small>
          @endif

        </a>
      </li>
      <style>
        .sidebar-menu li a .label {
          margin-top: 3px;
          float: left !important;
        }
      </style>
      <!-- 6. Liste des catégories -->
      <li class="{{ request()->routeIs('superAdmin.pages.category') ? 'active' : '' }}">
        <a href="{{ route('superAdmin.pages.category') }}">
          <i class="fa fa-th"></i> <span>قائمة الأصناف</span>
        </a>
      </li>

      <!-- 7. Liste des traducteurs -->
      <li class="{{ request()->routeIs('superAdmin.pages.translatorList') ? 'active' : '' }}">
        <a href="{{ route('superAdmin.pages.translatorList') }}">
          <i class="fa fa-users"></i>
          <span>قائمة المترجمون</span>

          @if($translatorcountAdmin > 0)
            <small class="label pull-left bg-red">
              {{ $translatorcountAdmin }}
            </small>
          @endif
        </a>
      </li>

      <!-- 8. Liste des publications -->
      <li class="{{ request()->routeIs('superAdmin.pages.allBooks') ? 'active' : '' }}">
        <a href="{{ route('superAdmin.pages.allBooks') }}">
          <i class="fa fa-users"></i> <span>قائمة المنشورات</span>
        </a>
      </li>
      <!-- 9. Liste des publications -->

      <li class="{{ request()->routeIs('superAdmin.contactList') ? 'active' : '' }}">
        <a href="{{ route('superAdmin.contactList') }}">
          <i class="fa fa-envelope"></i> <span>قائمة الرسائل</span>
        </a>
      </li>
      <li class="{{ request()->routeIs('superAdmin.emailList') ? 'active' : '' }}">
        <a href="{{ route('superAdmin.emailList') }}">
          <i class="fa fa-paper-plane"></i> <span>قائمة البريد الالكتروني</span>
        </a>
      </li>
      <li class="{{ request()->routeIs('superAdmin.partnersList') ? 'active' : '' }}">
        <a href="{{ route('superAdmin.partnersList') }}">
          <i class="fa fa-star"></i> <span>قائمة الشركاء</span>
        </a>
      </li>
    </ul>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        // Récupère le chemin de l'URL actuelle (ex: /translator/pages/article)
        const currentPath = window.location.pathname;

        // Parcourt tous les liens du menu
        document.querySelectorAll('.sidebar-menu li a').forEach(link => {
          // Compare le chemin du lien avec le chemin actuel
          // Astuce : on utilise pathname pour ignorer les paramètres GET (?...)
          if (link.getAttribute('href') === currentPath) {
            link.closest('li').classList.add('active');
          }
        });
      });
    </script>
  </section>
  <!-- /.sidebar -->
</aside>