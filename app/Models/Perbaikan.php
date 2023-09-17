<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;

    protected $table = 'perbaikan';

    protected $fillable = [
        'no_pelanggan',
        'user_action',
        'tgl_action',
        'biaya',
        'diskon',
        'bayar',
        'lunas',
        'keterangan',
    ];
}
