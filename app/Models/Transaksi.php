<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'no_pelanggan',
        'nama_pelanggan',
        'action',
        'periode',
        'tgl_transaksi',
        'tgl_isolir',
        'user_action',
        'tgl_action',
        'paket',
        'iuran',
        'instalasi',
        'ubah_paket',
        'diskon',
        'bayar',
        'status_lunas',
        'keterangan',
    ];
}
