<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Results')</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


  <style>
    body { background:#f6f7fb; }
    .brandbar { background:#198754; }
    .card { border:0; border-radius: 14px; }
    .table thead th { white-space: nowrap; }
    .table td { white-space: nowrap; }
    .marquee{ overflow:hidden; white-space:nowrap; direction:ltr; }
    .marquee__inner{
      display:inline-block;
      animation: marquee-ltr 22s linear infinite;
    }
    .marquee:hover .marquee__inner{ animation-play-state: paused; }

    @keyframes marquee-ltr{
      0%{ transform: translateX(-100%); }
      100%{ transform: translateX(0); }
    }

  </style>

  @stack('styles')
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark brandbar">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ route('public.home') }}">Piplan Results</a>
      <!-- <a class="btn btn-light btn-sm ms-2" href="{{ route('public.clubs') }}">Clubs</a> -->
      <!-- <a class="btn btn-light btn-sm ms-2" href="{{ route('public.events') }}">Events</a> -->

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
