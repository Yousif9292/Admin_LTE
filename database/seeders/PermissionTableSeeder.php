<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\PermissionGroup;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $permissionGroups = [
            'User Permissions',
            'Role Permissions',
            'Product Permissions',
        ];

        foreach ($permissionGroups as $group) {
            $permissionGroup = PermissionGroup::create(['name' => $group]);

            switch ($group) {
                case 'User Permissions':
                    $userPermissions = [
                        'view-users',
                        'create-users',
                        'edit-users',
                        'destroy-users',
                    ];
                    $this->createPermissions($userPermissions, $permissionGroup);
                    break;
                case 'Role Permissions':
                    $rolePermissions = [
                        'view-role',
                        'role-create',
                        'role-edit',
                        'role-delete',
                    ];
                    $this->createPermissions($rolePermissions, $permissionGroup);
                    break;
                case 'Product Permissions':
                    $productPermissions = [
                        'view-product',
                        'product-create',
                        'product-edit',
                        'product-delete',
                    ];
                    $this->createPermissions($productPermissions, $permissionGroup);
                    break;
                    // Add more cases for additional permission groups as needed
            }
        }
    }

    private function createPermissions(array $permissions, PermissionGroup $permissionGroup)
    {
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'permission_group_id' => $permissionGroup->id,
            ]);
        }
    }

    // public function run()
    // {
    //     $permissions = [
    //         'view-users',
    //         'create-users',
    //         'edit-users',
    //         'destroy-users',

    //         'view-role',
    //         'role-create',
    //         'role-edit',
    //         'role-delete',
    //         'view-product',
    //         'product-create',
    //         'product-edit',
    //         'product-delete',

    //      ];

    //      foreach ($permissions as $permission) {
    //           Permission::create(['name' => $permission]);
    //      }

    // }
}
