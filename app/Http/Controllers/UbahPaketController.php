<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\UbahPaket;
use App\Models\User;

class UbahPaketController extends Controller
{
    public function index()
    {
        $ubahpaket = UbahPaket::with('pelanggan')->orderByDesc('id')->get();
        $teknisi = User::role('teknisi')->get();
        return view('ubah_paket.index', compact('ubahpaket', 'teknisi'));
    }

    public function updateTeknisi(Request $request, $id)
    {
        $ubahpaket = UbahPaket::findOrFail($id);

        $validatedData = $request->validate([
            'user_action' => 'required',
        ]);
        $ubahpaket->update($validatedData);
        return redirect()->route('route.ubah_pakets.index')->with('message', 'Data berhasil diupdate.');

    }
}
