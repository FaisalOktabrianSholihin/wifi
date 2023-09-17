<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Olt extends Model
{
    use HasFactory;

    protected $table = 'olt';

    protected $fillable = [
        'olt',
        'ip_address',
        'username',
        'password',
        'port',
    ];
}
