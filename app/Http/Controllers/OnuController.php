<?php

namespace App\Http\Controllers;

use App\Models\MerkOnu;
use App\Models\Onu;
use App\Models\TypeOnu;
use Illuminate\Http\Request;

class OnuController extends Controller
{
    public function index()
    {
        $onu = Onu::with(['merk_onu', 'type_onu', 'pelanggan'])->orderByDesc('id')->get();
        $merk = MerkOnu::all();
        $type = TypeOnu::all();

        return view('onu.index', compact('onu', 'merk', 'type'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sn_onu' => 'required|max:12',
            'merk_onu_id' => 'required',
            'type_onu_id' => 'required'
        ]);

        Onu::create($validatedData);

        return redirect()->back()->with('message', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        try {
            $onu = Onu::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }
        $validated = $request->validate([
            'sn_onu' => 'required',
            'merk_onu_id' => 'required',
            'type_onu_id' => 'required',
        ]);
        $onu->update($validated);
        return redirect()->back()->with('message', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $onu = Onu::findOrFail($id);
        $onu->delete();

        return redirect()->back()->with('message', 'Data Berhasil Dihapus');
    }
}
