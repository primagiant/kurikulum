<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMatakuliah extends Model
{
    use HasFactory;
    protected $table = 'kategori_matakuliah';
    protected $primaryKey = 'id_kategori_mk';
    protected $fillable = [
        'description',
    ];

    public $timestamps = false;

    public function matakuliah()
    {
        return $this->hasMany(MataKuliah::class);
    }
}
