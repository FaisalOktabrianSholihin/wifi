<?php

namespace App\Http\Controllers;

use App\Models\Odc;
use App\Models\Odp;
use App\Models\OdpPort;
use Illuminate\Http\Request;

class OdpPortController extends Controller
{
    public function index()
    {
        $port = OdpPort::with('odp')->orderByDesc('id')->get();
        $odc = Odc::all();
        $odp = Odp::all();
        return view('odp_port.index', compact('port', 'odc', 'odp'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'odp_id' => 'required',
            'odp_port' => 'required',
        ]);
        OdpPort::create($validated);
        return redirect()->back()->with('message', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        try {
            $odp = OdpPort::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }
        $validated = $request->validate([
            'odp_id' => 'required',
            'odp_port' => 'required',
        ]);
        $odp->update($validated);
        return redirect()->back()->with('message', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $odps = OdpPort::findOrFail($id);
        $odps->delete();

        return back()->with('message', 'Data Berhasil Dihapus');
    }
}
