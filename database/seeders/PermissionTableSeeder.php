<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',


            'view-role',
            'role-create',
            'role-edit',
            'role-delete',
            'view-product',
            'product-create',
            'product-edit',
            'product-delete',

         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }

    }
}
