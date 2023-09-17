<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OdpPort extends Model
{
    use HasFactory;

    protected $table = 'odp_port';

    protected $fillable = [
        'odp_id',
        'odp_port',
    ];
}
