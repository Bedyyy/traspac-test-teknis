<?php

namespace Database\Seeders;

use App\Models\Golongan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Golongan::insert([
            ['nama' => 'III/a'],
            ['nama' => 'III/b'],
            ['nama' => 'III/c'],
            ['nama' => 'III/d'],
            ['nama' => 'IV/a'],
            ['nama' => 'IV/b'],
            ['nama' => 'IV/c'],
            ['nama' => 'IV/d'],
            ['nama' => 'IV/e'],
        ]);
    }
}
