<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskripsiRps extends Model
{
    use HasFactory;
    protected $table = 'deskripsi_rps';
    protected $primaryKey = 'id_deskripsi_rps';

    protected $fillable = [
        'id_rps',
        'pertemuan',
        'id_bk',
        'bentuk_pembelajaran_synchronous',
        'bentuk_pembelajaran_asynchronous',
        'waktu',
        'tugas_dan_penilaian',
    ];
}
