<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasangan extends Model
{
    use HasFactory;

    protected $table = 'pemasangan';

    protected $fillable = [
        'no_pendaftaran',
        'nik',
        'nama',
        'alamat',
        'telepon',
        'status_survey',
        'user_survey',
        'user_action',
        'tgl_action',
        'biaya',
        'status_instalasi',
        'status_aktivasi',
        'status_lunas',
        'diskon',
        'bayar',
        'paket_id',
        'lunas',
        'keterangan_diskon',
        'keterangan',
    ];

    public function toPaket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }

    public function pelanggan() {
        return $this->hasOne(Pelanggan::class);
    }
}
