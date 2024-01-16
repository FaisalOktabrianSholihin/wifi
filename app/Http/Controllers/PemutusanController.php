<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pemutusan;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PemutusanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin|sales'], ['only' => ['store']]);
        $this->middleware(['role:teknisi'], ['only' => ['pembayaran', 'invoice']]);
    }
    public function index()
    {
        $teknisiuser = auth()->user()->hasRole('teknisi');
        $username = auth()->user()->name;

        $pemutusan = Pemutusan::with('pelanggan')
            ->when($teknisiuser, function ($query) use ($username) {
                $query->where('user_action', $username);
            })
            ->orderByDesc('id')
            ->get();

        $teknisi = User::role('teknisi')->get();
        $pelanggan = Pelanggan::with('paket')->get();

        return view('pemutusan.index', compact('pemutusan', 'teknisi', 'pelanggan'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'no_pelanggan' => 'required',
            'user_action' => 'required',
        ]);

        Pemutusan::create([
            'no_pelanggan' => $validateData['no_pelanggan'],
            'user_action' => $validateData['user_action'],
            'lunas' => 'Belum Lunas',
            'keterangan' => '-',
        ]);

        return redirect()->route('route.pemutusans.index')->with('message', 'Data berhasil disimpan.');
    }
    public function pembayaran(Request $request, $id)
    {
        try {
            $pemutusan = Pemutusan::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }

        $validated = $request->validate([
            'tgl_action' => 'required|date',
            'biaya' => 'required',
            'bayar' => 'required',
            'diskon' => 'required',
            'keterangan' => 'nullable',
            'lunas' => 'required',
        ]);

        $update =  $pemutusan->update($validated);

        if ($update) {
            if ($validated['lunas'] == 'Lunas') {
                return $this->invoice($pemutusan);
            }
        }

        return redirect()->route('route.pemutusans.index')->with('message', 'Berhasil melakukan pembayaran');
    }

    public function invoice($pemutusan)
    {
        $customer = $pemutusan->pelanggan;
        $pdf = Pdf::loadView('pemutusan.pdf', ['customer' => $customer, 'pemutusan' => $pemutusan]);
        $pdf->setPaper(array(0, 0, 250, 500), 'portrait');
        $filename = $customer->no_pelanggan . '_' . $customer->nama . '.pdf';

        return $pdf->download($filename);
    }
}
