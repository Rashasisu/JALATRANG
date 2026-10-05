<div id="preloader">
    <div class="preloader-box">
        <div class="preloader-logo-wrapper">
            <img src="{{ asset('assets/images/info_desa/logo.png') }}"
                 class="preloader-logo" alt="Logo {{ $desa->nama_singkat }}"
                 onerror="this.src='{{ asset('assets/template/img/logo_ciamis.png') }}'">
        </div>
        <div class="preloader-spinner"></div>
        <div class="preloader-title">PEMERINTAH DESA {{ strtoupper($desa->nama_singkat) }}</div>
        <div class="preloader-subtitle">Sedang memuat data...</div>
    </div>
</div>
