<?php

namespace App\Support;

use App\Models\JadwalPemeliharaan;
use Carbon\Carbon;

/**
 * Menghitung status pemeliharaan dari tabel jadwal_pemeliharaan.
 *  NORMAL  : tidak ada jadwal aktif / belum masuk jendela peringatan
 *  WARNING : dalam jendela "peringatan_menit" sebelum mulai
 *  LOCKED  : antara mulai dan selesai
 */
class Maintenance
{
    public function status(): array
    {
        $now = now();

        $jadwal = JadwalPemeliharaan::where('aktif', true)
            ->where('selesai', '>', $now)
            ->orderBy('mulai')
            ->first();

        $normal = [
            'status' => 'NORMAL', 'judul' => 'Pemeliharaan Sistem', 'deskripsi' => '',
            'mulai' => '-', 'selesai' => '-',
            'seconds_until_start' => 0, 'seconds_until_end' => 0,
            'bypassed' => false,
        ];

        if (! $jadwal) {
            return $normal + ['formatted_mulai' => '-', 'formatted_selesai' => '-'];
        }

        $mulai   = Carbon::parse($jadwal->mulai);
        $selesai = Carbon::parse($jadwal->selesai);

        if ($now->gte($mulai)) {
            $status = 'LOCKED';
        } elseif ($now->gte($mulai->copy()->subMinutes($jadwal->peringatan_menit))) {
            $status = 'WARNING';
        } else {
            return $normal + ['formatted_mulai' => '-', 'formatted_selesai' => '-'];
        }

        $fmtMulai   = $mulai->locale('id')->translatedFormat('H:i') . ' WIB';
        $fmtSelesai = $selesai->locale('id')->translatedFormat('j M Y, H:i') . ' WIB';

        return [
            'status'              => $status,
            'judul'               => $jadwal->judul,
            'deskripsi'           => $jadwal->deskripsi ?? '',
            'mulai'               => $fmtMulai,
            'selesai'             => $fmtSelesai,
            'formatted_mulai'     => $fmtMulai,      // dipakai maintenance.js (API)
            'formatted_selesai'   => $fmtSelesai,
            'seconds_until_start' => max(0, $now->diffInSeconds($mulai, false)),
            'seconds_until_end'   => max(0, $now->diffInSeconds($selesai, false)),
            'bypassed'            => auth()->check(),   // admin yang login tidak dikunci
        ];
    }
}
