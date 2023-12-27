<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\UbahPaket;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use PDF;

class UbahPaketController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin') && $user->hasRole('sales')) {

            $ubahpaket = UbahPaket::with(['pelanggan', 'paket'])->orderByDesc('id')->get();

        } else {
            $ubahpaket = UbahPaket::where('status_visit', 'Perlu')->with(['pelanggan', 'paket'])->orderByDesc('id')->get();
        }

        $berhasil = UbahPaket::where('status_proses', 'Berhasil')->with(['pelanggan', 'paket'])->orderByDesc('id')->get();
        $teknisi = User::role('teknisi')->get();
        $data = Pelanggan::with('paket')->get();
        $paket = Paket::all();
        return view('ubah_paket.index', compact('ubahpaket', 'paket', 'teknisi', 'data', 'berhasil'));
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

        $username = auth()->user()->name;

        // Manually add user_action to the data array
        $validatedData = $request->all();
        $validatedData['user_action'] = $username;

        // Validate the data
        $validatedData = Validator::make($validatedData, [
            'user_action' => 'required',
            'tgl_action' => 'required|date',
            'biaya' => 'required',
            'diskon' => 'required',
            'bayar' => 'required',
            'lunas' => 'required',
            'keterangan' => 'nullable'
        ])->validate();

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

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'no_pelanggan' => 'required',
            'paket_baru_id' => 'required',
        ]);

        $noPelanggan = $validatedData['no_pelanggan'];

        $pelanggan = Pelanggan::where('no_pelanggan', $noPelanggan)->first();

        $namaPaketLama = $pelanggan->paket->paket;

        $paketIdBaru = $validatedData['paket_baru_id'];

        $ubahPaket = UbahPaket::create([
            'no_pelanggan' => $noPelanggan,
            'paket_lama' => $namaPaketLama,
            'paket_baru_id' => $paketIdBaru,
        ]);

        Pelanggan::where('no_pelanggan', $noPelanggan)->update(['paket_id' => $paketIdBaru]);

        return redirect()->route('route.ubah_pakets.index')->with('message', 'Data berhasil disimpan.');
    }

    public function updateVisit(Request $request, $id)
    {

        $ubahpaket = UbahPaket::findOrFail($id);

        $validatedData = $request->validate([
            'status_visit' => 'required',
        ]);

        $ubahpaket->update($validatedData);

        return redirect()->route('route.ubah_pakets.index')->with('message', 'Data berhasil disimpan.');

    }

    public function updateProses(Request $request, $id)
    {

        $ubahpaket = UbahPaket::findOrFail($id);

        $validatedData = $request->validate([
            'status_proses' => 'required',
            'keterangan_proses' => 'nullable',
        ]);

        $ubahpaket->update($validatedData);

        return redirect()->route('route.ubah_pakets.index')->with('message', 'Data berhasil disimpan.');

    }
}
