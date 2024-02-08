<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Perbaikan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    // public function index()
    // {
    //     return view('perbaikan.index');
    // }

    public function __construct()
    {
        $this->middleware(['role:admin|sales'], ['only' => ['store']]);
        $this->middleware(['role:admin'], ['only' => ['assignmentTeknisi']]);
        $this->middleware(['role:teknisi'], ['only' => ['updatePerbaikan', 'pembayaran', 'invoice']]);
    }

    public function index()
    {
        $teknisiuser = auth()->user()->hasRole('teknisi');
        $admin = auth()->user()->hasRole('admin');
        $sales = auth()->user()->hasRole('sales');
        $username = auth()->user()->name;

        $perbaikan = Perbaikan::with('pelanggan')
            ->when($teknisiuser, function ($query) use ($username) {
                $query->where('user_action', $username);
            })
            ->where(function ($query) {
                $query->whereNull('lunas')
                    ->orWhere(function ($query) {
                        $query->where('status_perbaikan', '!=', 'Gagal Perbaikan')
                            ->where('lunas', '!=', 'Lunas');
                    });
            })
            ->orderByDesc('id')
            ->get();

        // $berhasil = Perbaikan::where('lunas', 'Lunas')
        //     ->with('pelanggan')
        //     ->orderByDesc('id')
        //     ->get();

        // $gagal = Perbaikan::where('status_perbaikan', 'Gagal Perbaikan')
        //     ->with(['pelanggan'])
        //     ->orderByDesc('id')
        //     ->get();

        $teknisi = User::role('teknisi')->get();
        $pelanggan = Pelanggan::with('paket')->get();

        return view('perbaikan.index', compact('perbaikan', 'teknisi', 'pelanggan'));
    }

    public function berhasil()
    {
        $berhasil = Perbaikan::where('lunas', 'Lunas')
            ->with('pelanggan')
            ->orderByDesc('id')
            ->get();

        return view('perbaikan/berhasil', compact('berhasil'));
    }   

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'no_pelanggan' => 'required',
            // 'user_action' => 'required',
        ]);

        Perbaikan::create([
            'no_pelanggan' => $validateData['no_pelanggan'],
            // 'user_action' => $validateData['user_action'],
            'status_perbaikan' => 'Belum Diproses',
            'lunas' => 'Belum Lunas',
            'keterangan' => '-',
        ]);

        return redirect()->route('route.perbaikans.index')->with('message', 'Data berhasil disimpan.');
    }

    public function assignmentTeknisi(Request $request, $id)
    {
        try {
            $perbaikan = Perbaikan::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        $validatedData = $request->validate([
            'user_action' => 'required',
        ]);

        $update =  $perbaikan->update($validatedData);
        if ($update) {
            return redirect()->route('route.perbaikans.index')->with('message', 'Berhasil assignment data perbaikan ke teknisi.');
        } else {
            return redirect()->back()->withErrors('Ada kesalahan');
        }
    }

    public function updatePerbaikan(Request $request, $id)
    {
        try {
            $perbaikan = Perbaikan::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }
        if (
            $perbaikan->status_perbaikan === 'Berhasil Perbaikan' || $perbaikan->status_perbaikan === 'Gagal Perbaikan'
        ) {
            return back()->withErrors('Data sudah diupdate');
        }
        $validatedData = $request->validate([
            'status_perbaikan' => 'required',
            'tgl_action' => 'required|date',
        ]);

        $perbaikan->update($validatedData);

        return redirect()->route('route.perbaikans.index')->with('message', 'Berhasil update status perbaikan.');
    }

    public function pembayaran(Request $request, $id)
    {
        try {
            $perbaikan = Perbaikan::findOrFail($id);
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

        $update =  $perbaikan->update($validated);

        if ($update) {
            if ($validated['lunas'] == 'Lunas') {
                return $this->invoice($perbaikan);
            }
        }

        return redirect()->route('route.perbaikans.index')->with('message', 'Berhasil melakukan pembayaran');
    }

    public function invoice($perbaikan)
    {
        $customer = $perbaikan->pelanggan;
        $pdf = Pdf::loadView('perbaikan.pdf', ['customer' => $customer, 'perbaikan' => $perbaikan]);
        $pdf->setPaper(array(0, 0, 250, 500), 'portrait');
        $filename = $customer->no_pelanggan . '_' . $customer->nama . '.pdf';

        return $pdf->download($filename);
    }
}
