<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CPMK extends Model
{
    use HasFactory;
    protected $table = 'cpmk';
    protected $primaryKey = 'id_cpmk';
    protected $fillable = [
        'id_prodi',
        'id_cpl',
        'kode_cpmk',
        'deskripsi_cpmk',
        'active'
    ];
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($model) {
            $deletedKodeCPMK = $model->kode_cpmk;

            // Update urutan kode PL setelah penghapusan
            self::where('kode_cpmk', '>', $deletedKodeCPMK)
                ->orderBy('kode_cpmk')
                ->get()
                ->each(function ($cpmk) {
                    $noUrutCPL = substr(CPL::find($cpmk->id_cpl)->kode_cpl, 3, 4);
                    $currentNumber = intval(substr($cpmk->kode_cpmk, 7));
                    $noUrutCPMK = $currentNumber - 1;
                    $cpmk->kode_cpmk = 'CPMK' . $noUrutCPL . $noUrutCPMK;
                    $cpmk->save();
                });
        });
    }

    public static function createCPMK(array $data)
    {
        $id_cpl = $data['id_cpl'];
        $id_prodi = $data['id_prodi'];
        $noUrutCPL = substr(CPL::find($id_cpl)->kode_cpl, 3, 4);
        $noUrutCPMK = self::where('id_prodi', $id_prodi)->where('id_cpl', $id_cpl)->count() + 1;
        $kode_cpmk = 'CPMK' . $noUrutCPL . $noUrutCPMK;

        return self::create(array_merge($data, [
            'kode_cpmk' => $kode_cpmk,
        ]));
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function cpl()
    {
        return $this->belongsTo(CPL::class, 'id_cpl', 'id_cpl');
    }
}
