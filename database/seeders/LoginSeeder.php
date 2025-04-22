<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('admin123'),
        //     'role' => 'admin',
        // ]);

        // User::create([
        //     'name' => 'Petugas',
        //     'email' => 'petugas@gmail.com',
        //     'password' => Hash::make('petugas123'),
        //     'role' => 'petugas',
        // ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin7@gmail.com',
            'password' => Hash::make('admin2223'),
            'role' => 'admin',
        ]);
    }
}


