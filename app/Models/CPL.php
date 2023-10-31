<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CPL extends Model
{
    use HasFactory;
    protected $table = 'cpl';
    protected $primaryKey = 'id_cpl';
    protected $fillable = [
        'id_prodi',
        'kode_cpl',
        'deskripsi_cpl',
        'unsur',
        'referensi',
        'active'
    ];
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($model) {
            $deletedCPL = $model->kode_cpl;
            self::where('kode_cpl', '>', $deletedCPL)
                ->orderBy('kode_cpl')
                ->get()
                ->each(function ($cpl) {
                    $currentNumber = intval(substr($cpl->kode_cpl, 3));
                    $noUrutCPL = $currentNumber - 1;
                    $cpl->kode_cpl = 'CPL' . str_pad($noUrutCPL, 2, '0', STR_PAD_LEFT);
                    $cpl->save();
                });
        });
    }

    public static function createCPL(array $data)
    {
        $id_prodi = $data['id_prodi'];
        $counter = self::where('id_prodi', $id_prodi)->count() + 1;
        $formattedCounter = str_pad($counter, 2, '0', STR_PAD_LEFT);
        $kode_cpl = 'CPL' . $formattedCounter;

        return self::create(array_merge($data, [
            'kode_cpl' => $kode_cpl,
        ]));
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function profilLulusan()
    {
        return $this->belongsToMany(ProfilLulusan::class);
    }
}
