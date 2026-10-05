<div class="col-md-6 col-lg-4" data-aos="fade-up">
    <div class="card border-0 shadow-sm h-100 card-berita">
        <div style="height:160px;overflow:hidden">
            <img src="{{ $berita->gambar_url }}" class="w-100 h-100 berita-img" style="object-fit:cover"
                 alt="{{ $berita->judul }}"
                 onerror="this.onerror=null;this.src=`{{ asset('assets/template/img/no_image.jpg') }}`;">
        </div>
        <div class="card-body p-3 d-flex flex-column">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge text-white" style="background:#0f3460;font-size:.7rem">
                    {{ $berita->kategori->nama ?? 'Umum' }}
                </span>
                <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>{{ $berita->published_at?->translatedFormat('j M Y') }}</small>
            </div>

            <h6 class="fw-bold mb-2" style="line-height:1.3;flex:1">
                <a href="{{ route('berita.show', $berita) }}" class="text-decoration-none text-dark">
                    {{ Str::limit($berita->judul, 70) }}
                </a>
            </h6>

            <p class="text-muted small mb-2">{{ $berita->ringkasan }}</p>

            @if ($berita->tags->count())
                <div class="mb-3">
                    @foreach ($berita->tags->take(3) as $tag)
                        <a href="{{ route('berita.tag', $tag) }}"
                           class="badge bg-light text-secondary border me-1 text-decoration-none small fw-normal"
                           style="font-size:.68rem">#{{ $tag->nama }}</a>
                    @endforeach
                </div>
            @endif

            <div class="d-flex align-items-center justify-content-between mt-auto">
                <small class="text-muted"><i class="fas fa-eye me-1"></i>{{ number_format($berita->views) }}</small>
                <a href="{{ route('berita.show', $berita) }}" class="btn btn-sm btn-outline-primary" style="font-size:.75rem">
                    Baca <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>