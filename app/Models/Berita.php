<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $fillable = [
        'kategori_berita_id','judul','slug','isi','gambar','views','is_published','published_at',
    ];

    protected $casts = ['published_at' => 'datetime', 'is_published' => 'boolean'];

    public function kategori() { return $this->belongsTo(KategoriBerita::class, 'kategori_berita_id'); }
    public function tags()     { return $this->belongsToMany(Tag::class); }

    public function scopePublished($q)
    {
        return $q->where('is_published', true)->where('published_at', '<=', now());
    }

    public function getGambarUrlAttribute(): string
    {
        return $this->gambar
            ? asset('assets/images/web_berita/'.$this->gambar)
            : asset('assets/template/img/no_image.jpg');
    }

    public function getRingkasanAttribute(): string
    {
        return Str::limit(trim(strip_tags(html_entity_decode($this->isi))), 90);
    }

    public function getRouteKeyName(): string { return 'slug'; }
}