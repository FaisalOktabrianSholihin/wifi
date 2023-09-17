<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpPool extends Model
{
    use HasFactory;

    protected $table = 'ip_pool';

    protected $fillable = [
        'pool',
        'ip_range',
        'router_id',
    ];
    
}
