<?php
namespace App\Http\Controllers;

class MaintenanceController extends Controller
{
    public function status()
    {
        return response()->json([
            'status'              => 'NORMAL',   // NORMAL | WARNING | LOCKED
            'seconds_until_start' => 0,
            'seconds_until_end'   => 0,
            'judul'               => null,
            'deskripsi'           => null,
            'formatted_mulai'     => null,
            'formatted_selesai'   => null,
        ]);
    }
}