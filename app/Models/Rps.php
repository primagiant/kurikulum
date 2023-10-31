<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rps extends Model
{
    use HasFactory;
    protected $table = 'rps';
    protected $primaryKey = 'id_rps';

    protected $fillable = [
        'no_doc',
        'revisi',
        'id_mk',
    ];
}
