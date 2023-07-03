<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapCplBk extends Model
{
    use HasFactory;
    protected $table = 'map_cpl_bk';
    protected $primaryKey = 'id_map_cpl_bk';
    protected $fillable = [
        'id_cpl',
        'id_bk',
        'active'
    ];
    public $timestamps = false;

    public function cpl()
    {
        return $this->belongsTo(CPL::class, 'id_cpl', 'id_cpl');
    }

    public function bahanKajian()
    {
        return $this->belongsTo(BahanKajian::class, 'id_bk', 'id_bk');
    }
}
