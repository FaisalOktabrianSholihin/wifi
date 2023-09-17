<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerkOnu extends Model
{
    use HasFactory;

    protected $table = 'merk_onu';

    protected $fillable = [
        'merk_onu',
    ];
}
