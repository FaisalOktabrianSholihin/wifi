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
        $route = User::create([
            'email' => 'route@gmail.com',
            'name' => 'route',
            'email_verified_at' => now(),
            'password' => bcrypt('route'),
            'remember_token' => Str::random(10),
        ]);
        $admin = User::create([
            'email' => 'admin@gmail.com',
            'name' => 'admin',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ]);
        $teknisi = User::create([
            'email' => 'teknisi@gmail.com',
            'name' => 'teknisi',
            'email_verified_at' => now(),
            'password' => bcrypt('teknisi'),
            'remember_token' => Str::random(10),
        ]);
        $sales = User::create([
            'email' => 'sales@gmail.com',
            'name' => 'sales',
            'email_verified_at' => now(),
            'password' => bcrypt('sales'),
            'remember_token' => Str::random(10),
        ]);

        $role_route = Role::create(['name' => 'route']);
        $role_admin = Role::create(['name' => 'admin']);
        $role_teknisi = Role::create(['name' => 'teknisi']);
        $role_sales = Role::create(['name' => 'sales']);

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

        $permission = Permission::create(['name' => 'create pendaftaran']);
        $permission = Permission::create(['name' => 'read pendaftaran']);
        $permission = Permission::create(['name' => 'update pendaftaran']);
        $permission = Permission::create(['name' => 'delete pendaftaran']);

        $route->assignRole('route');
        $admin->assignRole('admin');
        $teknisi->assignRole('teknisi');
        $sales->assignRole('sales');

        $role_route->givePermissionTo('create role');
        $role_route->givePermissionTo('read role');
        $role_route->givePermissionTo('update role');
        $role_route->givePermissionTo('delete role');

        $role_route->givePermissionTo('create user');
        $role_route->givePermissionTo('read user');
        $role_route->givePermissionTo('update user');
        $role_route->givePermissionTo('delete user');

        $role_route->givePermissionTo('create billing');
        $role_route->givePermissionTo('read billing');
        $role_route->givePermissionTo('update billing');
        $role_route->givePermissionTo('delete billing');

        $role_route->givePermissionTo('create permission');
        $role_route->givePermissionTo('read permission');
        $role_route->givePermissionTo('update permission');
        $role_route->givePermissionTo('delete permission');

        $role_route->givePermissionTo('create pendaftaran');
        $role_route->givePermissionTo('read pendaftaran');
        $role_route->givePermissionTo('update pendaftaran');
        $role_route->givePermissionTo('delete pendaftaran');
    }
}
