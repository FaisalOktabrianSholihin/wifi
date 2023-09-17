<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogOnu extends Model
{
    use HasFactory;

    protected $table = 'log_onu';

    protected $fillable = [
        'no_pelanggan',
        'vlan',
        'slot',
        'port',
        'index_inc',
        'sn',
        'type_act',
        'user_act',
        'time_act',
    ];
}
