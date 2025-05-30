<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create permissions
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-show',
            'user-delete',
            'user-report',

            'category-list',
            'category-create',
            'category-edit',
            'category-show',
            'category-delete',
            'category-report',

            'publisher-list',
            'publisher-create',
            'publisher-edit',
            'publisher-show',
            'publisher-delete',
            'publisher-report',

            'author-list',
            'author-create',
            'author-edit',
            'author-show',
            'author-delete',
            'author-report',

            'book-list',
            'book-create',
            'book-edit',
            'book-show',
            'book-delete',
            'book-report',

            'bookloan-list',
            'bookloan-create',
            'bookloan-edit',
            'bookloan-show',
            'bookloan-delete',
            'bookloan-report',

            'dashboard-list',
            'dashboard-show',
            'dashboard-report',

            'role-list',
            'role-create',
            'role-edit',
            'role-show',
            'role-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-show',
            'permission-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'super admin']);
        $adminRole->syncPermissions($permissions);

        $userRole = Role::create(['name' => 'admin']);

        $userRole->syncPermissions([
            'user-list',
            'user-create',
            'user-edit',
            'user-show',
            'user-delete',
            'user-report',

            'category-list',
            'category-create',
            'category-edit',
            'category-show',
            'category-delete',
            'category-report',

            'publisher-list',
            'publisher-create',
            'publisher-edit',
            'publisher-show',
            'publisher-delete',
            'publisher-report',

            'author-list',
            'author-create',
            'author-edit',
            'author-show',
            'author-delete',
            'author-report',

            'book-list',
            'book-create',
            'book-edit',
            'book-show',
            'book-delete',
            'book-report',

            'bookloan-list',
            'bookloan-create',
            'bookloan-edit',
            'bookloan-show',
            'bookloan-delete',
            'bookloan-report',

            'dashboard-list',
            'dashboard-show',
            'dashboard-report',
        ]);

        // Create admin user
        $admin = User::where('email','admin@localhost.com')->first();

        $admin->assignRole('super admin');
    }
}
