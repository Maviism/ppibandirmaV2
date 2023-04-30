<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin cihuy',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Akastrat',
                'email' => 'akastrat@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'akastrat',
            ],
            [
                'name' => 'Adminkeu',
                'email' => 'adminkeu@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'adminkeu',
            ],
            [
                'name' => 'User biasa ',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
        ]);
    }
}
