<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $table = 'berita';
    protected $guarded = [];
    protected $casts = ['tanggal' => 'datetime'];

    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'berita_tag');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /** Ringkasan teks polos untuk kartu (HTML & entity dibersihkan). */
    protected function ringkasan(): Attribute
    {
        return Attribute::get(fn () => Str::limit(
            trim(strip_tags(html_entity_decode($this->isi, ENT_QUOTES | ENT_HTML5))),
            90
        ));
    }
}
