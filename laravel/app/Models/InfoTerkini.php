<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoTerkini extends Model
{
    protected $table = 'info_terkini';
    protected $guarded = [];
    protected $casts = ['aktif' => 'boolean'];
}
