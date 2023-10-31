<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'no_pelanggan',
        'nama',
        'alamat',
        'telepon',
        'username_pppoe',
        'password_pppoe',
        'tgl_pasang',
        'tgl_isolir',
        'status_aktif',
        'aktivasi_router',
        'aktivasi_olt',
        'cara_bayar',
        'paket_id',
        'onu_id',
        'port_id',
        'odp_port_id',
        'router_id',
        'olt_id',
        'pemasangan_id',
    ];

    public function pemasangan()
    {
        return $this->belongsTo(Pemasangan::class, 'pemasangan_id');
    }
}
