<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapBkMk extends Model
{
    use HasFactory;
    protected $table = 'map_bk_mk';
    protected $primaryKey = 'id_map_bk_mk';
    protected $fillable = [
        'id_bk',
        'id_mk',
        'active'
    ];
    public $timestamps = false;

    public function bahanKajian()
    {
        return $this->belongsTo(BahanKajian::class, 'id_bk', 'id_bk');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }
}
