<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Results')</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('user/css/style.css') }}">

  @stack('styles')
</head>
<body>

  <nav class="navbar navbar-expand-lg brandbar">
    <div class="container justify-content-center">
      <a class="navbar-brand fw-bold" href="{{ route('public.home') }}">
        <img src="{{ asset('admin/assets/images/logo.png') }}" style="width: 150px;">
      </a>
    </div>
  </nav>
  @include('public.partials.global-header')

  <div class="container py-4">
    @yield('content')
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

  @stack('scripts')
</body>
</html>
