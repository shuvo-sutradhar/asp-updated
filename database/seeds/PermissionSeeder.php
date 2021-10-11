<?php

namespace Database\Seeders;

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            [
                'name' => 'Company Settings',
                'slug' => 'company_settings',
                'guard_name' => 'settings',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name' => 'Payment Settings',
                'slug' => 'payment_settings',
                'guard_name' => 'settings',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name' => 'Orders Settings',
                'slug' => 'orders_settings',
                'guard_name' => 'settings',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name' => 'Template settings',
                'slug' => 'template_settings',
                'guard_name' => 'settings',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name' => 'Menu settings',
                'slug' => 'menu_settings',
                'guard_name' => 'settings',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name' => 'Team View',
                'slug' => 'team_view',
                'guard_name' => 'team',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name' => 'Team create',
                'slug' => 'team_create',
                'guard_name' => 'team',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name' => 'Team Edit',
                'slug' => 'team_edit',
                'guard_name' => 'team',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name' => 'Team Delete',
                'slug' => 'team_delete',
                'guard_name' => 'team',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name' => 'Role view',
                'slug' => 'role_view',
                'guard_name' => 'role',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name' => 'Role Create',
                'slug' => 'role_create',
                'guard_name' => 'role',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name' => 'Role Edit',
                'slug' => 'role_edit',
                'guard_name' => 'role',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name' => 'Role Delete',
                'slug' => 'role_delete',
                'guard_name' => 'role',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
        ]);
    }
}
