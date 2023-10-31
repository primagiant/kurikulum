<?php

namespace App\Http\Controllers;

use App\Models\CPL;
use App\Models\MataKuliah;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AlurInputDosenController extends Controller
{
    public function listMatakuliah()
    {
        $user = Auth::user();
        return Inertia::render('Main/Dosen/ListMataKuliah', [
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

    public function listSubCpmk(Request $request, $id_mk)
    {
        $user = Auth::user();
        return Inertia::render('Main/Dosen/SubCpmk', [
            'subcpmk' => DB::table('map_cpmk_mk')
                ->join('sub_cpmk', 'sub_cpmk.id_map_cpmk_mk', '=', 'map_cpmk_mk.id_map_cpmk_mk')
                ->where('id_mk', '=', $id_mk)
                ->where('id_prodi', '=', $user->prodi)
                ->paginate(10),
            'cpmk' => DB::table('map_cpmk_mk')
                ->select('id_map_cpmk_mk', 'kode_cpmk', 'deskripsi_cpmk', 'cpmk.active')
                ->join('cpmk', 'cpmk.id_cpmk', '=', 'map_cpmk_mk.id_cpmk')
                ->where('id_mk', '=', $id_mk)
                ->where('cpmk.id_prodi', '=', $user->prodi)
                ->get(),
            'mk' => MataKuliah::find($id_mk),
            'filters' => $request->only(["search"]),
        ]);
    }
}
