<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCpmk extends Model
{
    use HasFactory;
    protected $table = 'sub_cpmk';
    protected $primaryKey = 'id_sub_cpmk';
    protected $fillable = [
        'id_prodi',
        'id_map_cpmk_mk',
        'kode_sub_cpmk',
        'deskripsi_sub_cpmk',
        'active'
    ];
    public $timestamps = false;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function mapCpmkMk()
    {
        return $this->belongsTo(MapCpmkMk::class, 'id_map_cpmk_mk', 'id_map_cpmk_mk');
    }
}
