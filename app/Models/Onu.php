<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onu extends Model
{
    use HasFactory;

    protected $table = 'onu';

    protected $fillable = [
        'sn_onu',
        'merk_onu_id',
        'type_onu_id',
    ];

    public function merk_onu()
    {
        return $this->belongsTo(MerkOnu::class, 'merk_onu_id');
    }

    public function type_onu()
    {
        return $this->belongsTo(TypeOnu::class, 'type_onu_id');
    }

    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class);
    }
}
