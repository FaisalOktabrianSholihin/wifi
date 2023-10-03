<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OltController extends Controller
{
    public function index()
    {
        return view('olt.index');
    }
}
