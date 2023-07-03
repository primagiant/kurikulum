<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanKajian extends Model
{
    use HasFactory;
    protected $table = 'bahan_kajian';
    protected $primaryKey = 'id_bk';
    protected $fillable = [
        'id_prodi',
        'kode_bk',
        'nama_bk',
        'deskripsi_bk',
        'bobot_min',
        'bobot_max',
        'active'
    ];
    public $timestamps = false;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }
}
