<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pemasangan;
use Barryvdh\DomPDF\Facade\Pdf;


class PelangganController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:teknisi'], ['only' => ['invoice']]);
    }

    public function index()
    {
        $pelanggan = Pelanggan::orderByDesc('id')->with(['paket', 'pemasangan'])->get();

        return view('pelanggan.index', compact('pelanggan'));
    }

    public function invoice($id)
    {
        try {
            $pemasangan = Pemasangan::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }

        $customer = $pemasangan->pelanggan;
        $pdf = Pdf::loadView('pelanggan.pdf', ['customer' => $customer, 'pemasangan' => $pemasangan]);
        $pdf->setPaper(array(0, 0, 250, 500), 'portrait');
        $filename = $customer->no_pelanggan . '_' . $customer->nama . '.pdf';

        return $pdf->download($filename);
    }
}
