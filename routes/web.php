<?php

use App\Http\Controllers\BeritaController;
use App\Support\Maintenance;
use Illuminate\Support\Facades\Route;

// Sementara beranda diarahkan ke halaman berita
Route::get('/', fn () => redirect()->route('berita.index'));

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
// Form tambah berita (harus didefinisikan SEBELUM /berita/{slug})
Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');

Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/tag/{slug}', [BeritaController::class, 'tag'])->name('tag.show');

// Dipakai maintenance.js untuk sinkronisasi status
Route::get('/api/maintenance-status', fn () => response()->json(app(Maintenance::class)->status()))
    ->name('api.maintenance-status');

// Placeholder sampai sistem login dibuat (mis. Laravel Breeze/Filament)
Route::get('/login', fn () => 'Halaman login belum dibuat.')->name('login');
