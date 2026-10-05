@extends('layouts.app')

@section('title', $berita->judul.' — Desa Jalatrang')
@section('description', $berita->ringkasan)

@section('content')
<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($berita->judul, 40) }}</li>
        </ol>
    </nav>

    <article class="mx-auto" style="max-width:820px">
        <span class="badge text-white mb-2" style="background:#0f3460">{{ $berita->kategori->nama ?? 'Umum' }}</span>
        <h1 class="fw-bold">{{ $berita->judul }}</h1>
        <p class="text-muted small">
            <i class="fas fa-calendar-alt me-1"></i>{{ $berita->published_at?->translatedFormat('l, j F Y') }}
            &middot; <i class="fas fa-eye me-1"></i>{{ number_format($berita->views) }}
        </p>

        <img src="{{ $berita->gambar_url }}" class="img-fluid rounded mb-4" alt="{{ $berita->judul }}">

        <div class="berita-isi">{!! $berita->isi !!}</div>

        <div class="mt-4">
            @foreach ($berita->tags as $tag)
                <a href="{{ route('berita.tag', $tag) }}" class="badge bg-light text-secondary border text-decoration-none">#{{ $tag->nama }}</a>
            @endforeach
        </div>
    </article>
</div>
@endsection