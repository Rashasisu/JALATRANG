@extends('layouts.app')

@section('title', $berita->judul)
@section('description', $berita->ringkasan)

@section('content')
    <div style="background:linear-gradient(135deg,#0f3460,#1a1a6e);padding:60px 0 40px">
        <div class="container text-white">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-warning text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('berita.index') }}" class="text-warning text-decoration-none">Berita</a></li>
                    <li class="breadcrumb-item active text-white">Detail</li>
                </ol>
            </nav>
            <h1 class="teko fw-bold mb-2" style="font-size:2.2rem">{{ $berita->judul }}</h1>
            <small style="opacity:.75">
                {{ $berita->kategori->nama ?? 'Umum' }} ·
                {{ $berita->tanggal->locale('id')->translatedFormat('j F Y') }} ·
                <i class="fas fa-eye"></i> {{ number_format($berita->views) }}
            </small>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if ($berita->gambar)
                    <img src="{{ asset('assets/images/web_berita/' . $berita->gambar) }}" class="img-fluid rounded mb-4" alt="{{ $berita->judul }}">
                @endif

                {{-- Isi berita berasal dari admin. Bersihkan HTML (mis. mews/purifier) bila input tidak sepenuhnya tepercaya. --}}
                <article>{!! $berita->isi !!}</article>

                @foreach ($berita->tags as $tag)
                    <a href="{{ route('tag.show', $tag->slug) }}" class="badge bg-light text-secondary border me-1 text-decoration-none">#{{ $tag->nama }}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
