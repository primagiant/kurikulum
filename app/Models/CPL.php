<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CPL extends Model
{
    use HasFactory;
    protected $table = 'cpl';
    protected $primaryKey = 'id_cpl';
    protected $fillable = [
        'id_prodi',
        'kode_cpl',
        'deskripsi_cpl',
        'unsur',
        'referensi',
        'active'
    ];
    public $timestamps = false;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function profilLulusan()
    {
        return $this->belongsToMany(ProfilLulusan::class);
    }
}
