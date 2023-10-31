<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCpmk extends Model
{
    use HasFactory;
    protected $table = 'sub_cpmk';
    protected $primaryKey = 'id_sub_cpmk';
    protected $fillable = [
        'id_prodi',
        'id_map_cpmk_mk',
        'kode_sub_cpmk',
        'deskripsi_sub_cpmk',
        'active'
    ];
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($model) {
            $deletedKodeSubCPMK = $model->kode_sub_cpmk;

            $id_map_cpmk_mk = $model->id_map_cpmk_mk;
            $cpmk = DB::table('map_cpmk_mk')
                ->select('map_cpmk_mk.id_cpmk')
                ->join('cpmk', 'cpmk.id_cpmk', '=', 'map_cpmk_mk.id_cpmk')
                ->where('id_map_cpmk_mk', $id_map_cpmk_mk)->first();

            // Update urutan kode PL setelah penghapusan
            self::join('map_cpmk_mk', 'map_cpmk_mk.id_map_cpmk_mk', '=', 'sub_cpmk.id_map_cpmk_mk')
                ->where('id_cpmk', $cpmk->id_cpmk)
                ->where('kode_sub_cpmk', '>', $deletedKodeSubCPMK)
                ->orderBy('kode_sub_cpmk')
                ->get()
                ->each(function ($subcpmk) {
                    $firstSection = substr($subcpmk->kode_sub_cpmk, 0, 11);
                    $currentNumber = intval(substr($subcpmk->kode_sub_cpmk, 11));
                    $subcpmk->kode_sub_cpmk = $firstSection . ($currentNumber - 1);
                    $subcpmk->save();
                });
        });
    }

    public static function createSubCpmk(array $data)
    {
        $id_map_cpmk_mk = $data['id_map_cpmk_mk'];
        $cpmk = DB::table('map_cpmk_mk')
            ->select('map_cpmk_mk.id_cpmk', 'kode_cpmk')
            ->join('cpmk', 'cpmk.id_cpmk', '=', 'map_cpmk_mk.id_cpmk')
            ->where('id_map_cpmk_mk', $id_map_cpmk_mk)->first();
        $noUrutCPMK = substr($cpmk->kode_cpmk, 4, 3);
        $noUrutSubCpmk = DB::table('sub_cpmk')
            ->select('kode_sub_cpmk')
            ->join('map_cpmk_mk', 'map_cpmk_mk.id_map_cpmk_mk', '=', 'sub_cpmk.id_map_cpmk_mk')
            ->where('id_cpmk', $cpmk->id_cpmk)->count() + 1;
        $kode_sub_cpmk = 'Sub-CPMK' . $noUrutCPMK . $noUrutSubCpmk;

        return self::create(array_merge($data, [
            'kode_sub_cpmk' => $kode_sub_cpmk,
        ]));
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function mapCpmkMk()
    {
        return $this->belongsTo(MapCpmkMk::class, 'id_map_cpmk_mk', 'id_map_cpmk_mk');
    }
}
