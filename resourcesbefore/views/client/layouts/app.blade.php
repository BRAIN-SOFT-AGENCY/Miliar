<!doctype html>
<html class="no-js" lang="ar" dir="rtl">

<head>
  <meta charset="utf-8">
  <title>مليار كلمـة</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS -->
  <link rel="shortcut icon" href="{{ asset('includes/img/favicon.png') }}">

  <link rel="stylesheet" href="{{ asset('includes/css/font-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('includes/css/plugins.css') }}">
  <link rel="stylesheet" href="{{ asset('includes/css/style.css') }}?v={{ time() }}">
  <link rel="stylesheet" href="{{ asset('includes/css/responsive.css') }}">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- jQuery UI CSS -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  @stack('styles')

</head>

<body>

  <div class="body-wrapper">

    @include('client.partials.header')

    @include('client.partials.mobile_menu')

    @yield('content')

    @include('client.partials.footer')

    @include('client.partials.modals')

  </div>

  <!-- jQuery FIRST -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- jQuery UI AFTER jQuery -->
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

  <!-- Lucide -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- Plugins -->
  <script src="{{ asset('includes/js/plugins.js') }}"></script>

  <!-- Main -->
  <script src="{{ asset('includes/js/main.js') }}?v={{ time() }}"></script>
  <!-- Select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  @stack('scripts')
  
</body>

</html>