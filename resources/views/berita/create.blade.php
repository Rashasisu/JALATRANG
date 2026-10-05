@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')
    <div style="background:linear-gradient(135deg,#0f3460,#1a1a6e);padding:60px 0 40px" class="mt-0">
        <div class="container text-white">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-warning text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('berita.index') }}" class="text-warning text-decoration-none">Berita</a></li>
                    <li class="breadcrumb-item active text-white">Tambah</li>
                </ol>
            </nav>
            <h1 class="teko fw-bold mb-0" style="font-size:2.5rem">Tambah Berita</h1>
            <p style="opacity:0.7">Tulis berita atau informasi baru untuk warga</p>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm" style="border-radius:12px;overflow:hidden">
                    <div class="card-header text-white fw-bold" style="background:#0f3460">
                        <i class="fas fa-plus-circle me-2"></i> Form Tambah Berita
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                           

                            {{-- Judul --}}
                            <div class="mb-3">
                                <label for="judul" class="form-label fw-semibold">Judul</label>
                                <input type="text" name="judul" id="judul"
                                       class="form-control @error('judul') is-invalid @enderror"
                                       value="{{ old('judul') }}" placeholder="Judul berita...">
                                @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                {{-- Kategori --}}
                                <div class="col-md-6 mb-3">
                                    <label for="kategori_id" class="form-label fw-semibold">Kategori</label>
                                    <select name="kategori_id" id="kategori_id"
                                            class="form-select @error('kategori_id') is-invalid @enderror">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}" @selected(old('kategori_id') == $k->id)>{{ $k->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Tanggal --}}
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal" class="form-label fw-semibold">Tanggal Terbit</label>
                                    <input type="datetime-local" name="tanggal" id="tanggal"
                                           class="form-control @error('tanggal') is-invalid @enderror"
                                           value="{{ old('tanggal', now()->format('Y-m-d\TH:i')) }}">
                                    @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Isi --}}
                            <div class="mb-3">
                                <label for="isi" class="form-label fw-semibold">Isi Berita</label>
                                <textarea name="isi" id="isi" rows="8"
                                          class="form-control @error('isi') is-invalid @enderror"
                                          placeholder="Tulis isi berita di sini... (pisahkan paragraf dengan baris kosong)">{{ old('isi') }}</textarea>
                                @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Gambar --}}
                            <div class="mb-3">
                                <label for="gambar" class="form-label fw-semibold">Gambar <span class="text-muted fw-normal">(opsional)</span></label>
                                <input type="file" name="gambar" id="gambar" accept="image/*"
                                       class="form-control @error('gambar') is-invalid @enderror">
                                <div class="form-text">Format JPG, PNG, atau WEBP. Maksimal 2 MB.</div>
                                @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <img id="previewGambar" class="img-fluid rounded mt-2 d-none" style="max-height:200px" alt="Pratinjau gambar">
                            </div>

                            <div class="row">
                                {{-- Tag --}}
                                <div class="col-md-8 mb-3">
                                    <label for="tags" class="form-label fw-semibold">Tag <span class="text-muted fw-normal">(opsional)</span></label>
                                    <input type="text" name="tags" id="tags"
                                           class="form-control @error('tags') is-invalid @enderror"
                                           value="{{ old('tags') }}" placeholder="desa, voli, 2026">
                                    <div class="form-text">Pisahkan dengan koma.</div>
                                    @error('tags') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Status --}}
                                <div class="col-md-4 mb-3">
                                    <label for="status" class="form-label fw-semibold">Status</label>
                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                        <option value="published" @selected(old('status', 'published') === 'published')>Terbit</option>
                                        <option value="draft" @selected(old('status') === 'draft')>Draft</option>
                                    </select>
                                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="d-flex gap-2 pt-3 border-top mt-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                                <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Pratinjau gambar sebelum diunggah
    document.getElementById('gambar')?.addEventListener('change', function () {
        const img = document.getElementById('previewGambar');
        const file = this.files[0];
        if (file) {
            img.src = URL.createObjectURL(file);
            img.classList.remove('d-none');
        } else {
            img.classList.add('d-none');
        }
    });
</script>
@endpush
