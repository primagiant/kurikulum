<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanKajian extends Model
{
    use HasFactory;
    protected $table = 'bahan_kajian';
    protected $primaryKey = 'id_bk';
    protected $fillable = [
        'id_prodi',
        'kode_bk',
        'nama_bk',
        'deskripsi_bk',
        'bobot_min',
        'bobot_max',
        'active'
    ];
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($model) {
            $deletedBk = $model->kode_bk;
            self::where('kode_bk', '>', $deletedBk)
                ->orderBy('kode_bk')
                ->get()
                ->each(function ($bk) {
                    $currentNumber = intval(substr($bk->kode_bk, 2));
                    $noUrutCPL = $currentNumber - 1;
                    $bk->kode_bk = 'BK' . str_pad($noUrutCPL, 2, '0', STR_PAD_LEFT);
                    $bk->save();
                });
        });
    }

    public static function createBk(array $data)
    {
        $id_prodi = $data['id_prodi'];
        $counter = self::where('id_prodi', $id_prodi)->count() + 1;
        $formattedCounter = str_pad($counter, 2, '0', STR_PAD_LEFT);
        $kode_bk = 'BK' . $formattedCounter;

        return self::create(array_merge($data, [
            'kode_bk' => $kode_bk,
        ]));
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }
}
