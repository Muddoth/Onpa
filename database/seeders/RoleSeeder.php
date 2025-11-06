<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // 1️⃣ Define all permissions
        $permissions = [
            'view songs',
            'create songs',
            'edit songs',
            'delete songs',

        ];

        // 2️⃣ Create permissions if they don't exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // 3️⃣ Create roles
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $artist = Role::firstOrCreate(['name' => 'artist', 'guard_name' => 'web']);
        $listener = Role::firstOrCreate(['name' => 'listener', 'guard_name' => 'web']);

        // 4️⃣ Assign permissions to roles
        $admin->givePermissionTo(Permission::all()); // Admin gets all permissions
        $artist->givePermissionTo(['view songs', 'create songs', 'edit songs', 'delete songs']);//Constraints begins at policy
        $listener->givePermissionTo(['view songs']);


    }
}
