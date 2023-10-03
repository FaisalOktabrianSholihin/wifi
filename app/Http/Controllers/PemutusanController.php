<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemutusanController extends Controller
{
    public function index()
    {
        return view('pemutusan.index');
    }
}
