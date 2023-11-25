<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pemasangan;
use Illuminate\Http\Request;
use PDF;

class PelangganController extends Controller
{
    public function index()
    {
        // Get the authenticated user's name
        $username = auth()->user()->name;

        // Get pemasangan_id for the authenticated user's name and role
        $pemasanganIds = Pemasangan::where('user_action', $username)
            ->pluck('id')
            ->toArray();

        // Get customers based on pemasangan_id
        $customers = Pelanggan::whereIn('pemasangan_id', $pemasanganIds)->get();

        $pemasanganData = Pemasangan::join('pelanggan', 'pemasangan_id', '=', 'pelanggan.id')
            ->whereIn('pelanggan.id', $customers->pluck('id')->toArray())
            ->select('pemasangan.*')
            ->get();

        return view('pelanggan.index', compact('customers', 'pemasanganData'));
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        if (auth()->user()->hasRole('teknisi')) {
            $validatedData = $request->validate([
                'tgl_pasang' => 'required|date',
                'tgl_isolir' => 'required|date',
                'aktivasi_router' => 'required',
                'aktivasi_olt' => 'required',
                'cara_bayar' => 'required',
            ]);
            $pelanggan->update($validatedData);

            return redirect()->route('route.pemasangan.index')->with('message', 'Data berhasil diupdate.');
        } else {
            return redirect()->route('route.pemasangan.index')->with('message', 'Data gagal diupdate.');
        }
    }
    public function updatePembayaran(Request $request, $id) {
        $pemasangan = Pemasangan::findOrFail($id);

        $validated = [];

        $user = auth()->user();

        if($user->hasRole('teknisi')) {

            if ($request->has('status_aktivasi')) {
                $validated['status_aktivasi'] = $request->input('status_aktivasi');
            } else if ($request->has('status_instalasi')) {
                $validated['status_instalasi'] = $request->input('status_instalasi');
            } else {
                $validated = $request->validate([
                    'biaya' => 'required',
                    'bayar' => 'required',
                    'diskon' => 'required',
                    'keterangan_diskon' => 'required',
                    'status_lunas' => 'required',
                ]);
            }

            $pemasangan->update($validated);

            return redirect()->route('route.pelanggans.index')->with('message', 'Data berhasil diupdate.');
        } 
    }
    public function pdf($id)
    {
        $customer = Pelanggan::find($id);

        // Ambil data pemasangan berdasarkan pemasangan_id pelanggan
        $pemasangan = Pemasangan::find($customer->pemasangan_id);

        $pdf = PDF::loadView('pelanggan.pdf', ['customer' => $customer, 'pemasangan' => $pemasangan]);

        // Atur opsi tampilan PDF, misalnya, orientasi dan ukuran halaman
        $pdf->setPaper(array(0, 0, 250, 500), 'portrait');
        $filename = $customer->no_pelanggan . '_' . $customer->nama . '.pdf';
        return $pdf->download($filename);
    }
}
