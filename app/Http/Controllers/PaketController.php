<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        // return view('paket.index');
        $pakets = Paket::all();
        return view('paket.index', compact('pakets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'paket' => 'required',
            'iuran' => 'required',
            'instalasi' => 'required',
        ]);
        Paket::create($validated);
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }
}
