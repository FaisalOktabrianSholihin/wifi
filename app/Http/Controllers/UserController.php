<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function user()
    {
        $user = User::orderByDesc('id')->get();
        $role = Role::all();
        return view('dataMaster.user', compact('user', 'role'));
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'role' => ['required', 'exists:roles,name'], // Validasi peran
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_verified_at' => now(),
            'password' => bcrypt($validated['password']),
            'remember_token' => Str::random(10),
        ]);

        $role = Role::where('name', $validated['role'])->first();
        if ($role) {
            $user->assignRole($role);
        }

        return redirect()->route('dataMaster')->with('message', 'Add User Successfully');
    }


    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi data yang dikirim dari form edit
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => ['required'],
            'password' => ['required']
        ]);

        // Update data pengguna dengan data yang baru
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // Berikan peran baru kepada pengguna
        $role = Role::where('name', $validatedData['role'])->first();
        if ($role) {
            $user->syncRoles([$role]);
        }

        // Update password jika ada perubahan
        if ($validatedData['password']) {
            $user->update(['password' => bcrypt($validatedData['password'])]);
        }

        // Jika berhasil diubah, arahkan kembali ke halaman tampilan data atau halaman lain yang sesuai
        return redirect()->route('dataMaster')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $user = User::findorfail($id);
        $user->delete();
        return back();
    }
}
