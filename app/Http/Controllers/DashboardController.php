<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $roles = Role::count();
        $permissions = Permission::count();

        return view('dashboard', compact('users', 'roles', 'permissions'));
    }
}
