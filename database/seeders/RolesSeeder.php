<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Roles
        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);

        // Create Permissions
        $manageFilament = Permission::create(['name' => 'manage filament']);

        $adminRole->givePermissionTo($manageFilament);
        $admin = User::where('email','omar@test.com')->first();
        $admin->assignRole($adminRole);

       $user = User::find(3);
        $user->assignRole($userRole);

    }
}
