<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CPMK extends Model
{
    use HasFactory;
    protected $table = 'cpmk';
    protected $primaryKey = 'id_cpmk';
    protected $fillable = [
        'id_prodi',
        'id_cpl',
        'kode_cpmk',
        'deskripsi_cpmk',
        'active'
    ];
    public $timestamps = false;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function cpl()
    {
        return $this->belongsTo(CPL::class, 'id_cpl', 'id_cpl');
    }
}
