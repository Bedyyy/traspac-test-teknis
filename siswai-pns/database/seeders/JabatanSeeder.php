<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jabatan::insert([
            ['nama' => 'Kepala Sekretariat Utama'],
            ['nama' => 'Penyusun laporan keuangan'],
            ['nama' => 'Surveyor Pemetaan Pertama'],
            ['nama' => 'Analis Data Survei dan Pemetaan'],
            ['nama' => 'Perancang Per-UU-an Utama'],
            ['nama' => 'Kepala Biro Perencanaan, Kepegawaian dan Hukum'],
            ['nama' => 'Widyaiswara Utama'],
            ['nama' => 'Analis Kepegawaian Madya'],
            ['nama' => 'Kepala Sub Bidang Kerjasama dan Pelayanan Riset, DKP'],
            ['nama' => 'Analis Hukum'],
            ['nama' => 'Peneliti Pertama'],
            ['nama' => 'Surveyor Pemetaan Muda'],
            ['nama' => 'Analis Jabatan'],
            ['nama' => 'Kepala Subbag Kepegawaian'],
        ]);
    }
}
