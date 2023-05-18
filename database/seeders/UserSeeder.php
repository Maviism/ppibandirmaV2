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
                'name' => 'Media kreatif',
                'email' => 'medkraf@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'medkraf',
            ],
            [
                'name' => 'User biasa ',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
        ]);

        PersonalInformation::insert([
            [
                'user_id' => 1,
                'phone_number' => '905525911215',
                'address_tr' => 'Urun evler mahallesi',
                'birthday' => '04/12',
                'gender' => 'Laki-laki'
            ],
            [
                'user_id' => 2,
                'phone_number' => '62815911215',
                'address_tr' => '17 eylul mahallesi',
                'birthday' => '01/04',
                'gender' => 'Perempuan'
            ],
            [
                'user_id' => 3,
                'phone_number' => '905526181215',
                'address_tr' => 'Haci yusuf mahallesi',
                'birthday' => '03/08',
                'gender' => 'Laki-laki'
            ],
            [
                'user_id' => 4,
                'phone_number' => '90552618198',
                'address_tr' => 'Haci yusuf mahallesi',
                'birthday' => '05/08',
                'gender' => 'Laki-laki'
            ],
            [
                'user_id' => 5,
                'phone_number' => '905525918425',
                'address_tr' => 'Levent mahallesi',
                'birthday' => '02/10',
                'gender' => 'Laki-laki'
            ],
        ]);

        Education::insert([
            [
                'user_id' => 1,
                'university' => 'Bandırma Onyedi Eylül Üniversitesi',
                'faculty' => 'IIBF',
                'department' => 'Iktisad',
                'arrival_year' => '2019',
                'status' => 'Kuliah',
                'type_of_education' => 'Sarjana'
            ],
            [
                'user_id' => 2,
                'university' => 'Çanakkale Onsekiz Mart Üniversitesi',
                'faculty' => 'Muhendislik',
                'department' => 'Elektro',
                'arrival_year' => '2020',
                'status' => 'Kuliah',
                'type_of_education' => 'Magister'
            ],
            [
                'user_id' => 3,
                'university' => 'Çanakkale Onsekiz Mart Üniversitesi',
                'faculty' => 'Muhendislik',
                'department' => 'Bilgisayar',
                'arrival_year' => '2020',
                'status' => 'Kuliah',
                'type_of_education' => 'Sarjana'
            ],
            [
                'user_id' => 4,
                'university' => 'Bandırma Onyedi Eylül Üniversitesi',
                'faculty' => 'Muhendislik',
                'department' => 'Elektro',
                'arrival_year' => '2020',
                'status' => 'Lulus',
                'type_of_education' => 'Doktoral'
            ],
            [
                'user_id' => 5,
                'university' => 'Bandırma Onyedi Eylül Üniversitesi',
                'faculty' => 'Muhendislik',
                'department' => 'Elektro',
                'arrival_year' => '2021',
                'status' => 'Lulus',
                'type_of_education' => 'Sarjana'
            ],
            
        ]);
    }
}
