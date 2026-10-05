<?php

// Menu navbar utama. 'url' relatif terhadap root situs (dipakai url() & request()->is()).
return [
    ['label' => 'Profil', 'children' => [
        ['label' => 'VISI',       'url' => 'profil/visi'],
        ['label' => 'MISI',       'url' => 'profil/misi'],
        ['label' => 'Sejarah',    'url' => 'profil/sejarah'],
        ['label' => 'Struktural', 'url' => 'struktural'],
    ]],
    ['label' => 'Kependudukan',   'url' => 'data'],
    ['label' => 'Berita',         'url' => 'berita'],
    ['label' => 'Potensi Wisata', 'url' => 'potensi-wisata'],
    ['label' => 'IDM & SDGs', 'children' => [
        ['label' => 'IDM',  'url' => 'idm-score'],
        ['label' => 'SDGs', 'url' => 'sdgs-score'],
    ]],
    ['label' => 'Ketahanan Pangan', 'children' => [
        ['label' => 'Statistik', 'url' => 'ketahanan-pangan'],
        ['label' => 'Galeri',    'url' => 'galeri-ketahanan-pangan'],
        ['label' => 'Top 10',    'url' => 'scoring-ketahanan-pangan'],
    ]],
    ['label' => 'Keuangan', 'children' => [
        ['label' => 'APBdes',   'url' => 'laporan-apbdes'],
        ['label' => 'PBB',      'url' => 'pbb'],
        ['label' => 'Kegiatan', 'url' => 'kegiatan'],
    ]],
    ['label' => 'Download', 'children' => [
        ['label' => 'Regulasi', 'url' => 'produk-hukum'],
        ['label' => 'Materi',   'url' => 'materi-file'],
    ]],
];
