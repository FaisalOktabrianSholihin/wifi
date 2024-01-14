<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Pelanggan;
use App\Models\Pemasangan;
use App\Models\User;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin|sales'], ['only' => ['store']]);
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
                        ->orWhere('lunas', '!=', 'Lunas');
                })
                ->orderByDesc('id')
                ->get();
        } else {
            $mutasi = Mutasi::where('user_action', $username)
                ->where(function ($query) {
                    $query->whereNull('lunas')
                        ->orWhere('lunas', '!=', 'Lunas');
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
            'alamat_baru' => 'required',
        ]);

        Mutasi::create([
            'no_pelanggan' => $validateData['no_pelanggan'],
            'jenis_mutasi' => $validateData['jenis_mutasi'],
            'alamat_baru' => $validateData['alamat_baru'],
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
        // if ($mutasi->user_action != null) {
        //     return back()->withErrors('Data sudah diupdate');
        // }
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
}
