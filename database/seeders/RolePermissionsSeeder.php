<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'email' => 'superadmin@gmail.com',
            'name' => 'superadmin',
            'email_verified_at' => now(),
            'password' => bcrypt('superadmin'),
            'remember_token' => Str::random(10),
        ]);
        $admin = User::create([
            'email' => 'admin@gmail.com',
            'name' => 'admin',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ]);
        $operator = User::create([
            'email' => 'operator@gmail.com',
            'name' => 'operator',
            'email_verified_at' => now(),
            'password' => bcrypt('operator'),
            'remember_token' => Str::random(10),
        ]);

        $role_super_admin = Role::create(['name' => 'super admin']);
        $role_admin = Role::create(['name' => 'admin']);
        $role_operator = Role::create(['name' => 'operator']);

        $permission = Permission::create(['name' => 'create role']);
        $permission = Permission::create(['name' => 'read role']);
        $permission = Permission::create(['name' => 'update role']);
        $permission = Permission::create(['name' => 'delete role']);

        $permission = Permission::create(['name' => 'create user']);
        $permission = Permission::create(['name' => 'read user']);
        $permission = Permission::create(['name' => 'update user']);
        $permission = Permission::create(['name' => 'delete user']);

        $permission = Permission::create(['name' => 'create billing']);
        $permission = Permission::create(['name' => 'read billing']);
        $permission = Permission::create(['name' => 'update billing']);
        $permission = Permission::create(['name' => 'delete billing']);

        $permission = Permission::create(['name' => 'create permission']);
        $permission = Permission::create(['name' => 'read permission']);
        $permission = Permission::create(['name' => 'update permission']);
        $permission = Permission::create(['name' => 'delete permission']);

        $permission = Permission::create(['name' => 'create file manager']);
        $permission = Permission::create(['name' => 'read file manager']);
        $permission = Permission::create(['name' => 'update file manager']);
        $permission = Permission::create(['name' => 'delete file manager']);

        $permission = Permission::create(['name' => 'create module']);
        $permission = Permission::create(['name' => 'read module']);
        $permission = Permission::create(['name' => 'update module']);
        $permission = Permission::create(['name' => 'delete module']);

        $superadmin->assignRole('super admin');
        $admin->assignRole('admin');
        $operator->assignRole('operator');

        $role_super_admin->givePermissionTo('create role');
        $role_super_admin->givePermissionTo('read role');
        $role_super_admin->givePermissionTo('update role');
        $role_super_admin->givePermissionTo('delete role');

        $role_super_admin->givePermissionTo('create user');
        $role_super_admin->givePermissionTo('read user');
        $role_super_admin->givePermissionTo('update user');
        $role_super_admin->givePermissionTo('delete user');

        $role_super_admin->givePermissionTo('create billing');
        $role_super_admin->givePermissionTo('read billing');
        $role_super_admin->givePermissionTo('update billing');
        $role_super_admin->givePermissionTo('delete billing');

        $role_super_admin->givePermissionTo('create permission');
        $role_super_admin->givePermissionTo('read permission');
        $role_super_admin->givePermissionTo('update permission');
        $role_super_admin->givePermissionTo('delete permission');
    }
}
