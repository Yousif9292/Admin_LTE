<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $adminRole = Role::create(['name' => 'Admin','deleteable' => 0]);
        $permissions = Permission::pluck('id', 'id')->all();
        $adminRole->syncPermissions($permissions);
        $admin->assignRole([$adminRole->id]);

        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),

        ]);

        $userRole = Role::create(['name' => 'User','deleteable' => 0]);
        $userPermission = Permission::where('name', 'view-role')->first();
        $userRole->givePermissionTo($userPermission);
        $user->assignRole([$userRole->id]);


    }

}
