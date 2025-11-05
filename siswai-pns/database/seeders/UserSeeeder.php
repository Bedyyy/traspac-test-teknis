<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'role' => 'admin',
            'status' => 'active'
        ]);
        User::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => 'staff123',
            'role' => 'staff',
            'status' => 'active'
        ]);
        User::create([
            'name' => 'guest',
            'email' => 'guest@gmail.com',
            'password' => 'guest123',
            'role' => 'guest',
            'status' => 'active'
        ]);
    }
}
