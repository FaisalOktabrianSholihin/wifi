<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOnu extends Model
{
    use HasFactory;

    protected $table = 'type_onu';

    protected $fillable = [
        'type_onu',
    ];

    public function onu()
    {
        return $this->hasMany(Onu::class);
    }
}
