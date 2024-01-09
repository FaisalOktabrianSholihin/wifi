<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\Pemasangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $sales = auth()->user()->hasRole('sales');
        $username = auth()->user()->name;

        if ($admin || $sales) {
            $pemasangan = Pemasangan::with('toPaket')
                ->when($sales, function ($query) use ($username) {
                    $query->where('user_survey', $username);
                })
                ->orderByDesc('id')
                ->get();
        } else {
            $pemasangan = Pemasangan::where('user_action', $username)
                ->orderByDesc('id')
                ->with('toPaket')
                ->get();

            $pemasangan->load('pelanggan');
        }

        // $pemasangan = Pemasangan::with('toPaket')->orderByDesc('id')->get();
        $users = User::role('sales')->get();
        $teknisi = User::role('teknisi')->get();
        $pakets = Paket::orderByDesc('id')->get();
        return view('pemasangan.index', compact('pemasangan', 'users', 'teknisi', 'pakets'));
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
        $validatedData['status_survey'] = 'Belum Survey';

        Pemasangan::create($validatedData);

        return redirect()->route('route.pemasangans.index')->with('message', 'Data berhasil disimpan.');
    }


    public function update(Request $request, $id)
    {
        $pemasangan = Pemasangan::findOrFail($id);

        $validated = [];

        $statusSurvey = $pemasangan->status_survey;
        $user = auth()->user();

        if ($statusSurvey === "Berhasil Survey" || $statusSurvey === "Gagal Survey") {
            return redirect()->route('route.pemasangans.index')->withErrors('Data gagal diupdate.');
        } else {
            if ($user->hasRole('admin')) {

                $validated = $request->validate([
                    'nama' => 'required',
                    'nik' => 'required|max:16',
                    'alamat' => 'required',
                    'user_survey' => 'required',
                    'telepon' => 'required',
                ]);

                $pemasangan->update($validated);

                return redirect()->route('route.pemasangans.index')->with('message', 'Data berhasil diupdate.');
            } elseif ($user->hasRole('sales')) {

                if ($request->has('user_action')) {
                    $validated['user_action'] = $request->input('user_action');
                } else {
                    $validated = $request->validate([
                        'status_survey' => 'required',
                        'keterangan' => 'required',
                        'tgl_action' => 'required',
                    ]);
                    if ($validated['status_survey'] === 'Berhasil Survey') {
                        $lastId = Pelanggan::latest('id')->value('id');

                        $nomorUrut = $lastId + 1;

                        $nomorUrutFormatted = str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);

                        $noPelanggan = date('Y') . $nomorUrutFormatted;

                        $passwordPppoe = rand(10000000, 99999999);
                        $pemasanganId = $pemasangan->id;
                        $pemasanganNama = $pemasangan->nama;
                        $pemasanganAlamat = $pemasangan->alamat;
                        $pemasanganTlp = $pemasangan->telepon;
                        $paketId = $pemasangan->paket_id;

                        Pelanggan::create([
                            // 'no_pelanggan' => $noPelanggan,
                            'pemasangan_id' => $pemasanganId,
                            'nama' => $pemasanganNama,
                            'alamat' => $pemasanganAlamat,
                            'telepon' => $pemasanganTlp,
                            'paket_id' => $paketId,
                            // 'username_pppoe' => $noPelanggan,
                            'password_pppoe' => $passwordPppoe,
                        ]);

                        $validated = $request->validate([
                            'status_survey' => 'required',
                            'keterangan' => 'required',
                            'tgl_action' => 'required',
                        ]);
                        $pemasangan->update($validated);


                        return redirect()->route('route.pemasangans.index')->with('message', 'Data berhasil diupdate.');
                    }
                }
                $pemasangan->update($validated);

                return redirect()->route('route.pemasangans.index')->with('message', 'Data berhasil diupdate.');
            }
            $pemasangan->update($validated);

            return redirect()->route('route.pemasangans.index')->with('message', 'Data berhasil diupdate.');
        }
    }

    public function updateTeknisi(Request $request, $id)
    {
        $pemasangan = Pemasangan::findOrFail($id);

        if (auth()->user()->hasRole('sales')) {
            $validatedData = $request->validate([
                'user_action' => 'required',
            ]);

            if ($pemasangan->status_survey === 'Berhasil Survey') {
                $pemasangan->update($validatedData);
                return redirect()->route('route.pemasangans.index')->with('message', 'Data berhasil diupdate.');
            } else {
                return redirect()->route('route.pemasangans.index')->withErrors('Data tidak dapat diupdate karena status survey belum berhasil');
            }
        } else {
            return redirect()->route('route.pemasangans.index')->with('message', 'Data gagal diupdate.');
        }
    }

    public function destroy($id)
    {
        $pemasangans = Pemasangan::findOrFail($id);
        $pemasangans->delete();

        return back()->with('message', 'Data berhasil di hapus');
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

        return redirect()->route('route.pemasangans.index')->with('message', 'Data berhasil diupdate.');
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

        return redirect()->route('route.pemasangans.index')->with('message', 'Berhasil assignment data pemasangan ke sales.');
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

        if ($validatedData['status_survey'] === 'Berhasil Survey') {
            Pelanggan::create([
                'paket_id' => $pemasangan->paket_id,
                'pemasangan_id' => $pemasangan->id,
            ]);
        }

        return redirect()->route('route.pemasangans.index')->with('message', 'Berhasil update status survey.');
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
        $validatedData = $request->validate([
            'user_action' => 'required',
        ]);

        $pemasangan->update($validatedData);

        return redirect()->route('route.pemasangans.index')->with('message', 'Berhasil assignment data pemasangan ke teknisi.');
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

        return redirect()->route('route.pemasangans.index')->with('message', 'Berhasil update status instalasi.');
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
        if ($pemasangan->status_instalasi === 'Gagal Aktivasi' || $pemasangan->status_instalasi === null) {
            return back()->withErrors('Gagal mengupdate data, status instalasi Gagal atau belum diupdate');
        }
        $validatedData = $request->validate([
            'status_aktivasi' => 'required',
        ]);

        $pemasangan->update($validatedData);

        return redirect()->route('route.pemasangans.index')->with('message', 'Berhasil update status aktivasi.');
    }
}
