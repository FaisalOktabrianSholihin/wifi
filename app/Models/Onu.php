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
}
