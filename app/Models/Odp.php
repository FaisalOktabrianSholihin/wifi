<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odp extends Model
{
    use HasFactory;

    protected $table = 'odp';

    protected $fillable = [
        'odp',
        'kode_odp',
        'odc_id',
        'jumlah_port',
        'ket_odp',
    ];

    public function odc()
    {
        return $this->belongsTo(Odc::class, 'odc_id');
    }
}
