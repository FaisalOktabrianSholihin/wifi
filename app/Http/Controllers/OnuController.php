<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnuController extends Controller
{
    public function index()
    {
        return view('onu.index');
    }
}
