<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts (optional) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- If you want to keep Vite later, uncomment (optional) -->

    <style>
        body { font-family: 'Figtree', sans-serif; }
    </style>
</head>

<body class="bg-light text-dark">
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center py-4">

        <div class="mb-4">
            <a href="/" class="d-inline-block text-decoration-none">
                {{-- Option 1: Keep your component (but remove tailwind classes) --}}
                <x-application-logo style="width:80px;height:80px;" />

                {{-- Option 2: If you have logo image, use this instead --}}
                {{-- <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:80px;height:80px;"> --}}
            </a>
        </div>

        <div class="card shadow-sm" style="width: 100%; max-width: 420px;">
            <div class="card-body p-4">
                {{ $slot }}
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
