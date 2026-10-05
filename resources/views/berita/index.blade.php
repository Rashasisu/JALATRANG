@extends('layouts.app')

@section('title', 'Berita Desa')
@section('description', 'Kumpulan berita dan informasi terkini dari Desa ' . $desa->nama_singkat)

@section('content')
    {{-- Header halaman --}}
    <div style="background:linear-gradient(135deg,#0f3460,#1a1a6e);padding:60px 0 40px" class="mt-0">
        <div class="container text-white">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-warning text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active text-white">Berita</li>
                </ol>
            </nav>
            <h1 class="teko fw-bold mb-0" style="font-size:2.5rem">Berita &amp; Informasi</h1>
            <p style="opacity:0.7">Informasi terkini dari Desa {{ $desa->nama_singkat }}</p>
        </div>
    </div>

    <div class="container my-5">
        <div class="row g-4">

            {{-- Filter --}}
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm sticky-top" style="top:80px;border-radius:12px;overflow:hidden">
                    <div class="card-header text-white fw-bold" style="background:#0f3460">
                        <i class="fas fa-filter me-2"></i> Filter Berita
                    </div>
                    <div class="card-body p-3">
                        <form method="GET" action="{{ route('berita.index') }}">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Kata Kunci</label>
                                <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari berita...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Kategori</label>
                                <select name="kategori" class="form-select form-select-sm">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}" @selected(request('kategori') == $k->id)>{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                                <a href="{{ route('berita.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                            </div>
                        </form>
                        <a href="{{ route('berita.create') }}" class="btn btn-success w-100 mt-3">
                            <i class="fas fa-plus me-1"></i> Tambah Berita
                        </a>
                    </div>
                </div>
            </div>

            {{-- Daftar berita --}}
            <div class="col-lg-9">
                @isset($tag)
                    <div class="alert alert-info py-2 small">
                        Menampilkan berita dengan tag <strong>#{{ $tag->nama }}</strong>
                        — <a href="{{ route('berita.index') }}">tampilkan semua</a>
                    </div>
                @endisset

                @if ($berita->isNotEmpty())
                    <div class="row g-4">
                        @foreach ($berita as $item)
                            @include('berita._card', ['berita' => $item])
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center mt-5">
                        {{ $berita->links() }}
                    </div>
                @else
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-newspaper fa-3x mb-3"></i>
                        <p class="mb-0">Belum ada berita yang sesuai dengan pencarian Anda.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
