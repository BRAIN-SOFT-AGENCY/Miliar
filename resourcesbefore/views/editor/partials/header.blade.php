<aside class="main-sidebar" style="background-color: #303748 !important;">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-right image">
        <img src="{{asset('includesAdmin/dist/img/editor.jpg')}}" class="img-circle" alt="User Image"
          style="    height: 43px;">
      </div>
      <div class="pull-left info">
        <p>

          فضاء المدقق

        </p>
        <a href="#"><i class="fa fa-circle text-success"></i> متصل</a>
      </div>
    </div>
    <!-- search form -->

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <!-- Accueil editor -->
      <li class="treeview {{ request()->routeIs('editor.pages.index') ? 'active' : '' }}">
        <a href="{{ route('editor.pages.index') }}">
          <i class="fa fa-dashboard"></i> <span>الواجهة الرئيسية</span>
        </a>
      </li>

      <!-- Articles editor -->
      <li class="{{ request()->routeIs('editor.pages.articleeditor') ? 'active' : '' }}">
        <a href="{{ route('editor.pages.articleeditor') }}">
          <i class="fa fa-newspaper-o"></i> <span>قائمة المقالات</span>
          @if($articleCounteditor > 0)
            <small class="label pull-left bg-red">
              {{ $articleCounteditor }}
            </small>
          @endif
        </a>
      </li>

      <!-- Études editor -->
      <li class="{{ request()->routeIs('editor.pages.etudeseditor') ? 'active' : '' }}">
        <a href="{{ route('editor.pages.etudeseditor') }}">
          <i class="fa fa-newspaper-o"></i> <span>قائمة الدراسات</span>

          @if($etudesCounteditor > 0)
            <small class="label pull-left bg-red">
              {{ $etudesCounteditor }}
            </small>
          @endif
        </a>
      </li>

      <!-- Livres editor -->
      <li class="{{ request()->routeIs('editor.pages.bookseditor') ? 'active' : '' }}">
        <a href="{{ route('editor.pages.bookseditor') }}">
          <i class="fa fa-book"></i>
          <span>قائمة الكتب</span>

          @if($booksCounteditor > 0)
            <small class="label pull-left bg-red">
              {{ $booksCounteditor }}
            </small>
          @endif
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