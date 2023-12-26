<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\UbahPaket;
use App\Models\User;
use PDF;

class UbahPaketController extends Controller
{
    public function index()
    {
        $ubahpaket = UbahPaket::with(['pelanggan', 'paket'])->orderByDesc('id')->get();
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

    public function pembayaran(Request $request, $id)
    {
        $ubahpaket = UbahPaket::findOrFail($id);

        $validatedData = $request->validate([
            'tgl_action' => 'required|date',
            'biaya' => 'required',
            'diskon' => 'required',
            'bayar' => 'required',
            'lunas' => 'required',
            'keterangan' => 'nullable'
        ]);
        $ubahpaket->update($validatedData);

        return redirect()->route('route.ubah_pakets.pdf', $ubahpaket->id)->with('message', 'Data berhasil diupdate.');
    }

    public function pdf($id)
    {
        $ubahpaket = UbahPaket::with(['pelanggan', 'paket'])->find($id);

        // Check if it's a direct PDF request or after successful payment
        if ($ubahpaket->pembayaran_status == 'Lunas') {
            // Generate and download PDF
            $pdf = PDF::loadView('ubah_paket.pdf', ['ubahpaket' => $ubahpaket]);

            $pdf->setPaper(array(0, 0, 250, 500), 'portrait');
            $filename = $ubahpaket->no_pelanggan . '_' . $ubahpaket->pelanggan->nama . '.pdf';

            return $pdf->download($filename);
        } else {

            return view('ubah_paket.pdf', ['ubahpaket' => $ubahpaket]);
        }
    }

}
