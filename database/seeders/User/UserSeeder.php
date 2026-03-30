<?php

namespace Database\Seeders\User;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => "Admin",
            'username' => "admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make("h5qlVDPMXL9OYQ1NYl71"),
        ]);

        $user->assignRole('Super Admin');


        // PAK NOVI
        $user = User::create([
            'name' => "Pak Novi",
            'username' => "Pak Novi",
            'email' => "pak_novi@gmail.com",
            'password' => Hash::make("123exata"),
        ]);

        $user->assignRole('Pak Novi');


        // ACC EXATA
        $user = User::create([
            'name' => "Nurul - Acc Exata",
            'username' => "Nurul",
            'email' => "nurul.exataindonesia2018@gmail.com",
            'password' => Hash::make("123exata"),
        ]);

        $user->assignRole('Acc Exata');


        // HS
        $user = User::create([
            'name' => "HS",
            'username' => "HS",
            'email' => "hs@gmail.com",
            'password' => Hash::make("123exata"),
        ]);

        $user->assignRole('HS');


        // CONTENT CREATOR
        $user = User::create([
            'name' => "Teddy",
            'username' => "Teddy - Content Creator",
            'email' => "teddy.exata@gmail.com",
            'password' => Hash::make("123exata"),
        ]);

        $user->assignRole('CC');


        // FINANCE
        $user = User::create([
            'name' => "Rina",
            'username' => "Rina - Finance",
            'email' => "rinaexataindonesia@gmail.com",
            'password' => Hash::make("123exata"),
        ]);

        $user->assignRole('Finance');

        // SALES
        $user = User::create([
            'name' => "Mukhamad Turhamun",
            'username' => "Mukhamad Turhamun",
            'email' => "kim.exataindonesia2018@gmail.com",
            'password' => Hash::make("123exata"),
        ]);

        $user->assignRole('Sales');
    }
}
