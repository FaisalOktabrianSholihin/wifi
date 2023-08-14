<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function user()
    {
        $user = User::orderByDesc('id')->get();
        $role = Role::all();
        return view('dataMaster.user', compact('user', 'role'));
    }

    public function save(UserRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('dataMaster');
    }


    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi data yang dikirim dari form edit (jika diperlukan)
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'level' => 'required',
        ]);


        // Update data dengan data yang baru
        $user->update($validatedData);

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
