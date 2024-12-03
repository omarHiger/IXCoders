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
        $ownerRole = Role::create(['name' => 'Owner']);
        $userRole = Role::create(['name' => 'User']);

        // Create Permissions
        $manageFilament = Permission::create(['name' => 'manage filament']);
        $updateTask = Permission::create(['name' => 'update task']);
        $deleteTask = Permission::create(['name' => 'delete task']);

        $adminRole->givePermissionTo($manageFilament);
        $ownerRole->givePermissionTo([$updateTask, $deleteTask]);
        $admin = User::where('email','omar@test.com')->first();
        $admin->assignRole($adminRole);

        $owner = Task::find(2)->user()->first();
        $owner->assignRole($ownerRole);

    }
}
