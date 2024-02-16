<?php

namespace App\Http\Controllers;

use App\Models\MerkOnu;
use Illuminate\Http\Request;

class MerkOnuController extends Controller
{
    public function index()
    {
        $mo = MerkOnu::orderByDesc('id')->get();

        return view('merk_onu.index', compact('mo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'merk_onu' => 'required',
        ]);
        MerkOnu::create($validated);
        return redirect()->back()->with('message', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        try {
            $mo = MerkOnu::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }
        $validated = $request->validate([
            'merk_onu' => 'required',
        ]);
        $mo->update($validated);
        return redirect()->back()->with('message', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $mo = MerkOnu::findOrFail($id);
        $mo->delete();

        return back()->with('message', 'Data Berhasil Dihapus');
    }
}
