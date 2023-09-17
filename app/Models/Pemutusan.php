<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemutusan extends Model
{
    use HasFactory;

    protected $table = 'pemutusan';

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
