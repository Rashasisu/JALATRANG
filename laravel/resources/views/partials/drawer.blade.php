@php
    $drawer = [
        'Ekonomi & Belanja Warga' => ['icon' => 'fa-store', 'color' => 'text-success', 'items' => [
            ['key' => 'warung',   'icon' => 'fa-store',             'label' => 'Warung Desa',        'badge' => 'PASAR',     'badgeClass' => 'bg-success text-success',  'desc' => 'Katalog produk UMKM & hasil tani warga',      'url' => 'warung-desa'],
            ['key' => 'cart',     'icon' => 'fa-cart-shopping',     'label' => 'Keranjang Belanja',  'badge' => $jumlahKeranjang . ' Item', 'badgeClass' => 'bg-secondary text-white-50', 'desc' => 'Periksa daftar belanjaan & checkout', 'url' => 'warung-desa/keranjang'],
            ['key' => 'kopdes',   'icon' => 'fa-building-columns',  'label' => 'Kopdes Merah Putih', 'badge' => 'KOPDES',    'badgeClass' => 'bg-danger text-danger',    'desc' => 'Layanan simpan pinjam & ekonomi warga',       'url' => 'koperasi-desa-merah-putih'],
        ]],
        'Literasi & Prestasi' => ['icon' => 'fa-book-open-reader', 'color' => 'text-info', 'items' => [
            ['key' => 'perpus',   'icon' => 'fa-book-open-reader',  'label' => 'Perpustakaan Desa',  'badge' => 'LITERASI',  'badgeClass' => 'bg-info text-info',        'desc' => 'Katalog buku fisik, e-library & pustaka',     'url' => 'perpustakaan'],
            ['key' => 'prestasi', 'icon' => 'fa-trophy',            'label' => 'Prestasi Desa',      'badge' => 'PRESTASI',  'badgeClass' => 'bg-warning text-warning',  'desc' => 'Piagam, penghargaan & prestasi kebanggaan',   'url' => 'prestasi'],
        ]],
        'Layanan Mandiri & Admin' => ['icon' => 'fa-shield-halved', 'color' => 'text-primary', 'items' => [
            ['key' => 'warga',    'icon' => 'fa-users',             'label' => 'Warga Desa',         'badge' => 'PORTAL',    'badgeClass' => 'bg-primary text-info',     'desc' => 'Layanan surat, belanjaan saya & profil',      'url' => 'warga/login'],
            ['key' => 'admin',    'icon' => 'fa-shield-halved',     'label' => 'Admin Desa',         'badge' => 'ADMIN',     'badgeClass' => 'bg-danger text-danger',    'desc' => 'Panel administrasi & tata kelola desa',       'url' => 'login', 'blank' => true],
        ]],
    ];
@endphp

<div class="offcanvas offcanvas-end text-bg-dark border-0" tabindex="-1" id="offcanvasSideMenu" aria-labelledby="offcanvasSideMenuLabel">
    <div class="offcanvas-header border-bottom border-white-10 p-3" style="background: rgba(15, 23, 42, 0.95);">
        <div class="d-flex align-items-center gap-2">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-warning" style="width: 38px; height: 38px; background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.35);">
                <i class="bi bi-grid-3x3-gap-fill fs-5"></i>
            </div>
            <div>
                <h6 class="fw-bold text-white mb-0" id="offcanvasSideMenuLabel" style="font-size: 0.95rem;">Layanan & Toko Desa</h6>
                <small class="text-white-50" style="font-size: 0.72rem;">Portal Digital Desa {{ $desa->nama_singkat }}</small>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-3 d-flex flex-column justify-content-between">
        <div class="d-flex flex-column gap-3">
            @foreach ($drawer as $title => $group)
                <div class="drawer-section-title {{ $loop->first ? '' : 'mt-1' }}">
                    <i class="fa-solid {{ $group['icon'] }} me-1 {{ $group['color'] }}"></i> {{ $title }}
                </div>

                @foreach ($group['items'] as $it)
                    <a href="{{ url($it['url']) }}" @if (!empty($it['blank'])) target="_blank" @endif
                       class="quick-card-item item-{{ $it['key'] }} {{ request()->is($it['url'] . '*') ? 'active' : '' }}">
                        <div class="quick-card-icon icon-{{ $it['key'] }}"><i class="fa-solid {{ $it['icon'] }}"></i></div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <span class="fw-bold text-white" style="font-size: 0.88rem;">{{ $it['label'] }}</span>
                                <span class="badge {{ $it['badgeClass'] }} bg-opacity-25 rounded-pill font-monospace" style="font-size: 0.65rem;">{{ $it['badge'] }}</span>
                            </div>
                            <p class="text-white-50 mb-0 text-truncate" style="font-size: 0.75rem;">{{ $it['desc'] }}</p>
                        </div>
                    </a>
                @endforeach
            @endforeach
        </div>

        <div class="border-top border-white-10 pt-3 mt-3 text-center">
            <small class="text-white-50 d-block" style="font-size: 0.72rem;">
                <i class="fa-solid fa-store text-success me-1"></i> Pasar & Layanan Digital Desa {{ $desa->nama_singkat }}
            </small>
        </div>
    </div>
</div>
