<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;
    protected $table = 'mata_kuliah';
    protected $primaryKey = 'id_mk';
    protected $fillable = [
        'id_prodi',
        'kode_mk_obe',
        'kode_mk_undiksha',
        'nama_mk',
        'deskripsi_mk',
        'sks',
        'semester',
        'active'
    ];
    public $timestamps = false;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }
}
