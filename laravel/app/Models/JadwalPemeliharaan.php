<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPemeliharaan extends Model
{
    protected $table = 'jadwal_pemeliharaan';
    protected $guarded = [];
    protected $casts = ['mulai' => 'datetime', 'selesai' => 'datetime', 'aktif' => 'boolean'];
}
