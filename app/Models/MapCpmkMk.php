<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapCpmkMk extends Model
{
    use HasFactory;
    protected $table = 'map_cpmk_mk';
    protected $primaryKey = 'id_map_cpmk_mk';
    protected $fillable = [
        'id_cpmk',
        'id_mk',
        'active'
    ];
    public $timestamps = false;

    public function cpmk()
    {
        return $this->belongsTo(CPMK::class, 'id_cpmk', 'id_cpmk');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }
}
