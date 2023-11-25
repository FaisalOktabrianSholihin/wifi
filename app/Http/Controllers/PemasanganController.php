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
    public function index()
    {
        $pemasangan = Pemasangan::with('toPaket')->orderByDesc('id')->get();
        $users = User::role('sales')->get();
        $teknisi = User::role('teknisi')->get();
        $pakets = Paket::orderByDesc('id')->get();
        return view('pemasangan.index', compact('pemasangan', 'users', 'teknisi', 'pakets'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = [];
        if (auth()->user()->hasRole('admin')) {
            $validatedData = $request->validate([
                'no_pendaftaran' => 'required|unique:pemasangan,no_pendaftaran',
                'nik' => 'required|max:16',
                'nama' => 'required',
                'alamat' => 'required',
                'paket_id' => 'required',
                'telepon' => 'required',
            ]);
        } elseif (auth()->user()->hasRole('sales')) {
            $validatedData = $request->validate([
                'no_pendaftaran' => 'required|unique:pemasangan,no_pendaftaran',
                'nik' => 'required|max:16',
                'nama' => 'required',
                'paket_id' => 'required',
                'alamat' => 'required',
                'telepon' => 'required',

            ]);
            $validatedData['user_survey'] = auth()->user()->name;
        }

        // Add status_survey to the validated data
        $validatedData['status_survey'] = 'Belum Survey';
        // Create a new Pemasangan record
        Pemasangan::create($validatedData);

        return redirect()->route('route.pemasangans.index')->with('message', 'Data berhasil disimpan.');
    }

    public function update(Request $request, $id) {
        $pemasangan = Pemasangan::findOrFail($id);

        $validated = [];

        $statusSurvey = $pemasangan->status_survey;
        $user = auth()->user();

        if ($statusSurvey === "Berhasil Survey" || $statusSurvey === "Gagal Survey" ) {
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

            
            } else if ($user->hasRole('sales')) {

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
                            'no_pelanggan' => $noPelanggan,
                            'pemasangan_id' => $pemasanganId,
                            'nama' => $pemasanganNama,
                            'alamat' => $pemasanganAlamat,
                            'telepon' => $pemasanganTlp,
                            'paket_id' => $paketId,
                            'username_pppoe' => $noPelanggan,
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
}
