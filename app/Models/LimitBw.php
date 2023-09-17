<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LimitBw extends Model
{
    use HasFactory;

    protected $table = 'limit_bw';

    protected $fillable = [
        'limit',
        'rate',
    ];
}
