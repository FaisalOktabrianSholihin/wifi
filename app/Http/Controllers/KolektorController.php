<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KolektorController extends Controller
{
    public function index()
    {
        return view('kolektor.index');
    }
}
