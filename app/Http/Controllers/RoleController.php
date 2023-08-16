<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::OrderByDesc('id')->with('permissions')->paginate(10);
        $permissions = Permission::all();
        return view('roles.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'guard_name' => ['required', 'in:web,api']
        ]);
        Role::create($validated);
        return redirect()->route('super admin.roles.index')->with('message', 'Role Created successfully.');
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'guard_name' => ['required', 'in:web,api'],
        ]);
        $role->update($validated);

        $role->syncPermissions($request->input('permissions', []));

        return redirect()->route('super admin.roles.index')->with('message', 'Role Updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('message', 'Role Deleted successfully');
    }

    public function givePermission(Request $request, Role $role)
    {
        if($role->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission exists.');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission not exists.');
    }

    public function syncPermissions(Request $request, Role $role)
    {
        $role->syncPermissions($request->input('permissions'));

        return back()->with('message', 'Permissions updated successfully.');
    }

}
