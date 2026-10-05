<?php
use App\Http\Controllers\{BerandaController, BeritaController, MaintenanceController};
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{berita:slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/tag/{tag:slug}', [BeritaController::class, 'byTag'])->name('berita.tag');

Route::get('/api/maintenance-status', [MaintenanceController::class, 'status'])->name('maintenance.status');