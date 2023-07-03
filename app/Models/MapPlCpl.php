<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapPlCpl extends Model
{
    use HasFactory;
    protected $table = 'map_pl_cpl';
    protected $primaryKey = 'id_map';
    protected $fillable = [
        'id_pl',
        'id_cpl',
        'active'
    ];
    public $timestamps = false;

    public function profilLulusan()
    {
        return $this->belongsTo(ProfilLulusan::class, 'id_pl', 'id_pl');
    }

    public function cpl()
    {
        return $this->belongsTo(CPL::class, 'id_cpl', 'id_cpl');
    }
}
