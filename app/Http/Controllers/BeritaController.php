<?php
namespace App\Http\Controllers;

use App\Models\{Berita, KategoriBerita, Tag};
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $beritas = Berita::with(['kategori', 'tags'])
            ->published()
            ->when($request->filled('q'), fn ($q) =>
                $q->where(fn ($w) => $w
                    ->where('judul', 'like', '%'.$request->q.'%')
                    ->orWhere('isi', 'like', '%'.$request->q.'%')))
            ->when($request->filled('kategori'), fn ($q) =>
                $q->where('kategori_berita_id', $request->kategori))
            ->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('berita.index', [
            'beritas'   => $beritas,
            'kategoris' => KategoriBerita::orderBy('nama')->get(),
        ]);
    }

    public function show(Berita $berita)
    {
        abort_unless($berita->is_published, 404);
        $berita->increment('views');
        $berita->load(['kategori', 'tags']);

        return view('berita.show', compact('berita'));
    }

    public function byTag(Tag $tag)
    {
        $beritas = $tag->beritas()->with(['kategori', 'tags'])->published()
            ->latest('published_at')->paginate(12);

        return view('berita.index', [
            'beritas'   => $beritas,
            'kategoris' => KategoriBerita::orderBy('nama')->get(),
        ]);
    }
}