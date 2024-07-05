<?php
// File: database/seeders/RolesTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Membuat roles
        $roles = [
            'mahasiswa',
            'admin fasilitas',
            'admin ruangan',
            'wadir',
            'direktur',
            'super admin',
        ];

        foreach ($roles as $roleName) {
            Role::create(['name' => $roleName]);
        }
    }
}
