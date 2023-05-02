<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserInformation\Education;
use App\Models\UserInformation\PersonalInformation;
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

        Education::insert([
            [
                'user_id' => 1,
                'university' => 'Bandirma on yedi eylul',
                'faculty' => 'IIBF',
                'department' => 'Iktisad',
                'arrival_year' => '2019',
                'status' => 'kuliah',
                'type_of_education' => 's1'
            ],
            [
                'user_id' => 2,
                'university' => 'Bandirma on yedi eylul',
                'faculty' => 'Muhendislik',
                'department' => 'Elektro',
                'arrival_year' => '2020',
                'status' => 'kuliah',
                'type_of_education' => 's1'
            ],
            [
                'user_id' => 3,
                'university' => 'Bandirma on yedi eylul',
                'faculty' => 'Muhendislik',
                'department' => 'Bilgisayar',
                'arrival_year' => '2020',
                'status' => 'kuliah',
                'type_of_education' => 's1'
            ],
            [
                'user_id' => 4,
                'university' => 'Bandirma on yedi eylul',
                'faculty' => 'Muhendislik',
                'department' => 'Elektro',
                'arrival_year' => '2020',
                'status' => 'lulus',
                'type_of_education' => 's2'
            ],
            
        ]);
    }
}
