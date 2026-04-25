<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Laporan Pidana',
            'Laporan Perdata',
            'Laporan TUN',
            'Laporan Penyuluhan Hukum',
            'Laporan Konsultasi Hukum',
            'Laporan Investigasi Kasus',
            'Laporan Penelitian Hukum',
            'Laporan Mediasi',
            'Laporan Negosiasi',
            'Laporan Pemberdayaan Masyarakat',
            'Laporan Pendampingan di Luar Pengadilan',
            'Laporan Drafting Dokumen Hukum'
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create(['name' => $category]);
        }
    }
}
