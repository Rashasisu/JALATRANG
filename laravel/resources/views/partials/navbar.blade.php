@php
    $isActive = fn (string $path) => request()->is(trim($path, '/'), trim($path, '/') . '/*');
@endphp

<nav class="navbar navbar-expand-lg navbar-publik sticky-top" id="mainNav">
    <div class="container-fluid px-lg-4 px-3">

        <a class="navbar-brand d-flex align-items-center gap-2 brand-box text-decoration-none me-2" href="{{ url('/') }}">
            <img src="{{ asset('assets/images/info_desa/logo.png') }}" class="navbar-logo flex-shrink-0" alt="Logo Desa"
                 onerror="this.src='{{ asset('assets/template/img/logo_ciamis.png') }}'">
            <div class="brand-desa-text text-white overflow-hidden" style="min-width:0;">
                <div class="fw-bold teko text-truncate" style="font-size:1.35rem;line-height:1;color:#fff">PEMERINTAH DESA {{ strtoupper($desa->nama_singkat) }}</div>
                <div class="sub text-white-50 text-truncate d-none d-sm-block" style="font-size:0.65rem;letter-spacing:0.05em">KECAMATAN {{ strtoupper($desa->kecamatan) }} KABUPATEN {{ strtoupper($desa->kabupaten) }}</div>
            </div>
        </a>

        <div class="navbar-action-group d-flex flex-row align-items-center flex-nowrap gap-2 ms-auto flex-shrink-0 order-lg-last">
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasPubMain" aria-controls="offcanvasPubMain" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
            </button>

            <button class="btn btn-top-layanan-grid position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSideMenu" aria-controls="offcanvasSideMenu" title="Menu Layanan & Toko Desa">
                <span class="grid-icon-wrap"><i class="bi bi-grid-3x3-gap-fill text-warning"></i></span>
                @if ($jumlahKeranjang > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cart-dot-badge">{{ $jumlahKeranjang }}</span>
                @endif
            </button>
        </div>

        <div class="offcanvas offcanvas-start offcanvas-lg text-bg-dark border-end-0" tabindex="-1" id="offcanvasPubMain" aria-labelledby="offcanvasPubMainLabel">
            <div class="offcanvas-header border-bottom border-white-10 p-3 d-lg-none">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/images/info_desa/logo.png') }}" class="navbar-logo" alt="Logo Desa"
                         onerror="this.src='{{ asset('assets/template/img/logo_ciamis.png') }}'">
                    <div>
                        <div class="fw-bold teko text-white" style="font-size:1.3rem;line-height:1" id="offcanvasPubMainLabel">DESA {{ strtoupper($desa->nama_singkat) }}</div>
                        <small class="text-warning small fw-bold" style="letter-spacing:0.05em">PANEL MENU UTAMA</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body p-3 p-lg-0">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item mb-1 mb-lg-0">
                        <a class="nav-link nav-home-pill {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}" title="Beranda">
                            <i class="fas fa-home me-2 me-lg-0"></i><span class="d-inline d-lg-none fw-bold ms-1">Beranda</span>
                        </a>
                    </li>

                    @foreach (config('menu') as $item)
                        @if (!empty($item['children']))
                            @php $anyActive = collect($item['children'])->contains(fn ($c) => $isActive($c['url'])); @endphp
                            <li class="nav-item dropdown mb-1 mb-lg-0">
                                <a class="nav-link dropdown-toggle {{ $anyActive ? 'active' : '' }}" href="#" role="button"
                                   data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">{{ $item['label'] }}</a>
                                <ul class="dropdown-menu">
                                    @foreach ($item['children'] as $child)
                                        <li>
                                            <a class="dropdown-item {{ $isActive($child['url']) ? 'active' : '' }}" href="{{ url($child['url']) }}">
                                                <i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> {{ $child['label'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item mb-1 mb-lg-0">
                                <a class="nav-link {{ $isActive($item['url']) ? 'active' : '' }}" href="{{ url($item['url']) }}">{{ $item['label'] }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</nav>
