<?php

namespace App\Http\Controllers;

use App\Models\Onu;
use Illuminate\Http\Request;

class OnuController extends Controller
{
    public function index()
    {
        $onu = Onu::orderByDesc('id')->get();

        return view('onu.index', compact('onu'));
    }
}
