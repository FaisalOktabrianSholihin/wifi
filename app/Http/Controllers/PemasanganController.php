<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\Pemasangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Permission\Models\Role;

class PemasanganController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin|sales'], ['only' => ['store']]);
        $this->middleware(['role:admin'], ['only' => ['updatePemasangan', 'assignmentSales']]);
        $this->middleware(['role:sales'], ['only' => ['updateSurvey', 'assignmentTeknisi']]);
        $this->middleware(['role:teknisi'], ['only' => ['statusInstalasi', 'statusAktivasi']]);
    }
    public function index()
    {
        $admin = auth()->user()->hasRole('admin');
        $salesuser = auth()->user()->hasRole('sales');
        $teknisiuser = auth()->user()->hasRole('teknisi');
        $username = auth()->user()->name;

        $pemasangan = Pemasangan::with('toPaket')
            ->when($salesuser, function ($query) use ($username) {
                $query->where('user_survey', $username);
            })
            ->when($teknisiuser, function ($query) use ($username) {
                $query->where('user_action', $username);
            })
            ->where(function ($query) {
                $query->whereNull('status_lunas')
                    ->orWhere(function ($query) {
                        $query->where('status_survey', '!=', 'Gagal Survey')
                            ->where('status_instalasi', '!=', 'Gagal Instalasi')
                            ->where('status_aktivasi', '!=', 'Gagal Aktivasi')
                            ->where('status_lunas', '!=', 'Lunas');
                    });
            })
            ->orderByDesc('id')
            ->get();

        $berhasil = Pemasangan::where('status_lunas', 'Lunas')
            ->with(['pelanggan', 'toPaket'])
            ->has('pelanggan')
            ->orderByDesc('id')
            ->get();

        $gagal = Pemasangan::where('status_survey', 'Gagal Survey')
            ->orWhere('status_instalasi', 'Gagal Instalasi')
            ->orWhere('status_aktivasi', 'Gagal Aktivasi')
            ->with(['pelanggan', 'toPaket'])
            ->orderByDesc('id')
            ->get();

        $sales = User::role('sales')->get();
        $teknisi = User::role('teknisi')->get();
        $pakets = Paket::orderByDesc('id')->get();
        return view('pemasangan.index', compact('pemasangan', 'sales', 'teknisi', 'pakets', 'berhasil', 'gagal'));
    }


    public function store(Request $request)
    {
        $validatedData = [];
        if (auth()->user()->hasRole('admin')) {
            $validatedData = $request->validate([
                'nik' => 'required|max:16',
                'nama' => 'required',
                'alamat' => 'required',
                'paket_id' => 'required',
                'telepon' => 'required',
            ]);
        } elseif (auth()->user()->hasRole('sales')) {
            $validatedData = $request->validate([
                'nik' => 'required|max:16',
                'nama' => 'required',
                'paket_id' => 'required',
                'alamat' => 'required',
                'telepon' => 'required',
            ]);
            $validatedData['user_survey'] = auth()->user()->name;
        }

        $tahunSekarang = date('Y');
        $nomorUnik = Pemasangan::max('id') + 1;
        $nomorPendaftaran = "XIX{$tahunSekarang}{$nomorUnik}";

        $validatedData['no_pendaftaran'] = $nomorPendaftaran;

        Pemasangan::create($validatedData);

        return redirect()->route('route.pemasangans')->with('message', 'Data berhasil disimpan.');
    }

    //ini terbaru
    //update pemasangan route nya {{ route.pemasangans.update-pemasangan }} admin yang hanya bisa uodate misal salah nama or anything else
    public function updatePemasangan(Request $request, $id)
    {
        try {
            $pemasangan = Pemasangan::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }

        $validatedData = $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'paket_id' => 'required',
        ]);

        $pemasangan->update($validatedData);

        return redirect()->route('route.pemasangans')->with('message', 'Data berhasil diupdate.');
    }

    //udpate pemasangan assignment sales jadi jangan dijadiin satu menurut gua {{ route.pemasangans.assignment-sales }}
    public function assignmentSales(Request $request, $id)
    {
        try {
            $pemasangan = Pemasangan::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }

        $validatedData = $request->validate([
            'user_survey' => 'required',
        ]);

        $pemasangan->update($validatedData);

        return redirect()->route('route.pemasangans')->with('message', 'Berhasil assignment data pemasangan ke sales.');
    }

    //update survey di sales {{ route.pemasangans.update-survey }}
    public function updateSurvey(Request $request, $id)
    {
        try {
            $pemasangan = Pemasangan::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }
        if ($pemasangan->status_survey === 'Berhasil Survey' || $pemasangan->status_survey === 'Gagal Survey') {
            return back()->withErrors('Data sudah diupdate');
        }
        $validatedData = $request->validate([
            'status_survey' => 'required',
            'keterangan' => 'required',
            'tgl_action' => 'required|date',
        ]);

        $pemasangan->update($validatedData);

        // if ($validatedData['status_survey'] === 'Berhasil Survey') {
        //     Pelanggan::create([
        //         'nama' => $pemasangan->nama,
        //         'alamat' => $pemasangan->alamat,
        //         'telepon' => $pemasangan->telepon,
        //         'paket_id' => $pemasangan->paket_id,
        //         'pemasangan_id' => $pemasangan->id,
        //     ]);
        // }

        return redirect()->route('route.pemasangans')->with('message', 'Berhasil update status survey.');
    }
    //udpate pemasangan assignment teknisi dari sales {{ route.pemasangans.assignment-teknisi }}
    public function assignmentTeknisi(Request $request, $id)
    {
        try {
            $pemasangan = Pemasangan::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }
        if ($pemasangan->status_survey === 'Belum Survey') {
            return back()->withErrors('Silahkan isi status survey terlebih dahulu');
        }
        if ($pemasangan->status_survey === 'Gagal Survey') {
            return back()->withErrors('Tidak bisa assignment ke pihak teknisi karena status survey gagal');
        }
        $validatedData = $request->validate([
            'user_action' => 'required',
        ]);

        $pemasangan->update($validatedData);

        return redirect()->route('route.pemasangans')->with('message', 'Berhasil assignment data pemasangan ke teknisi.');
    }
    //  {{ route.pemasangans.update-instalasi }}
    public function statusInstalasi(Request $request, $id)
    {
        try {
            $pemasangan = Pemasangan::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }
        if ($pemasangan->status_instalasi === 'Berhasil Instalasi' || $pemasangan->status_instalasi === 'Gagal Instalasi') {
            return back()->withErrors('Gagal mengupdate data, status instalasi sudah diupdate');
        }
        $validatedData = $request->validate([
            'status_instalasi' => 'required',
        ]);

        $pemasangan->update($validatedData);

        return redirect()->route('route.pemasangans')->with('message', 'Berhasil update status instalasi.');
    }
    //  {{ route.pemasangans.update-aktivasi }}

    public function statusAktivasi(Request $request, $id)
    {
        try {
            $pemasangan = Pemasangan::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }
        if ($pemasangan->status_aktivasi === 'Berhasil Aktivasi' || $pemasangan->status_aktivasi === 'Gagal Aktivasi') {
            return back()->withErrors('Gagal mengupdate data, status aktivasi sudah diupdate');
        }
        if ($pemasangan->status_instalasi === 'Gagal Instalasi' || $pemasangan->status_instalasi === null) {
            return back()->withErrors('Gagal mengupdate data, status instalasi Gagal atau belum diupdate');
        }
        $validatedData = $request->validate([
            'status_aktivasi' => 'required',
        ]);

        $pemasangan->update($validatedData);

        return redirect()->route('route.pemasangans')->with('message', 'Berhasil update status aktivasi.');
    }

    public function pembayaran(Request $request, $id)
    {
        try {
            $pemasangan = Pemasangan::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw ($e->getMessage());
        }

        $validated = $request->validate([
            'biaya' => 'required',
            'bayar' => 'required',
            'diskon' => 'required',
            'keterangan_diskon' => 'nullable',
            'status_lunas' => 'required',
        ]);

        $update =  $pemasangan->update($validated);
        if ($update) {
            Pelanggan::create([
                'nama' => $pemasangan->nama,
                'alamat' => $pemasangan->alamat,
                'telepon' => $pemasangan->telepon,
                'paket_id' => $pemasangan->paket_id,
                'pemasangan_id' => $pemasangan->id,
            ]);

            if ($validated['status_lunas'] == 'Lunas') {
                return $this->invoice($pemasangan);
            }
        }

        return redirect()->route('route.pemasangans')->with('message', 'Data berhasil diupdate.');
    }

    public function invoice($pemasangan)
    {
        $customer = $pemasangan->pelanggan;
        $pdf = Pdf::loadView('pelanggan.pdf', ['customer' => $customer, 'pemasangan' => $pemasangan]);
        $pdf->setPaper(array(0, 0, 250, 500), 'portrait');
        $filename = $customer->no_pelanggan . '_' . $customer->nama . '.pdf';

        return $pdf->download($filename);
    }
}
