<?php

namespace Database\Seeders\User;

use App\Models\AlurPencairan\AlurPencairan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (App::environment('local')) {

            $user = User::create([
                'name' => "Admin",
                'username' => "admin",
                'email' => "admin@gmail.com",
                'password' => Hash::make("123"),
                'color' => '#3B82F6',
            ]);

            $user->assignRole(AlurPencairan::ROLE_SUPER_ADMIN);


            $user = User::create([
                'name' => "Pak Novi",
                'username' => "Pak Novi",
                'email' => "pak_novi@gmail.com",
                'password' => Hash::make("123"),
                'color' => '#6366F1',
            ]);

            $user->assignRole(AlurPencairan::ROLE_PAK_NOVI);

            $user = User::create([
                'name' => "supervisor",
                'username' => "supervisor",
                'email' => "supervisor@gmail.com",
                'password' => Hash::make("123"),
                'color' => '#6366F1',
            ]);

            $user->assignRole(AlurPencairan::ROLE_SUPERVISOR);


            $user = User::create([
                'name' => "Acc Exata",
                'username' => "Acc Exata",
                'email' => "acc_exata@gmail.com",
                'password' => Hash::make("123"),
                'color' => '#8B5CF6',
            ]);

            $user->assignRole(AlurPencairan::ROLE_ACC_EXATA);


            $user = User::create([
                'name' => "HS",
                'username' => "HS",
                'email' => "hs@gmail.com",
                'password' => Hash::make("123"),
                'color' => '#A855F7',
            ]);

            $user->assignRole(AlurPencairan::ROLE_HS);
            $user = User::create([
                'name' => "HS2",
                'username' => "HS2",
                'email' => "hs2@gmail.com",
                'password' => Hash::make("123"),
                'color' => '#EC4899',
            ]);

            $user->assignRole(AlurPencairan::ROLE_HS);
            $user = User::create([
                'name' => "HS3",
                'username' => "HS3",
                'email' => "hs3@gmail.com",
                'password' => Hash::make("123"),
                'color' => '#F43F5E',
            ]);

            $user->assignRole(AlurPencairan::ROLE_HS);


            $user = User::create([
                'name' => "CC",
                'username' => "CC",
                'email' => "cc@gmail.com",
                'password' => Hash::make("123"),
                'color' => '#EF4444',
            ]);

            $user->assignRole(AlurPencairan::ROLE_CC);


            $user = User::create([
                'name' => "Finance",
                'username' => "Finance",
                'email' => "finance@gmail.com",
                'password' => Hash::make("123"),
                'color' => '#F97316',
            ]);

            $user->assignRole(AlurPencairan::ROLE_FINANCE);


            $user = User::create([
                'name' => "Sales",
                'username' => "Sales",
                'email' => "sales@gmail.com",
                'password' => Hash::make("123"),
                'color' => '#FB923C',
            ]);

            $user->assignRole(AlurPencairan::ROLE_SALES);

            $user = User::create([
                'name' => "Sales2",
                'username' => "Sales2",
                'email' => "sales2@gmail.com",
                'password' => Hash::make("123"),
                'color' => '#EAB308',
            ]);

            $user->assignRole(AlurPencairan::ROLE_SALES);

            $user = User::create([
                'name' => "Sales3",
                'username' => "Sales3",
                'email' => "sales3@gmail.com",
                'password' => Hash::make("123"),
                'color' => '#64748B',
            ]);

            $user->assignRole(AlurPencairan::ROLE_SALES);
        }
        if (App::environment('production')) {

            $user = User::create([
                'name' => "Admin",
                'username' => "admin",
                'email' => "admin@gmail.com",
                'password' => Hash::make("h5qlVDPMXL9OYQ1NYl71"),
                'color' => '#000000',
            ]);

            $user->assignRole(AlurPencairan::ROLE_SUPER_ADMIN);

            $user = User::create([
                'name' => "Febtio",
                'username' => "Febtio",
                'email' => "febtio.exataindonesia2019@gmail.com",
                'password' => Hash::make("123exata"),
                'color' => '#000000',
            ]);

            $user->assignRole(AlurPencairan::ROLE_SUPERVISOR);

            // PAK NOVI
            $user = User::create([
                'name' => "Novi Prayitno",
                'username' => "Novi Prayitno",
                'email' => "snoopy.exataindonesia2018@gmail.com",
                'password' => Hash::make("123exata"),
                'color' => '#f7bb3b',
            ]);

            $user->assignRole(AlurPencairan::ROLE_PAK_NOVI);


            // ACC EXATA
            $user = User::create([
                'name' => "Nurul",
                'username' => "Nurul",
                'email' => "nurul.exataindonesia2018@gmail.com",
                'password' => Hash::make("123exata"),
                'color' => '#6366F1',
            ]);

            $user->assignRole(AlurPencairan::ROLE_ACC_EXATA);


            // HS
            $user = User::create([
                'name' => "Cynthia",
                'username' => "Cynthia",
                'email' => "amin.exataindonesia2021@gmail.com",
                'password' => Hash::make("123exata"),
                'color' => '#8B5CF6',
            ]);

            $user->assignRole(AlurPencairan::ROLE_HS);
            $user = User::create([
                'name' => "Mutia",
                'username' => "Mutia",
                'email' => "internship.exatagroup05@gmail.com",
                'password' => Hash::make("123exata"),
                'color' => '#64748B',
            ]);

            $user->assignRole(AlurPencairan::ROLE_HS);
            $user = User::create([
                'name' => "Vita",
                'username' => "Vita",
                'email' => "dira.exataindonesia2018@gmail.com",
                'password' => Hash::make("123exata"),
                'color' => '#A855F7',
            ]);

            $user->assignRole(AlurPencairan::ROLE_HS);


            // CONTENT CREATOR
            $user = User::create([
                'name' => "Teddy",
                'username' => "Teddy",
                'email' => "teddy.exata@gmail.com",
                'password' => Hash::make("123exata"),
                'color' => '#d44e91',
            ]);

            $user->assignRole(AlurPencairan::ROLE_CC);
            $user = User::create([
                'name' => "Irfan",
                'username' => "Irfan",
                'email' => "arik.exataindonesia2019@gmail.com",
                'password' => Hash::make("suksesbersamaexata1"),
                'color' => '#c87482',
            ]);

            $user->assignRole(AlurPencairan::ROLE_CC);


            // FINANCE
            $user = User::create([
                'name' => "Rina",
                'username' => "Rina",
                'email' => "rinaexataindonesia@gmail.com",
                'password' => Hash::make("123exata"),
                'color' => '#ce45e3',
            ]);

            $user->assignRole(AlurPencairan::ROLE_FINANCE);

            // SALES
            $user = User::create([
                'name' => "Mukhamad Turhamun",
                'username' => "Mukhamad Turhamun",
                'email' => "kim.exataindonesia2018@gmail.com",
                'password' => Hash::make("SuksesBersama2620"),
                'color' => '#F97316',
            ]);
            $user->assignRole(AlurPencairan::ROLE_SALES);

            $user = User::create([
                'name' => "Selamet Syafaruddin",
                'username' => "Selamet Syafaruddin",
                'email' => "eza.exataindonesia2018@gmail.com",
                'password' => Hash::make("@Sukses2026Bisa"),
                'color' => '#FB923C',
            ]);

            $user->assignRole(AlurPencairan::ROLE_SALES);
            $user = User::create([
                'name' => "Ainul",
                'username' => "Ainul",
                'email' => "ajmain.exataindonesia2018@gmail.com",
                'password' => Hash::make("@Sukses2026Bisa"),
                'color' => '#eada67',
            ]);

            $user->assignRole(AlurPencairan::ROLE_SALES);
        }
    }
}
