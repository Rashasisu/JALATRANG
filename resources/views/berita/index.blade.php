@extends('layouts.app')

@section('title', 'Berita Desa — Jalatrang')

@section('content')
<div style="background:linear-gradient(135deg,#0f3460,#1a1a6e);padding:60px 0 40px">
    <div class="container text-white">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-warning text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item active text-white">Berita</li>
            </ol>
        </nav>
        <h1 class="teko fw-bold mb-0" style="font-size:2.5rem">Berita &amp; Informasi</h1>
        <p style="opacity:.7">Informasi terkini dari Desa Jalatrang</p>
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
                                @foreach ($kategoris as $k)
                                    <option value="{{ $k->id }}" @selected(request('kategori') == $k->id)>{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                            <a href="{{ route('berita.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Daftar berita --}}
        <div class="col-lg-9">
            @if ($beritas->count())
                <div class="row g-4">
                    @foreach ($beritas as $berita)
                        @include('berita._card', ['berita' => $berita])
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-5">
                    {{ $beritas->links() }}
                </div>
            @else
                <div class="text-center text-muted py-5">
                    <i class="fas fa-newspaper fa-3x mb-3"></i>
                    <p>Belum ada berita yang sesuai.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection