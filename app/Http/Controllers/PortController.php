<?php

namespace App\Http\Controllers;

use App\Models\Port;
use Illuminate\Http\Request;

class PortController extends Controller
{
    public function index()
    {
        $port = Port::with('pelanggan')->orderByDesc('id')->get();

        return view('port.index', compact('port'));
    }

    public function getData()
    {
        $port = Port::with('pelanggan')->orderByDesc('id')->get();
        $portData = $port->map(function ($port, $index) {
            return [
                "id" => $port->id,
                "No" => $index + 1,
                "Slot" => $port->slot,
                "Port" => $port->port,
                "IndexInc" => $port->index_inc,
                "NoPelanggan" => $port->pelanggan ? $port->pelanggan->no_pelanggan : "",
            ];
        });
        return response()->json($portData);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'slot' => 'required|in:1,2',
            'port' => 'required|integer|between:1,16',
            'index_inc' => 'required|integer|between:1,128'
        ], [
            'slot.in' => 'Slot harus berisi nilai 1 atau 2.',
            'port.between' => 'Port harus berisi nilai antara 1 dan 16.',
            'index_inc.between' => 'Index Inc harus berisi nilai antara 1 dan 128.'
        ]);

        Port::create($validatedData);

        return redirect()->back()->with('message', 'Data berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        try {
            $port = Port::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }

        $validated = $request->validate([
            'slot' => 'required|in:1,2',
            'port' => 'required|integer|between:1,16',
            'index_inc' => 'required|integer|between:1,128',
        ], [
            'slot.in' => 'Slot harus berisi nilai 1 atau 2.',
            'port.between' => 'Port harus berisi nilai antara 1 dan 16.',
            'index_inc.between' => 'Index Inc harus berisi nilai antara 1 dan 128.'
        ]);

        $port->update($validated);
        return redirect()->back()->with('message', 'Data Berhasil Diupdate');
    }


    public function destroy($id)
    {
        $port = Port::findOrFail($id);
        $port->delete();

        return redirect()->back()->with('message', 'Data Berhasil Dihapus');
    }
}
