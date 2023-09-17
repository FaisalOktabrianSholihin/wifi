<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routers extends Model
{
    use HasFactory;

    protected $table = 'routers';

    protected $fillable = [
        'router',
        'ip_address',
        'username',
        'password',
        'port',
    ];
}
