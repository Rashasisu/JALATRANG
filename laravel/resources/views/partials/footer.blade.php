<footer class="footer-dark pt-5 pb-2 mt-5">
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ asset('assets/images/info_desa/logo.png') }}" style="width:50px;height:50px;object-fit:contain" alt="Logo">
                    <div>
                        <div class="fw-bold text-white">PEMERINTAH DESA</div>
                        <div class="fw-bold text-warning" style="font-size:1.1rem">{{ strtoupper($desa->nama_singkat) }}</div>
                    </div>
                </div>
                <p style="font-size:0.83rem;line-height:1.7">
                    {{ $desa->alamat }}<br>
                    Desa {{ $desa->nama_singkat }}, Kecamatan {{ $desa->kecamatan }}<br>
                    Kabupaten {{ $desa->kabupaten }}<br>
                    <i class="fas fa-phone me-1"></i> {{ $desa->telepon }}<br>
                    <i class="fas fa-envelope me-1"></i> <a href="mailto:{{ $desa->email }}">{{ $desa->email }}</a>
                </p>
                @if ($desa->maps_url)
                    <a href="{{ $desa->maps_url }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-warning mt-1">
                        <i class="fas fa-map-marker-alt me-1"></i> Lihat Peta
                    </a>
                @endif
            </div>

            <div class="col-lg-2 col-6">
                <h5 class="mb-3">Menu</h5>
                <ul class="list-unstyled">
                    @foreach (['/' => 'Beranda', 'berita' => 'Berita', 'struktural' => 'Struktural', 'laporan-apbdes' => 'APBDes', 'prestasi' => 'Prestasi'] as $path => $label)
                        <li class="mb-1"><a href="{{ url($path) }}"><i class="bi bi-chevron-right me-1"></i>{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-3 col-6">
                <h5 class="mb-3">Link Terkait</h5>
                <ul class="list-unstyled">
                    <li class="mb-1"><a href="https://kemendesa.go.id" target="_blank" rel="noopener"><i class="bi bi-box-arrow-up-right me-1"></i>Kemendesa</a></li>
                    <li class="mb-1"><a href="https://ciamis.go.id" target="_blank" rel="noopener"><i class="bi bi-box-arrow-up-right me-1"></i>Kab. Ciamis</a></li>
                    <li class="mb-1"><a href="https://jabar.go.id" target="_blank" rel="noopener"><i class="bi bi-box-arrow-up-right me-1"></i>Pemprov Jabar</a></li>
                    <li class="mb-1"><a href="{{ url('login') }}" target="_blank"><i class="bi bi-shield-lock me-1"></i>Panel Admin</a></li>
                </ul>
            </div>

            <div class="col-lg-3">
                <h5 class="mb-3">Media Sosial</h5>
                @foreach ($medsos as $m)
                    <a href="{{ $m->url }}" target="_blank" rel="noopener" class="d-flex align-items-center gap-2 mb-2">
                        @if ($m->ikon)
                            <img src="{{ asset('assets/images/medsos/' . $m->ikon) }}" style="width:22px;height:22px;object-fit:contain" alt="{{ $m->nama }}">
                        @endif
                        {{ $m->nama }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="footer-bottom text-center mt-4 py-3">
        &copy; {{ date('Y') }} Pemerintah Desa {{ $desa->nama_singkat }} — Semua hak dilindungi.
    </div>
</footer>
