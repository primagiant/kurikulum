<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorDeskripsiRps extends Model
{
    use HasFactory;
    protected $table = 'indikator_deskripsi_rps';
    protected $primaryKey = 'id_indikator_deskripsi_rps';

    protected $fillable = [
        'id_deskripsi_rps',
        'id_sub_cpmk',
    ];
}
