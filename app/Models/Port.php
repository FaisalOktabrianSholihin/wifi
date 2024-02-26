<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use HasFactory;

    protected $table = 'port';

    protected $fillable = [
        'slot',
        'port',
        'index_inc',
    ];

    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class);
    }
}
