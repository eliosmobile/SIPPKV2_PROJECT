<?php
// File: database/seeders/UsersTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Membuat akun untuk setiap peran
        $users = [
            [
                'name' => 'Mahasiswa',
                'email' => 'mahasiswa@example.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
            ],
            [
                'name' => 'Admin Fasilitas',
                'email' => 'adminfasilitas@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin fasilitas',
            ],
            [
                'name' => 'Admin Ruangan',
                'email' => 'adminruangan@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin ruangan',
            ],
            [
                'name' => 'Wadir',
                'email' => 'wadir@example.com',
                'password' => Hash::make('password'),
                'role' => 'wadir',
            ],
            [
                'name' => 'Direktur',
                'email' => 'direktur@example.com',
                'password' => Hash::make('password'),
                'role' => 'direktur',
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password'),
                'role' => 'super admin',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
            ]);

            $role = Role::where('name', $userData['role'])->first();
            if ($role) {
                $user->assignRole($role);
            }
        }
    }
}
