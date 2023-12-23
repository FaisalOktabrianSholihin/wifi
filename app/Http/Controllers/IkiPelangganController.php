<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IkiPelangganController extends Controller
{
    public function index()
    {
        return view('ikipelanggan.index');
    }
}
