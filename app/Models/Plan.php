<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plan';

    protected $fillable = [
        'plan',
        'ip_pool_id',
        'limit_id',
        'router_id',
        'paket_id',
    ];
}
