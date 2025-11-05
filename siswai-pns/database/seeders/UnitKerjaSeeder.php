<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UnitKerja::insert([
            ['nama' => 'Sekretariat Utama', 'parent_id' => null],
            ['nama' => 'Biro Perencanaan, Kepegawaian dan Hukum', 'parent_id' => null],
            ['nama' => 'Pusat Pemetaan dan Survei', 'parent_id' => null],
            ['nama' => 'Bidang Kerjasama dan Pelayanan Riset, DKP', 'parent_id' => null],
            ['nama' => 'Pusat Pendidikan dan Pelatihan', 'parent_id' => null],
            ['nama' => 'Bagian Keuangan dan Administrasi', 'parent_id' => 1],
            ['nama' => 'Bagian Perencanaan', 'parent_id' => 2],
            ['nama' => 'Bagian Kepegawaian', 'parent_id' => 2],
            ['nama' => 'Bagian Hukum', 'parent_id' => 2],
            ['nama' => 'Sub Bidang Kerjasama dan Pelayanan Riset', 'parent_id' => 4],
            ['nama' => 'Subbag Kepegawaian', 'parent_id' => 8],
        ]);
    }
}
