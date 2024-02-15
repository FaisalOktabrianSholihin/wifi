<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odc extends Model
{
    use HasFactory;

    protected $table = 'odc';

    protected $fillable = [
        'odc',
        'kode_odc',
        'vlan',
        'ket_odc',
    ];

    public function odp()
    {
        return $this->hasMany(Odp::class);
    }
}
