<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\InfoDesa;
use App\Models\InfoTerkini;
use App\Models\KategoriBerita;
use App\Models\Medsos;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        InfoDesa::create([
            'nama_singkat' => 'Jalatrang',
            'kecamatan'    => 'Cipaku',
            'kabupaten'    => 'Ciamis',
            'alamat'       => 'Jalan Raya Cipaku Nomor 181',
            'telepon'      => '08xxxxxxxxxx',            // ganti dengan nomor asli
            'email'        => 'desa@example.com',        // ganti dengan email asli
            'maps_url'     => 'https://www.google.com/maps/place/Jalatrang',
        ]);

        foreach ([
            'Sekarang Anda dapat belanja langsung di Warung Desa yang merupakan Warung Online Masyarakat Desa Jalatrang.',
            'Kini Hadir Perpustakaan Desa Selaras dengan wajah baru dan manajemen yang lebih baik',
            'Warga bisa memeriksa langsung pembayaran PBB pada website',
            'Desa Jalatrang akan membuka layanan publik untuk mempermudah akses informasi dan pelayanan masyarakat',
        ] as $isi) {
            InfoTerkini::create(['isi' => $isi]);
        }

        foreach ([
            ['twitter/x', 'https://x.com'],
            ['facebook',  'https://facebook.com'],
            ['youtube',   'https://www.youtube.com/@jalatrangTV'],
            ['instagram', 'https://instagram.com/pemerintahdesajalatrang'],
        ] as $i => [$nama, $url]) {
            Medsos::create(['nama' => $nama, 'url' => $url, 'urutan' => $i]);
        }

        // ID sengaja disamakan dengan data lama
        foreach ([
            1 => 'tidak memiliki kategori', 2 => 'Pendidikan', 3 => 'Olahraga', 4 => 'kunjungan',
            5 => 'potensi', 6 => 'pembangunan', 7 => 'pemuda', 8 => 'ekonomi', 9 => 'keuangan',
            10 => 'Prestasi dan Apresiasi',
        ] as $id => $nama) {
            KategoriBerita::create(['id' => $id, 'nama' => $nama, 'slug' => Str::slug($nama)]);
        }

        // Contoh berita (ganti/hapus setelah data asli dimasukkan)
        $contoh = [
            ['Malam Penuh Gengsi Dimulai! 16 Tim Berebut Mahkota Juara di Ajang CVC Cup 2026 Desa Jalatrang', 3, '2026-09-26', 365, ['cikandung', 'dusun', '2026']],
            ['Pemerintah Desa Jalatrang Kukuhkan Desa Siaga TB, Perkuat Kolaborasi Lintas Sektor Basmi Tuberkulosis', 2, '2026-09-28', 141, ['desa', 'jalatrang', 'siaga']],
            ['Pertahankan Gelar Juara, Jalatrang Muda FC Sabet Gelar Juara 1 Buniseuri Championship 2026', 3, '2026-08-04', 1152, ['desa', 'jalatrang', 'muda']],
        ];

        foreach ($contoh as [$judul, $kat, $tgl, $views, $tags]) {
            $b = Berita::create([
                'judul'       => $judul,
                'slug'        => Str::slug($judul),
                'isi'         => '<p>JalatrangNews; ' . $judul . '. (Isi berita contoh.)</p>',
                'gambar'      => null,
                'kategori_id' => $kat,
                'tanggal'     => $tgl . ' 08:00:00',
                'views'       => $views,
                'status'      => 'published',
            ]);

            $b->tags()->syncWithoutDetaching(
                collect($tags)->map(fn ($t) => Tag::firstOrCreate(['slug' => Str::slug($t)], ['nama' => $t])->id)
            );
        }
    }
}
