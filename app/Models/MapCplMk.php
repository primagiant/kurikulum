<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapCplMk extends Model
{
    use HasFactory;
    protected $table = 'map_cpl_mk';
    protected $primaryKey = 'id_map_cpl_mk';
    protected $fillable = [
        'id_cpl',
        'id_mk',
        'active'
    ];
    public $timestamps = false;

    public function cpl()
    {
        return $this->belongsTo(CPL::class, 'id_cpl', 'id_cpl');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }
}
