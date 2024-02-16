<?php

namespace App\Http\Controllers;

use App\Models\TypeOnu;
use Illuminate\Http\Request;

class TypeOnuController extends Controller
{
    public function index()
    {
        $to = TypeOnu::orderByDesc('id')->get();

        return view('type_onu.index', compact('to'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_onu' => 'required',
        ]);
        TypeOnu::create($validated);
        return redirect()->back()->with('message', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        try {
            $to = TypeOnu::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }
        $validated = $request->validate([
            'type_onu' => 'required',
        ]);
        $to->update($validated);
        return redirect()->back()->with('message', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $to = TypeOnu::findOrFail($id);
        $to->delete();

        return back()->with('message', 'Data Berhasil Dihapus');
    }
}
