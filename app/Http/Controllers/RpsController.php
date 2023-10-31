<?php

namespace App\Http\Controllers;

use App\Models\Rps;
use App\Models\CPMK;
use Inertia\Inertia;
use App\Models\Prodi;
use App\Models\MataKuliah;
use App\Models\BahanKajian;
use App\Models\DeskripsiRps;
use Illuminate\Http\Request;
use App\Models\ProfilLulusan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\IndikatorDeskripsiRps;

class RpsController extends Controller
{
    public function listMatakuliah()
    {
        $user = Auth::user();
        return Inertia::render('Main/Dosen/Rps/ListMataKuliah', [
            'mk' =>  DB::table('pengampuan')
                ->select(
                    'mata_kuliah.id_mk',
                    'kode_mk_obe',
                    'kode_mk_undiksha',
                    'nama_mk',
                    'deskripsi_mk',
                    'sks',
                    'semester',
                    'kategori_matakuliah.description as kategori_mk',
                )
                ->join('mata_kuliah', 'pengampuan.id_mk', '=', 'mata_kuliah.id_mk')
                ->join('kategori_matakuliah', 'kategori_matakuliah.id_kategori_mk', 'mata_kuliah.id_kategori_mk')
                ->where('pengampuan.user_id', $user->id)
                ->get(),
        ]);
    }

    public function generateRps($id_mk)
    {
        DB::beginTransaction();
        try {
            $rps = Rps::create([
                'no_doc' => '-',
                'revisi' => 1,
                'id_mk' => $id_mk,
            ]);
            for ($i = 1; $i <= 16; $i++) {
                DeskripsiRps::create([
                    'id_rps' => $rps->id_rps,
                    'pertemuan' => $i,
                    'id_bk' => null,
                    'bentuk_pembelajaran_synchronous' => null,
                    'bentuk_pembelajaran_asynchronous' => null,
                    'waktu' => null,
                    'tugas_dan_penilaian' => null,
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function index(Request $request, $id_mk)
    {
        $user = Auth::user();
        return Inertia::render('Main/Dosen/Rps/Index', [
            'username' => $user->name,
            'subcpmk' => DB::table('map_cpmk_mk')
                ->join('sub_cpmk', 'sub_cpmk.id_map_cpmk_mk', '=', 'map_cpmk_mk.id_map_cpmk_mk')
                ->where('id_mk', '=', $id_mk)
                ->where('id_prodi', '=', $user->prodi)
                ->paginate(10),
            'map_cpmk' => DB::table('map_cpmk_mk')
                ->select('id_map_cpmk_mk', 'kode_cpmk', 'deskripsi_cpmk', 'cpmk.active')
                ->join('cpmk', 'cpmk.id_cpmk', '=', 'map_cpmk_mk.id_cpmk')
                ->where('id_mk', '=', $id_mk)
                ->where('cpmk.id_prodi', '=', $user->prodi)
                ->get(),
            'mk' => MataKuliah::find($id_mk),
            'pl' => ProfilLulusan::select(
                'profil_lulusan.id_pl',
                'profil_lulusan.kode_pl',
                'profil_lulusan.deskripsi_pl',
                'profil_lulusan.unsur'
            )
                ->distinct()
                ->join('map_pl_cpl', 'profil_lulusan.id_pl', '=', 'map_pl_cpl.id_pl')
                ->join('map_cpl_mk', 'map_cpl_mk.id_cpl', '=', 'map_pl_cpl.id_cpl')
                ->where('id_mk', $id_mk)
                ->get(),
            'cpmk' => CPMK::select(
                'cpmk.id_cpmk',
                'kode_cpmk',
                'deskripsi_cpmk'
            )
                ->distinct()
                ->join('map_cpmk_mk', 'map_cpmk_mk.id_cpmk', '=', 'cpmk.id_cpmk')
                ->where('id_mk', $id_mk)
                ->get(),
            'bk' => BahanKajian::select('bahan_kajian.id_bk', 'kode_bk', 'nama_bk')->distinct()
                ->join('map_bk_mk', 'map_bk_mk.id_bk', '=', 'bahan_kajian.id_bk')
                ->where('id_mk', $id_mk)
                ->get(),
            'hasRps' => Rps::where('id_mk', $id_mk)->first() != null,
            'rps' => Rps::select(
                'id_deskripsi_rps',
                'rps.id_rps',
                'id_deskripsi_rps',
                'pertemuan',
                'id_bk',
                'bentuk_pembelajaran_synchronous',
                'bentuk_pembelajaran_asynchronous',
                'waktu',
                'tugas_dan_penilaian'
            )->join('deskripsi_rps', 'rps.id_rps', '=', 'deskripsi_rps.id_rps')
                ->where('id_mk', $id_mk)
                ->get(),
            'nama_prodi' => Prodi::select("nama_prodi")->where('id_prodi', '=', $user->prodi)->first()->nama_prodi,
            'indikator' => IndikatorDeskripsiRps::select('pertemuan', 'sub_cpmk.id_sub_cpmk', 'kode_sub_cpmk', 'deskripsi_sub_cpmk', 'id_indikator_deskripsi_rps', 'deskripsi_rps.id_deskripsi_rps', 'id_map_cpmk_mk')
                ->join('sub_cpmk', 'sub_cpmk.id_sub_cpmk', '=', 'indikator_deskripsi_rps.id_sub_cpmk')
                ->join('deskripsi_rps', 'deskripsi_rps.id_deskripsi_rps', '=', 'indikator_deskripsi_rps.id_deskripsi_rps')
                ->join('rps', 'deskripsi_rps.id_rps', '=', 'rps.id_rps')
                ->where('rps.id_mk', $id_mk)
                ->orderBy('deskripsi_rps.id_deskripsi_rps')
                ->get(),
            'filters' => $request->only(["search"]),
        ]);
    }
}
