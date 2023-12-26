<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\UbahPaket;
use Illuminate\Http\Request;

class IkiPelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::with(['pemasangan', 'paket'])->orderByDesc('id')->get();
        $pakets = Paket::all();
        return view('ikipelanggan.index', compact('pelanggan', 'pakets'));
    }

    public function store(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelangganId = $pelanggan->id;

        $validatedData = $request->validate([
            'no_pelanggan' => 'required',
            'paket_lama' => 'required',
            'paket_baru_id' => 'required',
        ]);

        $ubahPaket = UbahPaket::create($validatedData);
        // $paketBaru = $request->input('paket_baru');
        // $paketBaruId = Paket::where('paket', $paketBaru)->first();
        // if (!$paketBaruId) {
        //     return redirect()->back()->with('error', 'Paket baru tidak ditemukan.');
        // }
        $paketId = $validatedData['paket_baru_id'];
        Pelanggan::where('id', $pelangganId)->update(['paket_id' => $paketId]);

        return redirect()->route('route.ikipelanggans.index')->with('message', 'Data berhasil disimpan.');
    }
}
