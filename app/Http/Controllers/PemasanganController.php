<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\Pemasangan;
use App\Models\User;
use Illuminate\Http\Request;
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


    public function update(Request $request, $id)
    {
        $pemasangan = Pemasangan::findOrFail($id);

        $validatedData = [];

        if (auth()->user()->hasRole('admin')) {
            $validatedData = $request->validate([
                'nama' => 'required',
                'nik' => 'required|max:16',
                'alamat' => 'required',
                'user_survey' => 'required',
                'telepon' => 'required',
            ]);
        } elseif (auth()->user()->hasRole('sales')) {
            if ($request->has('user_action')) {
                $validatedData['user_action'] = $request->input('user_action');
            } else {
                $validatedData = $request->validate([
                    'status_survey' => 'required',
                    'keterangan' => 'required',
                    'tgl_action' => 'required',
                ]);
                if ($validatedData['status_survey'] === 'Berhasil Survey') {
                    // Ambil ID terakhir dari tabel Pelanggan
                    $lastId = Pelanggan::latest('id')->value('id');

                    // Tambahkan 1 untuk mendapatkan nomor urut berikutnya
                    $nomorUrut = $lastId + 1;

                    // Format nomor urut menjadi 4 digit dengan leading zeros
                    $nomorUrutFormatted = str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);

                    // Buat no_pelanggan dengan format 2023 dan nomor urut
                    $noPelanggan = date('Y') . $nomorUrutFormatted;

                    // Buat password_pppoe dengan 8 angka acak
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
            $pemasangan->update($validatedData);

            return redirect()->route('route.pemasangans.index')->with('message', 'Data berhasil diupdate.');
        } else if (auth()->user()->hasRole('teknisi')) {

            if ($request->has('status_aktivasi')) {
                $validatedData['status_aktivasi'] = $request->input('status_aktivasi');
            } else if ($request->has('status_instalasi')) {
                $validatedData['status_instalasi'] = $request->input('status_instalasi');
            } else {
                $validatedData = $request->validate([
                    'biaya' => 'required',
                    'bayar' => 'required',
                    'diskon' => 'required',
                    'status_lunas' => 'required',
                ]);
            }

            $pemasangan->update($validatedData);

            return redirect()->route('route.pelanggans.index')->with('message', 'Data berhasil diupdate.');
        }

        $pemasangan->update($validatedData);


        return redirect()->route('route.pemasangans.index')->with('message', 'Data berhasil diupdate.');
    }

    public function updateTeknisi(Request $request, $id)
    {
        $pemasangan = Pemasangan::findOrFail($id);

        if (auth()->user()->hasRole('sales')) {
            $validatedData = $request->validate([
                'user_action' => 'required',
            ]);

            // Check if status_survey is "Berhasil Survey" before updating
            if ($pemasangan->status_survey === 'Berhasil Survey') {
                $pemasangan->update($validatedData);
                return redirect()->route('route.pemasangans.index')->with('message', 'Data berhasil diupdate.');
            } else {
                return redirect()->route('route.pemasangans.index')->with('message', 'Data tidak dapat diupdate karena status survey belum berhasil');
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
