<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RujukanRps extends Model
{
    use HasFactory;
    protected $table = 'rujukan_rps';
    protected $primaryKey = 'id_rujukan_rps';

    protected $fillable = [
        'id_rps',
        'rujukan',
    ];
}
