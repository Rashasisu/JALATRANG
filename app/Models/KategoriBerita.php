<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    protected $fillable = ['nama', 'slug'];

    public function beritas() { return $this->hasMany(Berita::class); }
}