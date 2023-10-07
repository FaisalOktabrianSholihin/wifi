<?php

namespace App\Http\Controllers;

use App\Models\Pemasangan;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PemasanganController extends Controller
{
    public function index()
    {
        $pemasangan = Pemasangan::orderByDesc('id')->get();
        $users = User::role('sales')->get();
        return view('pemasangan.index', compact('pemasangan', 'users'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = [];
        if (auth()->user()->hasRole('admin')) {
            $validatedData = $request->validate([
                'no_pendaftaran' => 'required|unique:pemasangan,no_pendaftaran',
                'nik' => 'required|max:16',
                'nama' => 'required',
                'alamat' => 'required',
                'telepon' => 'required',
            ]);
        } elseif (auth()->user()->hasRole('sales')){
            $validatedData = $request->validate([
                'no_pendaftaran' => 'required|unique:pemasangan,no_pendaftaran',
                'nik' => 'required|max:16',
                'nama' => 'required',
                'alamat' => 'required',
                'telepon' => 'required',
                
            ]);
            $validatedData['user_survey'] = auth()->user()->name;
        }

        // Add status_survey to the validated data
        $validatedData['status_survey'] = 'Belum Survey';
        // Create a new Pemasangan record
        Pemasangan::create($validatedData);

        return redirect()->route('route.pemasangans.index')->with('message', 'Data berhasil disimpan.');
    }


    public function update(Request $request, $id)
    {
        // Validate the request data
        // dump($request->all());
        $pemasangan = Pemasangan::findOrFail($id);

        $validatedData = [];

        if (auth()->user()->hasRole('admin')) {
            $validatedData = $request->validate([
                'nama' => 'required',
                'nik' => 'required|max:16',
                'alamat' => 'required',
                'user_survey' => 'required',
                'telepon' => 'required',
            ]);
        } elseif (auth()->user()->hasRole('sales')) {
            $validatedData = $request->validate([
                'status_survey' => 'required',
                'keterangan' => 'nullable',
            ]);
        }


        // Update the record with the validated data
        $pemasangan->update($validatedData);

        return redirect()->route('route.pemasangans.index')->with('message', 'Data berhasil diupdate.');
    }



    public function destroy($id)
    {
        $pemasangans = Pemasangan::findOrFail($id);
        $pemasangans->delete();

        return back()->with('message', 'Data berhasil di hapus');
    }
}