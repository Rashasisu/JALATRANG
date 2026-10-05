<?php

namespace Database\Seeders;

use App\Models\{Berita, KategoriBerita, Tag};
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['ekonomi','keuangan','kunjungan','Olahraga','pembangunan','pemuda',
                  'Pendidikan','potensi','Prestasi dan Apresiasi'] as $nama) {
            KategoriBerita::firstOrCreate(['slug' => Str::slug($nama)], ['nama' => $nama]);
        }

        $data = [
            [
                'Olahraga',
                'Malam Penuh Gengsi Dimulai! 16 Tim Berebut Mahkota Juara di Ajang CVC Cup 2026 Desa Jalatrang',
                '1790662317-whatsapp-image-2026-09-27-at-081321.jpeg',
                365, '2026-09-26', ['cikandung', 'dusun', '2026'],
            ],
            [
                'Pendidikan',
                'Pemerintah Desa Jalatrang Kukuhkan Desa Siaga TB, Perkuat Kolaborasi Lintas Sektor Basmi Tuberkulosis',
                '1790660451-whatsapp-image-2026-09-28-at-102755.jpeg',
                141, '2026-09-28', ['desa', 'jalatrang', 'siaga'],
            ],
            [
                'Olahraga',
                'WAHANA JALATRANG MUDA Sabet Juara 1 Domba Cup 2026 Usai Taklukkan Perpu SDR Ciamis',
                '1790408699-whatsapp-image-2026-09-25-at-174805.jpeg',
                234, '2026-09-26', ['voli', 'bola', 'turnamen'],
            ],
            [
                'Pendidikan',
                'Jejak Inspiratif Elsa Nuari Hardiana: Srikandi Multitalenta di Balik Pemberdayaan dan Kemajuan Desa Jalatrang',
                '1790234973-whatsapp-image-2026-09-24-at-135748.jpeg',
                118, '2026-09-24', ['desa', 'elsa', 'jalatrang'],
            ],
            [
                'potensi',
                'Dorong Ketahanan Pangan, Tim PKM Universitas Galuh Terapkan Smart Eco-Agribusiness di Desa Jalatrang',
                '6a7c2a4c61e20_1786522188.jpg',
                217, '2026-08-10', ['desa', 'pertanian', 'ketua'],
            ],
        ];

        foreach ($data as [$kat, $judul, $gambar, $views, $tgl, $tags]) {
            $berita = Berita::updateOrCreate(
                ['slug' => Str::slug($judul)],
                [
                    'kategori_id' => KategoriBerita::where('nama', $kat)->value('id'),
                    'judul'       => $judul,
                    'isi'         => '<p>JalatrangNews; '.$judul.'.</p>',
                    'gambar'      => $gambar,
                    'views'       => $views,
                    'status'      => 'published',
                    'tanggal'     => $tgl.' 08:00:00',
                ]
            );

            $tagIds = collect($tags)->map(
                fn ($t) => Tag::firstOrCreate(['slug' => Str::slug($t)], ['nama' => $t])->id
            );
            $berita->tags()->sync($tagIds);
        }
    }
}