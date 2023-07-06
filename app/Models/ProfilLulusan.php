<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilLulusan extends Model
{
    use HasFactory;
    protected $table = 'profil_lulusan';
    protected $primaryKey = 'id_pl';
    protected $fillable = [
        'id_prodi',
        'kode_pl',
        'deskripsi_pl',
        'unsur',
        'referensi',
        'active'
    ];

    public $timestamps = false;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function cpl()
    {
        return $this->belongsToMany(CPL::class);
    }
}
