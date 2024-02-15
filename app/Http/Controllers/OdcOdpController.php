<?php

namespace App\Http\Controllers;

use App\Models\Odc;
use Illuminate\Http\Request;

class OdcOdpController extends Controller
{
    public function index()
    {
        $odc = Odc::orderByDesc('id')->get();
        return view('odc.index', compact('odc'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'odc' => 'required',
            'kode_odc' => 'required',
            'vlan' => 'required',
            'ket_odc' => 'required',
        ]);
        Odc::create($validated);
        return redirect()->back()->with('message', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        try {
            $odc = Odc::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }
        $validated = $request->validate([
            'odc' => 'required',
            'kode_odc' => 'required',
            'vlan' => 'required',
            'ket_odc' => 'required',
        ]);
        $odc->update($validated);
        return redirect()->back()->with('message', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $odcs = Odc::findOrFail($id);
        $odcs->delete();

        return back()->with('message', 'Data Berhasil Dihapus');
    }
}
