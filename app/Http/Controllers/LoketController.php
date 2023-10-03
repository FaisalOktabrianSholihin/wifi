<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoketController extends Controller
{
    public function index()
    {
        return view('loket.index');
    }
}
