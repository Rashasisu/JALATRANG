<footer class="footer-dark pt-5 pb-2 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ asset('assets/images/info_desa/logo.png') }}" style="width:50px;height:50px;object-fit:contain" alt="Logo">
                    <div>
                        <div class="fw-bold text-white">PEMERINTAH DESA</div>
                        <div class="fw-bold text-warning" style="font-size:1.1rem">JALATRANG</div>
                    </div>
                </div>
                <p style="font-size:.83rem;line-height:1.7">
                    Jalan Raya Cipaku Nomor 181<br>
                    Desa Jalatrang, Kecamatan Cipaku<br>
                    Kabupaten Ciamis
                </p>
                <a href="https://www.google.com/maps/place/Jalatrang" target="_blank" class="btn btn-sm btn-outline-warning mt-1">
                    <i class="fas fa-map-marker-alt me-1"></i> Lihat Peta
                </a>
            </div>

            <div class="col-lg-2 col-6">
                <h5 class="mb-3">Menu</h5>
                <ul class="list-unstyled">
                    <li class="mb-1"><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="mb-1"><a href="{{ route('berita.index') }}">Berita</a></li>
                    <li class="mb-1"><a href="{{ url('/struktural') }}">Struktural</a></li>
                    <li class="mb-1"><a href="{{ url('/laporan-apbdes') }}">APBDes</a></li>
                    <li class="mb-1"><a href="{{ url('/prestasi') }}">Prestasi</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-6">
                <h5 class="mb-3">Link Terkait</h5>
                <ul class="list-unstyled">
                    <li class="mb-1"><a href="https://kemendesa.go.id" target="_blank">Kemendesa</a></li>
                    <li class="mb-1"><a href="https://ciamis.go.id" target="_blank">Kab. Ciamis</a></li>
                    <li class="mb-1"><a href="https://jabar.go.id" target="_blank">Pemprov Jabar</a></li>
                </ul>
            </div>

            <div class="col-lg-3">
                <h5 class="mb-3">Media Sosial</h5>
                <a href="https://www.youtube.com/@jalatrangTV" target="_blank" class="d-flex align-items-center gap-2 mb-2">YouTube</a>
                <a href="https://instagram.com/pemerintahdesajalatrang" target="_blank" class="d-flex align-items-center gap-2 mb-2">Instagram</a>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center mt-4 py-3">
        &copy; {{ date('Y') }} Pemerintah Desa Jalatrang — Semua hak dilindungi.
    </div>
</footer>