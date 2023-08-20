<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengampuan extends Model
{
    use HasFactory;
    protected $table = 'pengampuan';
    protected $primaryKey = 'id_pengampuan';
    protected $fillable = [
        'user_id',
        'id_mk',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }
}
