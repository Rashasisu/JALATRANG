<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $pageTitle = trim($__env->yieldContent('title', 'Beranda')) . ' — ' . $desa->nama_singkat;
        $pageDesc  = trim($__env->yieldContent('description', 'Kumpulan berita dan informasi terkini dari Desa ' . $desa->nama_singkat));
        $pageImage = asset('assets/images/info_desa/logo.png');
    @endphp

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDesc }}">
    <meta name="keywords" content="desa {{ strtolower($desa->nama_singkat) }}, website desa, pemerintah desa">
    <meta name="author" content="Pemerintah Desa {{ $desa->nama_singkat }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:site_name" content="Pemerintah Desa {{ $desa->nama_singkat }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDesc }}">
    <meta property="og:image" content="{{ $pageImage }}">
    <meta property="og:image:secure_url" content="{{ $pageImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDesc }}">
    <meta name="twitter:image" content="{{ $pageImage }}">

    <link rel="image_src" href="{{ $pageImage }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">

    {{-- Vendor CSS (public/vendor) --}}
    <link href="{{ asset('vendor/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick-theme.css') }}">
    <link href="{{ asset('vendor/lightbox/lightbox.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/template/css/custom_style.css') }}?v={{ filemtime(public_path('assets/template/css/custom_style.css')) }}">

    {{-- CSS & JS aplikasi (resources/) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body>

    @include('partials.preloader')
    @include('partials.topbar')
    @include('partials.navbar')
    @include('partials.drawer')

    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        </div>
    @endif

    @yield('content')

    @include('partials.footer')

    <button id="scrollTop" title="Ke atas"><i class="fas fa-chevron-up"></i></button>

    @include('partials.maintenance')

    {{-- Vendor JS: dimuat sebelum app.js (module bersifat deferred) --}}
    <script src="{{ asset('vendor/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/js/aos.js') }}"></script>
    <script src="{{ asset('vendor/js/slick.min.js') }}"></script>
    <script src="{{ asset('vendor/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/js/chart.umd.js') }}"></script>

    @stack('scripts')
</body>
</html>
