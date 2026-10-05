<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pemerintah Desa Jalatrang')</title>

    <meta name="description" content="@yield('description', 'Kumpulan berita dan informasi terkini dari Desa Jalatrang')">
    <meta name="author" content="Pemerintah Desa Jalatrang">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:site_name" content="Pemerintah Desa Jalatrang">
    <meta property="og:title" content="@yield('title', 'Pemerintah Desa Jalatrang')">
    <meta property="og:image" content="{{ asset('assets/images/info_desa/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">

    {{-- Vendor CSS --}}
    <link href="{{ asset('vendor/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/lightbox/lightbox.min.css') }}">

    {{-- CSS aplikasi --}}
    <link rel="stylesheet" href="{{ asset('assets/template/css/custom_style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/maintenance.css') }}">

    {{-- cdn --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @stack('styles')
</head>
<body>

    @include('partials.preloader')
    @include('partials.topbar')
    @include('partials.navbar')
    @include('partials.drawer')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <button id="scrollTop" title="Ke atas"><i class="fas fa-chevron-up"></i></button>

    @include('partials.maintenance')

    {{-- Konfigurasi dari PHP ke JS --}}
    <script>
        window.APP = {
            baseUrl: "{{ url('/') }}",
            maintenanceUrl: "{{ route('maintenance.status') }}",
            isBypassed: false
        };
    </script>

    {{-- Vendor JS --}}
    <script src="{{ asset('vendor/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/js/aos.js') }}"></script>
    <script src="{{ asset('vendor/js/slick.min.js') }}"></script>
    <script src="{{ asset('vendor/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/js/chart.umd.js') }}"></script>

    {{-- JS aplikasi --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/maintenance.js') }}"></script>

    @stack('scripts')
</body>
</html>