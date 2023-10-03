<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UbahPaketController extends Controller
{
    public function index()
    {
        return view('ubah_paket.index');
    }
}
