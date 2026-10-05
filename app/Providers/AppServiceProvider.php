<?php

namespace App\Providers;

use App\Models\InfoDesa;
use App\Models\InfoTerkini;
use App\Models\Medsos;
use App\Support\Maintenance;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Data dipakai layout & partial. Di-memo agar query hanya jalan sekali per request,
        // dan baru dijalankan saat view dirender (aman untuk `php artisan migrate`).
        View::composer('*', function ($view) {
            static $data = null;

            $data ??= [
                'desa'            => InfoDesa::first() ?? new InfoDesa([
                    'nama_singkat' => 'Jalatrang', 'kecamatan' => 'Cipaku', 'kabupaten' => 'Ciamis',
                ]),
                'infoTerkini'     => InfoTerkini::where('aktif', true)->latest()->take(5)->get(),
                'medsos'          => Medsos::orderBy('urutan')->get(),
                'jumlahKeranjang' => count(session('keranjang', [])),
                'maintenance'     => app(Maintenance::class)->status(),
            ];

            $view->with($data);
        });
    }
}
