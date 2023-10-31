<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;
    protected $table = 'mata_kuliah';
    protected $primaryKey = 'id_mk';
    protected $fillable = [
        'id_prodi',
        'kode_mk_obe',
        'kode_mk_undiksha',
        'nama_mk',
        'deskripsi_mk',
        'sks',
        'semester',
        'id_kategori_mk',
        'active',
    ];
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($model) {
            $deletedMk = $model->kode_mk_obe;
            self::where('kode_mk_obe', '>', $deletedMk)
                ->orderBy('kode_mk_obe')
                ->get()
                ->each(function ($mk) {
                    $currentNumber = intval(substr($mk->kode_mk_obe, 2));
                    $noUrutCPL = $currentNumber - 1;
                    $mk->kode_mk_obe = 'MK' . str_pad($noUrutCPL, 2, '0', STR_PAD_LEFT);
                    $mk->save();
                });
        });
    }

    public static function createMk(array $data)
    {
        $id_prodi = $data['id_prodi'];
        $counter = self::where('id_prodi', $id_prodi)->count() + 1;
        $formattedCounter = str_pad($counter, 2, '0', STR_PAD_LEFT);
        $kode_mk_obe = 'MK' . $formattedCounter;

        return self::create(array_merge($data, [
            'kode_mk_obe' => $kode_mk_obe,
        ]));
    }


    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function kategoriMataKuliah()
    {
        return $this->belongsTo(KategoriMatakuliah::class, 'id_kategori_mk', 'id_kategori_mk');
    }
}
