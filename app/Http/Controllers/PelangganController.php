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

    return view('pelanggan.index', compact('customers'));
    }
}
