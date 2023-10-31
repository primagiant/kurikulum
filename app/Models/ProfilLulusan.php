<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilLulusan extends Model
{
    use HasFactory;
    protected $table = 'profil_lulusan';
    protected $primaryKey = 'id_pl';
    protected $fillable = [
        'id_prodi',
        'kode_pl',
        'deskripsi_pl',
        'unsur',
        'referensi',
        'active'
    ];

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($model) {
            $deletedKodeCPMK = $model->kode_pl;
            self::where('kode_pl', '>', $deletedKodeCPMK)
                ->orderBy('kode_pl')
                ->get()
                ->each(function ($pl) {
                    $currentNumber = intval(substr($pl->kode_pl, 2));
                    $noUrutPL = $currentNumber - 1;
                    $pl->kode_pl = 'PL' . str_pad($noUrutPL, 2, '0', STR_PAD_LEFT);
                    $pl->save();
                });
        });
    }

    public static function createProfilLulusan(array $data)
    {
        $id_prodi = $data['id_prodi'];
        $counter = self::where('id_prodi', $id_prodi)->count() + 1;
        $formattedCounter = str_pad($counter, 2, '0', STR_PAD_LEFT);
        $kode_pl = 'PL' . $formattedCounter;

        return self::create(array_merge($data, [
            'kode_pl' => $kode_pl,
        ]));
    }

    public $timestamps = false;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function cpl()
    {
        return $this->belongsToMany(CPL::class);
    }
}
