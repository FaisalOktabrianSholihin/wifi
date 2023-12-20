<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\UbahPaket;

class UbahPaketController extends Controller
{
    public function index()
    {
        return view('ubah_paket.index');
    }
}
