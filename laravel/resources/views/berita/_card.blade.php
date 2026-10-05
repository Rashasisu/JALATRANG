<div class="col-md-6 col-lg-4" data-aos="fade-up">
    <div class="card border-0 shadow-sm h-100 berita-card" style="border-radius:12px;overflow:hidden;transition:transform 0.3s,box-shadow 0.3s"
         onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 30px rgba(0,0,0,0.15)'"
         onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
        <div style="height:160px;overflow:hidden">
            <img src="{{ asset('assets/images/web_berita/' . $berita->gambar) }}"
                 class="w-100 h-100" style="object-fit:cover;transition:transform 0.4s"
                 onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'"
                 alt="{{ $berita->judul }}" loading="lazy"
                 onerror="this.onerror=null;this.src='{{ asset('assets/template/img/no_image.jpg') }}'">
        </div>
        <div class="card-body p-3 d-flex flex-column">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge text-white" style="background:#0f3460;font-size:0.7rem">{{ $berita->kategori->nama ?? 'Umum' }}</span>
                <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>{{ $berita->tanggal->locale('id')->translatedFormat('j M Y') }}</small>
            </div>

            <h6 class="fw-bold mb-2" style="line-height:1.3;flex:1">
                <a href="{{ route('berita.show', $berita->slug) }}" class="text-decoration-none text-dark">{{ Str::limit($berita->judul, 70) }}</a>
            </h6>

            <p class="text-muted small mb-2">{{ $berita->ringkasan }}</p>

            @if ($berita->tags->isNotEmpty())
                <div class="mb-3">
                    @foreach ($berita->tags->take(3) as $tag)
                        <a href="{{ route('tag.show', $tag->slug) }}" class="badge bg-light text-secondary border me-1 text-decoration-none small fw-normal" style="font-size:0.68rem">#{{ $tag->nama }}</a>
                    @endforeach
                </div>
            @endif

            <div class="d-flex align-items-center justify-content-between mt-auto">
                <small class="text-muted"><i class="fas fa-eye me-1"></i>{{ number_format($berita->views) }}</small>
                <a href="{{ route('berita.show', $berita->slug) }}" class="btn btn-sm btn-outline-primary" style="font-size:0.75rem">Baca <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</div>
