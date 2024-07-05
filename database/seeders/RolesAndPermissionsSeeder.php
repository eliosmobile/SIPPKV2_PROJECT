<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Membuat permissions
        Permission::create(['name' => 'home']);
        Permission::create(['name' => 'jadwal']);
        Permission::create(['name' => 'request room']);
        Permission::create(['name' => 'manage rooms']);
        Permission::create(['name' => 'manage facilities']);
        Permission::create(['name' => 'manage users']);

        // Membuat roles dan memberikan permissions
        $role = Role::create(['name' => 'mahasiswa']);
        $role = Role::create(['name' => 'admin ruangan']);
        $role->givePermissionTo('manage rooms');

        $role = Role::create(['name' => 'admin fasilitas']);
        $role->givePermissionTo('manage facilities');

        $role = Role::create(['name' => 'wadir']);
        $role = Role::create(['name' => 'direktur']);
        
        $role = Role::create(['name' => 'super admin']);
        $role->givePermissionTo(Permission::all());
    }
}
