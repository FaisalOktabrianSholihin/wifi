<?php

namespace App\Http\Controllers;

use App\Models\Odc;
use App\Models\Odp;
use Illuminate\Http\Request;

class OdpController extends Controller
{
    public function index()
    {
        $odc = Odc::all();
        $odp = Odp::orderByDesc('id')->with('odc')->get();
        return view('odp.index', compact('odp', 'odc'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'odp' => 'required',
            'kode_odp' => 'required',
            'jumlah_port' => 'required',
            'odc_id' => 'required',
            'ket_odp' => 'required',
        ]);
        Odp::create($validated);
        return redirect()->back()->with('message', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        try {
            $odp = Odp::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }
        $validated = $request->validate([
            'odp' => 'required',
            'kode_odp' => 'required',
            'odc_id' => 'required',
            'jumlah_port' => 'required',
            'ket_odp' => 'required',
        ]);
        $odp->update($validated);
        return redirect()->back()->with('message', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $odps = Odp::findOrFail($id);
        $odps->delete();

        return back()->with('message', 'Data Berhasil Dihapus');
    }
}
