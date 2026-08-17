<aside class="main-sidebar" style="background-color: #303748 !important;">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-right image">
        <img src="{{ asset('includesAdmin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p> {{ Auth::guard('translator')->user()->translatorfirstName }}
          {{ Auth::guard('translator')->user()->translatorLastName }}
        </p>
        <a href="#"><i class="fa fa-circle text-success"></i> متصل</a>
      </div>
    </div>
    <!-- search form -->

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <!-- Page d'accueil -->
      <li class="treeview {{ request()->routeIs('translator.pages.index') ? 'active' : '' }}">
        <a href="{{ route('translator.pages.index') }}">
          <i class="fa fa-dashboard"></i> <span>الواجهة الرئيسية</span>
        </a>
      </li>

      <!-- Articles -->
      <li class="{{ request()->routeIs('translator.pages.article') ? 'active' : '' }}">
        <a href="{{ route('translator.pages.article') }}">
          <i class="fa fa-newspaper-o"></i> <span>قائمة المقالات</span>
        </a>
      </li>

      <!-- Études -->
      <li class="{{ request()->routeIs('translator.pages.etudes') ? 'active' : '' }}">
        <a href="{{ route('translator.pages.etudes') }}">
          <i class="fa fa-bars"></i> <span>قائمة الدراسات</span>
        </a>
      </li>

      <!-- Livres -->
      <li class="{{ request()->routeIs('translator.pages.books') ? 'active' : '' }}">
        <a href="{{ route('translator.pages.books') }}">
          <i class="fa fa-book"></i> <span>قائمة الكتب</span>
        </a>
      </li>
      <li class="{{ request()->routeIs('translator.translatorByID') ? 'active' : '' }}">
        <a href="{{ route('translator.translatorByID') }}">
          <i class="fa fa-key"></i> <span> تغيير كلمة السر</span>
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