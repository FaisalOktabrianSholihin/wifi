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

        $permission = Permission::create(['name' => 'create paket']);
        $permission = Permission::create(['name' => 'read paket']);
        $permission = Permission::create(['name' => 'update paket']);
        $permission = Permission::create(['name' => 'delete paket']);

        $permission = Permission::create(['name' => 'create odc-odp']);
        $permission = Permission::create(['name' => 'read odc-odp']);
        $permission = Permission::create(['name' => 'update odc-odp']);
        $permission = Permission::create(['name' => 'delete odc-odp']);

        $permission = Permission::create(['name' => 'create onu']);
        $permission = Permission::create(['name' => 'read onu']);
        $permission = Permission::create(['name' => 'update onu']);
        $permission = Permission::create(['name' => 'delete onu']);

        $permission = Permission::create(['name' => 'create olt']);
        $permission = Permission::create(['name' => 'read olt']);
        $permission = Permission::create(['name' => 'update olt']);
        $permission = Permission::create(['name' => 'delete olt']);

        $permission = Permission::create(['name' => 'create routers']);
        $permission = Permission::create(['name' => 'read routers']);
        $permission = Permission::create(['name' => 'update routers']);
        $permission = Permission::create(['name' => 'delete routers']);

        $permission = Permission::create(['name' => 'create ubah paket']);
        $permission = Permission::create(['name' => 'read ubah paket']);
        $permission = Permission::create(['name' => 'update ubah paket']);
        $permission = Permission::create(['name' => 'delete ubah paket']);

        $permission = Permission::create(['name' => 'create mutasi']);
        $permission = Permission::create(['name' => 'read mutasi']);
        $permission = Permission::create(['name' => 'update mutasi']);
        $permission = Permission::create(['name' => 'delete mutasi']);

        $permission = Permission::create(['name' => 'create pemutusan']);
        $permission = Permission::create(['name' => 'read pemutusan']);
        $permission = Permission::create(['name' => 'update pemutusan']);
        $permission = Permission::create(['name' => 'delete pemutusan']);

        $permission = Permission::create(['name' => 'create perbaikan']);
        $permission = Permission::create(['name' => 'read perbaikan']);
        $permission = Permission::create(['name' => 'update perbaikan']);
        $permission = Permission::create(['name' => 'delete perbaikan']);

        $permission = Permission::create(['name' => 'create router']);
        $permission = Permission::create(['name' => 'read router']);
        $permission = Permission::create(['name' => 'update router']);
        $permission = Permission::create(['name' => 'delete router']);

        $permission = Permission::create(['name' => 'create kolektor']);
        $permission = Permission::create(['name' => 'read kolektor']);
        $permission = Permission::create(['name' => 'update kolektor']);
        $permission = Permission::create(['name' => 'delete kolektor']);

        $permission = Permission::create(['name' => 'create loket']);
        $permission = Permission::create(['name' => 'read loket']);
        $permission = Permission::create(['name' => 'update loket']);
        $permission = Permission::create(['name' => 'delete loket']);

        $permission = Permission::create(['name' => 'create pembayaran']);
        $permission = Permission::create(['name' => 'read pembayaran']);
        $permission = Permission::create(['name' => 'update pembayaran']);
        $permission = Permission::create(['name' => 'delete pembayaran']);

        $permission = Permission::create(['name' => 'create tunggakan']);
        $permission = Permission::create(['name' => 'read tunggakan']);
        $permission = Permission::create(['name' => 'update tunggakan']);
        $permission = Permission::create(['name' => 'delete tunggakan']);

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

        $role_route->givePermissionTo('create paket');
        $role_route->givePermissionTo('read paket');
        $role_route->givePermissionTo('update paket');
        $role_route->givePermissionTo('delete paket');

        $role_route->givePermissionTo('create odc-odp');
        $role_route->givePermissionTo('read odc-odp');
        $role_route->givePermissionTo('update odc-odp');
        $role_route->givePermissionTo('delete odc-odp');

        $role_route->givePermissionTo('create onu');
        $role_route->givePermissionTo('read onu');
        $role_route->givePermissionTo('update onu');
        $role_route->givePermissionTo('delete onu');

        $role_route->givePermissionTo('create olt');
        $role_route->givePermissionTo('read olt');
        $role_route->givePermissionTo('update olt');
        $role_route->givePermissionTo('delete olt');

        $role_route->givePermissionTo('create routers');
        $role_route->givePermissionTo('read routers');
        $role_route->givePermissionTo('update routers');
        $role_route->givePermissionTo('delete routers');

        $role_route->givePermissionTo('create ubah paket');
        $role_route->givePermissionTo('read ubah paket');
        $role_route->givePermissionTo('update ubah paket');
        $role_route->givePermissionTo('delete ubah paket');

        $role_route->givePermissionTo('create mutasi');
        $role_route->givePermissionTo('read mutasi');
        $role_route->givePermissionTo('update mutasi');
        $role_route->givePermissionTo('delete mutasi');

        $role_route->givePermissionTo('create pemutusan');
        $role_route->givePermissionTo('read pemutusan');
        $role_route->givePermissionTo('update pemutusan');
        $role_route->givePermissionTo('delete pemutusan');

        $role_route->givePermissionTo('create perbaikan');
        $role_route->givePermissionTo('read perbaikan');
        $role_route->givePermissionTo('update perbaikan');
        $role_route->givePermissionTo('delete perbaikan');

        $role_route->givePermissionTo('create router');
        $role_route->givePermissionTo('read router');
        $role_route->givePermissionTo('update router');
        $role_route->givePermissionTo('delete router');

        $role_route->givePermissionTo('create kolektor');
        $role_route->givePermissionTo('read kolektor');
        $role_route->givePermissionTo('update kolektor');
        $role_route->givePermissionTo('delete kolektor');

        $role_route->givePermissionTo('create loket');
        $role_route->givePermissionTo('read loket');
        $role_route->givePermissionTo('update loket');
        $role_route->givePermissionTo('delete loket');

        $role_route->givePermissionTo('create pembayaran');
        $role_route->givePermissionTo('read pembayaran');
        $role_route->givePermissionTo('update pembayaran');
        $role_route->givePermissionTo('delete pembayaran');

        $role_route->givePermissionTo('create tunggakan');
        $role_route->givePermissionTo('read tunggakan');
        $role_route->givePermissionTo('update tunggakan');
        $role_route->givePermissionTo('delete tunggakan');
    }
}
