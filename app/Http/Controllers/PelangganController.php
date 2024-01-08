<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pemasangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PDF;

class PelangganController extends Controller
{
    // public function index()
    // {
    //     $username = auth()->user()->name;

    //     $customers = Pemasangan::where('user_action', $username)->get();

    //     $customers->load('pelanggan');

    //     return view('pelanggan.index', compact('customers'));
    // }

    public function index()
    {
        $user = auth()->user();

        // Query untuk data yang berhasil
        $berhasil = Pemasangan::whereNotNull('status_lunas')
            ->where('status_lunas', 'Lunas')
            ->with(['pelanggan', 'toPaket'])
            ->orderByDesc('id')
            ->get();

        // Query untuk data yang gagal
        $gagal = Pemasangan::where('status_lunas', 'Belum Lunas')
            ->with(['pelanggan', 'toPaket'])
            ->orderByDesc('id')
            ->get();

        // Query utama untuk data yang belum lunas
        if ($user->hasRole('teknisi')) {
            $customers = Pemasangan::where(function ($query) {
                $query->whereNull('status_lunas')
                    ->orWhere('status_lunas', '!=', 'Lunas');
            })
                ->with(['pelanggan', 'toPaket'])
                ->orderByDesc('id')
                ->get();
        } else {
            // Handle role 'admin' or 'sales' here if needed
            $customers = Pemasangan::where(function ($query) {
                $query->whereNull('status_lunas')
                    ->orWhere('status_lunas', '!=', 'Lunas');
            })
                ->with(['pelanggan', 'toPaket'])
                ->orderByDesc('id')
                ->get();
        }

        // Handle properti yang mungkin null
        foreach ($customers as $customer) {
            $customer->no_pelanggan = optional($customer->pelanggan)->no_pelanggan;
        }

        return view('pelanggan.index', compact('customers', 'berhasil', 'gagal'));
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

    public function show(Request $request, $id)
    {
        $pemasangan = Pemasangan::findOrFail($id);

        return view('pelanggan.index', compact('customers', 'pemasanganData'));
    }

    public function updatePembayaran(Request $request, $id)
    {
        $pemasangan = Pemasangan::findOrFail($id);

        $user = auth()->user();

        if ($user->hasRole('teknisi')) {
            $validated = $request->validate([
                'biaya' => 'required',
                'bayar' => 'required',
                'diskon' => 'required',
                'keterangan_diskon' => 'required',
                'status_lunas' => 'required',
            ]);

            $pemasangan->update($validated);

            return redirect()->route('route.pelanggans.index')->with('message', 'Data berhasil diupdate.');
        }
    }
    public function updateAktivasi(Request $request, $id)
    {
        $pemasangan = Pemasangan::findOrFail($id);

        $user = auth()->user();
        if ($user->hasRole('teknisi')) {

            $validated = $request->validate([
                'status_aktivasi' => [
                    'required',
                    Rule::in(['Berhasil Aktivasi', 'Gagal Aktivasi']),
                ],
            ]);
            if ($pemasangan->status_aktivasi === 'Berhasil Aktivasi' || $pemasangan->status_aktivasi === 'Gagal Aktivasi') {
                return redirect()->route('route.pelanggans.index')->withErrors('Data gagal diupdate. Status aktivasi sudah di-set.');
            }
            $pemasangan->update($validated);

            return redirect()->route('route.pelanggans.index')->with('message', 'Data berhasil diupdate.');
        }
    }

    public function updateInstalasi(Request $request, $id)
    {
        $pemasangan = Pemasangan::findOrFail($id);

        $user = auth()->user();
        if ($user->hasRole('teknisi')) {
            $validated = $request->validate([
                'status_instalasi' => [
                    'required',
                    Rule::in(['Berhasil Instalasi', 'Gagal Instalasi']),
                ],
            ]);
            if ($pemasangan->status_instalasi === 'Berhasil Instalasi' || $pemasangan->status_instalasi === 'Gagal Instalasi') {
                return redirect()->route('route.pelanggans.index')->withErrors('Data gagal diupdate. Status instalasi sudah di-set.');
            }
            $pemasangan->update($validated);

            return redirect()->route('route.pelanggans.index')->with('message', 'Data berhasil diupdate.');
        }
    }

    public function pdf($id)
    {
        $customer = Pelanggan::find($id);

        $pemasangan = Pemasangan::find($customer->pemasangan_id);

        $pdf = PDF::loadView('pelanggan.pdf', ['customer' => $customer, 'pemasangan' => $pemasangan]);

        $pdf->setPaper(array(0, 0, 250, 500), 'portrait');
        $filename = $customer->no_pelanggan . '_' . $customer->nama . '.pdf';
        return $pdf->download($filename);
    }
}
