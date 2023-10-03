<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    public function index()
    {
        return view('perbaikan.index');
    }
}
