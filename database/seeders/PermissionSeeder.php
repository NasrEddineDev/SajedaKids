<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('permissions')->insert([
            // user permissions
            [
                'name' => 'create-user',
                'description' => '',
                'group' => 'user',
            ], [
                'name' => 'view-user',
                'description' => '',
                'group' => 'user',
            ], [
                'name' => 'list-users',
                'description' => '',
                'group' => 'user',
            ], [
                'name' => 'update-user',
                'description' => '',
                'group' => 'user',
            ], [
                'name' => 'delete-user',
                'description' => '',
                'group' => 'user',
            ],
            // role permissions
            [
                'name' => 'create-role',
                'description' => '',
                'group' => 'role',
            ], [
                'name' => 'view-role',
                'description' => '',
                'group' => 'role',
            ], [
                'name' => 'list-roles',
                'description' => '',
                'group' => 'role',
            ], [
                'name' => 'update-role',
                'description' => '',
                'group' => 'role',
            ], [
                'name' => 'delete-role',
                'description' => '',
                'group' => 'role',
            ],
            // permission permissions
            [
                'name' => 'create-permission',
                'description' => '',
                'group' => 'permission',
            ], [
                'name' => 'view-permission',
                'description' => '',
                'group' => 'permission',
            ], [
                'name' => 'list-permissions',
                'description' => '',
                'group' => 'permission',
            ], [
                'name' => 'update-permission',
                'description' => '',
                'group' => 'permission',
            ], [
                'name' => 'delete-permission',
                'description' => '',
                'group' => 'permission',
            ],
            // product permissions
            [
                'name' => 'create-product',
                'description' => '',
                'group' => 'product',
            ], [
                'name' => 'view-product',
                'description' => '',
                'group' => 'product',
            ], [
                'name' => 'list-products',
                'description' => '',
                'group' => 'product',
            ], [
                'name' => 'update-product',
                'description' => '',
                'group' => 'product',
            ], [
                'name' => 'delete-product',
                'description' => '',
                'group' => 'product',
            ], [
                'name' => 'company-product',
                'description' => '',
                'group' => 'product',
            ],
            // customer permissions
            [
                'name' => 'create-customer',
                'description' => '',
                'group' => 'customer',
            ], [
                'name' => 'view-customer',
                'description' => '',
                'group' => 'customer',
            ], [
                'name' => 'list-customers',
                'description' => '',
                'group' => 'customer',
            ], [
                'name' => 'update-customer',
                'description' => '',
                'group' => 'customer',
            ], [
                'name' => 'delete-customer',
                'description' => '',
                'group' => 'customer',
            ], [
                'name' => 'filter-country-customer',
                'description' => '',
                'group' => 'customer',
            ], [
                'name' => 'company-customer',
                'description' => '',
                'group' => 'customer',
            ],
            // company permissions
            [
                'name' => 'create-company',
                'description' => '',
                'group' => 'company',
            ], [
                'name' => 'view-company',
                'description' => '',
                'group' => 'company',
            ], [
                'name' => 'list-companys',
                'description' => '',
                'group' => 'company',
            ], [
                'name' => 'update-company',
                'description' => '',
                'group' => 'company',
            ], [
                'name' => 'delete-company',
                'description' => '',
                'group' => 'company',
            ], [
                'name' => 'filter-type-company',
                'description' => '',
                'group' => 'company',
            ],
            // setting permissions
            [
                'name' => 'create-setting',
                'description' => '',
                'group' => 'setting',
            ], [
                'name' => 'view-setting',
                'description' => '',
                'group' => 'setting',
            ], [
                'name' => 'list-settings',
                'description' => '',
                'group' => 'setting',
            ], [
                'name' => 'update-setting',
                'description' => '',
                'group' => 'setting',
            ], [
                'name' => 'delete-setting',
                'description' => '',
                'group' => 'setting',
            ],
            // country permissions
            [
                'name' => 'create-country',
                'description' => '',
                'group' => 'country',
            ], [
                'name' => 'view-country',
                'description' => '',
                'group' => 'country',
            ], [
                'name' => 'list-countries',
                'description' => '',
                'group' => 'country',
            ], [
                'name' => 'update-country',
                'description' => '',
                'group' => 'country',
            ], [
                'name' => 'delete-country',
                'description' => '',
                'group' => 'country',
            ],
            // state permissions
            [
                'name' => 'create-state',
                'description' => '',
                'group' => 'state',
            ], [
                'name' => 'view-state',
                'description' => '',
                'group' => 'state',
            ], [
                'name' => 'list-states',
                'description' => '',
                'group' => 'state',
            ], [
                'name' => 'update-state',
                'description' => '',
                'group' => 'state',
            ], [
                'name' => 'delete-state',
                'description' => '',
                'group' => 'state',
            ],
            // city permissions
            [
                'name' => 'create-city',
                'description' => '',
                'group' => 'city',
            ], [
                'name' => 'view-city',
                'description' => '',
                'group' => 'city',
            ], [
                'name' => 'list-cities',
                'description' => '',
                'group' => 'city',
            ], [
                'name' => 'update-city',
                'description' => '',
                'group' => 'city',
            ], [
                'name' => 'delete-city',
                'description' => '',
                'group' => 'city',
            ],
            // logger permissions
            [
                'name' => 'create-logger',
                'description' => '',
                'group' => 'logger',
            ], [
                'name' => 'view-logger',
                'description' => '',
                'group' => 'logger',
            ], [
                'name' => 'list-loggers',
                'description' => '',
                'group' => 'logger',
            ], [
                'name' => 'update-logger',
                'description' => '',
                'group' => 'logger',
            ], [
                'name' => 'delete-logger',
                'description' => '',
                'group' => 'logger',
            ],
            // dashboard permissions
            [
                'name' => 'create-dashboard',
                'description' => '',
                'group' => 'dashboard',
            ], [
                'name' => 'view-dashboard',
                'description' => '',
                'group' => 'dashboard',
            ], [
                'name' => 'list-dashboards',
                'description' => '',
                'group' => 'dashboard',
            ], [
                'name' => 'update-dashboard',
                'description' => '',
                'group' => 'dashboard',
            ], [
                'name' => 'delete-dashboard',
                'description' => '',
                'group' => 'dashboard',
            ]

        ]);

        // Admin Permissions
        $role = Role::where('name', '=', "admin")->first();
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            if($permission) $role->givePermissionTo($permission);
        }

        // Agent Permissions
        $role = Role::where('name', '=', "admin_company")->first();
        $role->givePermissionTo(Permission::where('name', '=', "view-dashboard")->first());
        $role->givePermissionTo(Permission::where('name', '=', "list-dashboards")->first());
        $role->givePermissionTo(Permission::where('name', '=', "update-dashboard")->first());
        $role->givePermissionTo(Permission::where('name', '=', "delete-dashboard")->first());
        $role->givePermissionTo(Permission::where('name', '=', "view-product")->first());
        $role->givePermissionTo(Permission::where('name', '=', "list-products")->first());
        $role->givePermissionTo(Permission::where('name', '=', "update-product")->first());
        $role->givePermissionTo(Permission::where('name', '=', "delete-product")->first());
        $role->givePermissionTo(Permission::where('name', '=', "view-customer")->first());
        $role->givePermissionTo(Permission::where('name', '=', "list-customers")->first());
        $role->givePermissionTo(Permission::where('name', '=', "update-customer")->first());
        $role->givePermissionTo(Permission::where('name', '=', "delete-customer")->first());
        $role->givePermissionTo(Permission::where('name', '=', "view-company")->first());
        $role->givePermissionTo(Permission::where('name', '=', "list-companys")->first());
        $role->givePermissionTo(Permission::where('name', '=', "update-company")->first());
        $role->givePermissionTo(Permission::where('name', '=', "delete-company")->first());

                // Agent Permissions
                $role = Role::where('name', '=', "seller_company")->first();
                $role->givePermissionTo(Permission::where('name', '=', "view-dashboard")->first());
                $role->givePermissionTo(Permission::where('name', '=', "list-dashboards")->first());
                $role->givePermissionTo(Permission::where('name', '=', "update-dashboard")->first());
                $role->givePermissionTo(Permission::where('name', '=', "delete-dashboard")->first());
                $role->givePermissionTo(Permission::where('name', '=', "view-product")->first());
                $role->givePermissionTo(Permission::where('name', '=', "list-products")->first());
                $role->givePermissionTo(Permission::where('name', '=', "update-product")->first());
                $role->givePermissionTo(Permission::where('name', '=', "delete-product")->first());
                $role->givePermissionTo(Permission::where('name', '=', "view-customer")->first());
                $role->givePermissionTo(Permission::where('name', '=', "list-customers")->first());
                $role->givePermissionTo(Permission::where('name', '=', "update-customer")->first());
                $role->givePermissionTo(Permission::where('name', '=', "delete-customer")->first());
                $role->givePermissionTo(Permission::where('name', '=', "view-company")->first());
                $role->givePermissionTo(Permission::where('name', '=', "list-companys")->first());
                $role->givePermissionTo(Permission::where('name', '=', "update-company")->first());
                $role->givePermissionTo(Permission::where('name', '=', "delete-company")->first());
    }
}
