<nav class="navbar navbar-expand-lg navbar-publik sticky-top" id="mainNav">
    <div class="container-fluid px-lg-4 px-3">

        <a class="navbar-brand d-flex align-items-center gap-2 brand-box text-decoration-none me-2" href="{{ url('/') }}">
            <img src="{{ asset('assets/images/info_desa/logo.png') }}" class="navbar-logo flex-shrink-0" alt="Logo Desa">
            <div class="brand-desa-text text-white overflow-hidden" style="min-width:0;">
                <div class="fw-bold teko text-truncate" style="font-size:1.35rem;line-height:1;color:#fff">PEMERINTAH DESA JALATRANG</div>
                <div class="sub text-white-50 text-truncate d-none d-sm-block">KECAMATAN CIPAKU KABUPATEN CIAMIS</div>
            </div>
        </a>

        <div class="navbar-action-group d-flex flex-row align-items-center flex-nowrap gap-2 ms-auto flex-shrink-0 order-lg-last">
            <button class="navbar-toggler border-0 shadow-none" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasPubMain" aria-controls="offcanvasPubMain">
                <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
            </button>
            <button class="btn btn-top-layanan-grid position-relative" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasSideMenu" aria-controls="offcanvasSideMenu"
                    title="Menu Layanan & Toko Desa">
                <span class="grid-icon-wrap"><i class="bi bi-grid-3x3-gap-fill text-warning"></i></span>
            </button>
        </div>

        <div class="offcanvas offcanvas-start offcanvas-lg text-bg-dark border-end-0" tabindex="-1" id="offcanvasPubMain">
            <div class="offcanvas-header border-bottom border-white-10 p-3 d-lg-none">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/images/info_desa/logo.png') }}" class="navbar-logo" alt="Logo Desa">
                    <div>
                        <div class="fw-bold teko text-white" style="font-size:1.3rem;line-height:1">DESA JALATRANG</div>
                        <small class="text-warning small fw-bold">PANEL MENU UTAMA</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas"></button>
            </div>

            <div class="offcanvas-body p-3 p-lg-0">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item mb-1 mb-lg-0">
                        <a class="nav-link nav-home-pill {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}" title="Beranda">
                            <i class="fas fa-home me-2 me-lg-0"></i><span class="d-inline d-lg-none fw-bold ms-1">Beranda</span>
                        </a>
                    </li>

                    @foreach (config('menu') as $item)
                        @if (isset($item['children']))
                            <li class="nav-item dropdown mb-1 mb-lg-0">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    {{ $item['label'] }}
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($item['children'] as $child)
                                        <li>
                                            <a class="dropdown-item {{ request()->is(ltrim($child['url'], '/')) ? 'active' : '' }}"
                                               href="{{ url($child['url']) }}">
                                                <i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i>
                                                {{ $child['label'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item mb-1 mb-lg-0">
                                <a class="nav-link {{ request()->is($item['active'] ?? ltrim($item['url'], '/')) ? 'active' : '' }}"
                                   href="{{ url($item['url']) }}">{{ $item['label'] }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</nav>