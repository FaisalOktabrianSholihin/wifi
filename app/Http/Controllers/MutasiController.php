<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Pelanggan;
use App\Models\Pemasangan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin|sales'], ['only' => ['store']]);
        $this->middleware(['role:admin'], ['only' => ['assignmentTeknisi']]);
        $this->middleware(['role:teknisi'], ['only' => ['updateMutasi', 'pembayaran', 'invoice']]);
    }

    public function index()
    {
        $admin = auth()->user()->hasRole('admin');
        $sales = auth()->user()->hasRole('sales');
        $username = auth()->user()->name;

        if ($admin || $sales) {
            $mutasi = Mutasi::with('pelanggan')
                ->where(function ($query) {
                    $query->whereNull('lunas')
                        ->orWhere(function ($query) {
                            $query->where('lunas', '!=', 'Lunas')
                                ->where('status_mutasi', '!=', 'Gagal Mutasi');
                        });
                })
                ->orderByDesc('id')
                ->get();
        } else {
            $mutasi = Mutasi::where('user_action', $username)
                ->where(function ($query) {
                    $query->whereNull('lunas')
                        ->orWhere(function ($query) {
                            $query->where('lunas', '!=', 'Lunas')
                                ->where('status_mutasi', '!=', 'Gagal Mutasi');
                        });
                })
                ->orderByDesc('id')
                ->with('pelanggan')
                ->get();
        }
        $berhasil = Mutasi::where('lunas', 'Lunas')
            ->with('pelanggan')
            ->orderByDesc('id')
            ->get();

        $gagal = Mutasi::where('status_mutasi', 'Gagal Mutasi')
            ->with(['pelanggan'])
            ->orderByDesc('id')
            ->get();

        $pelanggan = Pelanggan::with('paket')->get();
        $teknisi = User::role('teknisi')->get();

        return view('mutasi.index', compact('pelanggan', 'mutasi', 'teknisi', 'gagal', 'berhasil'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'no_pelanggan' => 'required',
            'jenis_mutasi' => 'required',
            'alamat_baru' => '',
        ]);

        // Inisialisasi $alamat_baru dengan null
        $alamat_baru = null;

        // Periksa apakah 'alamat_baru' ada dalam request
        if ($request->has('alamat_baru')) {
            $alamat_baru = $validateData['alamat_baru'];
        }


        Mutasi::create([
            'no_pelanggan' => $validateData['no_pelanggan'],
            'jenis_mutasi' => $validateData['jenis_mutasi'],
            'alamat_baru' => $alamat_baru,
            'status_mutasi' => 'Belum Diproses',
            'lunas' => 'Belum Lunas',
            'keterangan' => '-',
        ]);

        return redirect()->route('route.mutasis.index')->with('message', 'Data berhasil disimpan.');
    }

    public function assignmentTeknisi(Request $request, $id)
    {
        try {
            $mutasi = Mutasi::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        $validatedData = $request->validate([
            'user_action' => 'required',
        ]);

        $update =  $mutasi->update($validatedData);
        if ($update) {
            return redirect()->route('route.mutasis.index')->with('message', 'Berhasil assignment data mutasi ke teknisi.');
        } else {
            return redirect()->back()->withErrors('Ada kesalahan');
        }
    }

    public function updateMutasi(Request $request, $id)
    {
        try {
            $mutasi = Mutasi::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }
        if ($mutasi->status_mutasi === 'Berhasil Mutasi' || $mutasi->status_mutasi === 'Gagal Mutasi') {
            return back()->withErrors('Data sudah diupdate');
        }
        $validatedData = $request->validate([
            'status_mutasi' => 'required',
            'tgl_action' => 'required|date',
        ]);

        $mutasi->update($validatedData);

        return redirect()->route('route.mutasis.index')->with('message', 'Berhasil update status mutasi.');
    }

    public function pembayaran(Request $request, $id)
    {
        try {
            $mutasi = Mutasi::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }

        $validated = $request->validate([
            'biaya' => 'required',
            'bayar' => 'required',
            'diskon' => 'required',
            'keterangan' => 'nullable',
            'lunas' => 'required',
        ]);

        $update =  $mutasi->update($validated);

        if ($update) {
            if ($validated['lunas'] == 'Lunas') {
                return $this->invoice($mutasi);


                return redirect()->route('route.mutasis.index')->with('message', 'Berhasil melakukan pembayaran');
            }
        }

        return redirect()->route('route.mutasis.index')->with('message', 'Berhasil melakukan pembayaran');
    }

    public function invoice($mutasi)
    {
        $customer = $mutasi->pelanggan;
        $pdf = Pdf::loadView('mutasi.pdf', ['customer' => $customer, 'mutasi' => $mutasi]);
        $pdf->setPaper(array(0, 0, 250, 500), 'portrait');
        $filename = $customer->no_pelanggan . '_' . $customer->nama . '.pdf';

        return $pdf->download($filename);
    }
}
