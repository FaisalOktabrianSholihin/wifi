<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UbahPaket extends Model
{
    use HasFactory;

    protected $table = 'ubah_paket';

    protected $fillable = [
        'no_pelanggan',
        'paket_lama',
        'paket_baru',
        'user_action',
        'tgl_action',
        'biaya',
        'diskon',
        'bayar',
        'lunas',
        'keterangan',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'no_pelanggan', 'no_pelanggan');
    }
}
