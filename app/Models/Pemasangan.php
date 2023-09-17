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
        'nama',
        'alamat',
        'telepon',
        'status_survey',
        'user_survey',
        'user_action',
        'tgl_action',
        'biaya',
        'diskon',
        'bayar',
        'lunas',
        'keterangan',
    ];
}
