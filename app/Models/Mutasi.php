<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;

    protected $table = 'mutasi';

    protected $fillable = [
        'no_pelanggan',
        'jenis_mutasi',
        'alamat_baru',
        'status_mutasi',
        'user_action',
        'tgl_action',
        'biaya',
        'diskon',
        'bayar',
        'lunas',
        'keterangan',
    ];
}
