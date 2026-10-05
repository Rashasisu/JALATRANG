<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        return $this->render($request);
    }

    public function tag(Request $request, string $slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        return $this->render($request, $tag);
    }

    /** Form tambah berita */
    public function create()
    {
        $kategori = KategoriBerita::orderBy('nama')->get();

        return view('berita.create', compact('kategori'));
    }

    /** Simpan berita baru */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'       => 'required|max:255',
            'kategori_id' => 'required|exists:kategori_berita,id',
            'tanggal'     => 'required|date',
            'isi'         => 'required|min:10',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags'        => 'nullable|string|max:255',
            'status'      => 'required|in:published,draft',
        ], [
            'judul.required'       => 'Judul wajib diisi.',
            'kategori_id.required' => 'Silakan pilih kategori.',
            'isi.required'         => 'Isi berita wajib diisi.',
            'isi.min'              => 'Isi berita minimal 10 karakter.',
            'gambar.image'         => 'File harus berupa gambar.',
            'gambar.max'           => 'Ukuran gambar maksimal 2 MB.',
        ]);

        // Upload gambar (opsional) ke public/assets/images/web_berita
        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $dir  = public_path('assets/images/web_berita');
            File::ensureDirectoryExists($dir);

            $namaGambar = time() . '-' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->extension();
            $file->move($dir, $namaGambar);
        }

        // Teks polos -> paragraf HTML yang sudah di-escape (aman dari XSS)
        $isiHtml = collect(preg_split('/\R{2,}/', trim($data['isi'])))
            ->map(fn ($p) => '<p>' . nl2br(e(trim($p))) . '</p>')
            ->implode("\n");

        $berita = Berita::create([
            'judul'       => $data['judul'],
            'slug'        => $this->slugUnik($data['judul']),
            'isi'         => $isiHtml,
            'gambar'      => $namaGambar,
            'kategori_id' => $data['kategori_id'],
            'tanggal'     => $data['tanggal'],
            'status'      => $data['status'],
        ]);

        // Tag: "desa, voli, 2026" -> relasi many-to-many
        $tagIds = collect(explode(',', $data['tags'] ?? ''))
            ->map(fn ($t) => trim($t, " #\t\n\r"))
            ->filter()
            ->unique()
            ->map(fn ($t) => Tag::firstOrCreate(['slug' => Str::slug($t)], ['nama' => $t])->id);

        $berita->tags()->sync($tagIds);

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function show(string $slug)
    {
        $berita = Berita::with(['kategori', 'tags'])->published()->where('slug', $slug)->firstOrFail();
        $berita->increment('views');

        return view('berita.show', compact('berita'));
    }

    private function slugUnik(string $judul): string
    {
        $dasar = Str::slug($judul) ?: 'berita';
        $slug  = $dasar;
        $i     = 2;

        while (Berita::where('slug', $slug)->exists()) {
            $slug = $dasar . '-' . $i++;
        }

        return $slug;
    }

    private function render(Request $request, ?Tag $tag = null)
    {
        $berita = Berita::with(['kategori', 'tags'])
            ->published()
            ->when($tag, fn ($q) => $q->whereHas('tags', fn ($t) => $t->whereKey($tag->id)))
            ->when($request->filled('q'), fn ($q) => $q->where('judul', 'like', '%' . $request->q . '%'))
            ->when($request->filled('kategori'), fn ($q) => $q->where('kategori_id', $request->kategori))
            ->latest('tanggal')
            ->paginate(12)
            ->withQueryString();

        $kategori = KategoriBerita::orderBy('nama')->get();

        return view('berita.index', compact('berita', 'kategori', 'tag'));
    }
}
