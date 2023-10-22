<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pemasangan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
    // Get the authenticated user's name
    $username = auth()->user()->name;

    // Get pemasangan_id for the authenticated user's name and role
    $pemasanganIds = Pemasangan::where('user_action', $username)
        ->pluck('id')
        ->toArray();
    
    // Get customers based on pemasangan_id
    $customers = Pelanggan::whereIn('pemasangan_id', $pemasanganIds)->get();

    $pemasanganData = Pemasangan::join('pelanggan', 'pemasangan_id', '=', 'pelanggan.id')
    ->whereIn('pelanggan.id', $customers->pluck('id')->toArray())
    ->select('pemasangan.*')
    ->get();

    return view('pelanggan.index', compact('customers', 'pemasanganData'));
    }

    public function update(Request $request, $id) {
        $pelanggan = Pelanggan::findOrFail($id);
        if (auth()->user()->hasRole('teknisi')) {
            $validatedData = $request->validate([
                'tgl_pasang' => 'required|date',
                'tgl_isolir' => 'required|date',
                'aktivasi_router' => 'required',
                'aktivasi_olt' => 'required',
                'cara_bayar' => 'required',
            ]);
        $pelanggan->update($validatedData);

            return redirect()->route('route.pemasangan.index')->with('message', 'Data berhasil diupdate.');
        } else {
            return redirect()->route('route.pemasangan.index')->with('message', 'Data gagal diupdate.');
            
        }
        
    }
}
