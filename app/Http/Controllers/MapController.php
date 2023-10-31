<?php

namespace App\Http\Controllers;

use App\Models\CPL;
use App\Models\CPMK;
use Inertia\Inertia;
use App\Models\MapBkMk;
use App\Models\MapCplBk;
use App\Models\MapCplMk;
use App\Models\MapPlCpl;
use App\Models\MataKuliah;
use App\Models\BahanKajian;
use App\Models\MapCpmkMk;
use Illuminate\Http\Request;
use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    // Maping CPL - PL
    public function cplToPl(Request $request)
    {
        $user = auth()->user();
        return Inertia::render("Main/KoorProdi/Feature/Map/CplToPl", [
            'cpl' => CPL::select('id_cpl', 'kode_cpl', 'deskripsi_cpl')
                ->where('id_prodi', $user->prodi)
                ->where('active', 1)
                ->get(),
            'pl' => ProfilLulusan::select('id_pl', 'kode_pl', 'deskripsi_pl')
                ->where('id_prodi', $user->prodi)
                ->where('active', 1)
                ->get(),
            'maping' => DB::table('map_pl_cpl')
                ->join('profil_lulusan', 'map_pl_cpl.id_pl', '=', 'profil_lulusan.id_pl')
                ->join('cpl', 'map_pl_cpl.id_cpl', '=', 'cpl.id_cpl')
                ->where('map_pl_cpl.active', 1)
                ->where('cpl.id_prodi', 1)
                ->get(),
        ]);
    }

    public function mapingCplToPl(Request $request)
    {
        $id_pl = $request->input('id_pl');
        $id_cpl = $request->input('id_cpl');

        $exists = DB::table('map_pl_cpl')->select('id_map')
            ->where('id_pl', $id_pl)
            ->where('id_cpl', $id_cpl)
            ->first();

        if ($exists != null) {
            // Delete Relation
            $mapPlCpl = MapPlCpl::where('id_cpl', $id_cpl)
                ->where('id_pl', $id_pl)
                ->first();
            $mapPlCpl->delete();
        } else {
            // Create Relation
            $mapPlCpl = MapPlCpl::create([
                'id_cpl' => $id_cpl,
                'id_pl' => $id_pl,
            ]);
        }
    }

    // Maping BK - CPL
    public function bkToCpl()
    {
        $user = auth()->user();
        return Inertia::render("Main/KoorProdi/Feature/Map/BkToCpl", [
            'cpl' => CPL::select('id_cpl', 'kode_cpl', 'deskripsi_cpl')
                ->where('id_prodi', $user->prodi)
                ->where('active', 1)
                ->get(),
            'bk' => BahanKajian::select('id_bk', 'kode_bk', 'nama_bk', 'deskripsi_bk')
                ->where('id_prodi', $user->prodi)
                ->where('active', 1)
                ->get(),
            'maping' => DB::table('map_cpl_bk')
                ->join('bahan_kajian', 'map_cpl_bk.id_bk', '=', 'bahan_kajian.id_bk')
                ->join('cpl', 'map_cpl_bk.id_cpl', '=', 'cpl.id_cpl')
                ->where('map_cpl_bk.active', 1)
                ->where('cpl.id_prodi', 1)
                ->get(),
        ]);
    }

    public function mapingBkToCpl(Request $request)
    {
        $id_bk = $request->input('id_bk');
        $id_cpl = $request->input('id_cpl');

        $exists = DB::table('map_cpl_bk')->select('id_map_cpl_bk')
            ->where('id_bk', $id_bk)
            ->where('id_cpl', $id_cpl)
            ->first();

        if ($exists != null) {
            // Delete Relation
            $mapCplBk = MapCplBk::where('id_cpl', $id_cpl)
                ->where('id_bk', $id_bk)
                ->first();
            $mapCplBk->delete();
        } else {
            // Create Relation
            $mapCplBk = MapCplBk::create([
                'id_cpl' => $id_cpl,
                'id_bk' => $id_bk,
            ]);
        }
    }

    // Maping BK - MK
    public function bkToMk()
    {
        $user = auth()->user();
        return Inertia::render("Main/KoorProdi/Feature/Map/BkToMk", [
            'mk' => MataKuliah::select('id_mk', 'kode_mk_obe', 'kode_mk_undiksha', 'nama_mk', 'deskripsi_mk')
                ->where('id_prodi', $user->prodi)
                ->where('active', 1)
                ->get(),
            'bk' => BahanKajian::select('id_bk', 'kode_bk', 'nama_bk', 'deskripsi_bk')
                ->where('id_prodi', $user->prodi)
                ->where('active', 1)
                ->get(),
            'maping' => DB::table('map_bk_mk')
                ->join('bahan_kajian', 'map_bk_mk.id_bk', '=', 'bahan_kajian.id_bk')
                ->join('mata_kuliah', 'map_bk_mk.id_mk', '=', 'mata_kuliah.id_mk')
                ->where('map_bk_mk.active', 1)
                ->where('bahan_kajian.id_prodi', 1)
                ->get(),
        ]);
    }

    public function mapingBkToMk(Request $request)
    {
        $id_bk = $request->input('id_bk');
        $id_mk = $request->input('id_mk');

        $exists = DB::table('map_bk_mk')->select('id_map_bk_mk')
            ->where('id_bk', $id_bk)
            ->where('id_mk', $id_mk)
            ->first();

        if ($exists != null) {
            // Delete Relation
            $mapBKMk = MapBkMk::where('id_mk', $id_mk)
                ->where('id_bk', $id_bk)
                ->first();
            $mapBKMk->delete();
        } else {
            // Create Relation
            $mapBKMk = MapBkMk::create([
                'id_mk' => $id_mk,
                'id_bk' => $id_bk,
            ]);
        }
    }

    // Maping CPL - MK
    public function cplToMk()
    {
        $user = auth()->user();
        return Inertia::render("Main/KoorProdi/Feature/Map/CplToMk", [
            'cpl' => CPL::select('id_cpl', 'kode_cpl', 'deskripsi_cpl')
                ->where('id_prodi', $user->prodi)
                ->where('active', 1)
                ->get(),
            'mk' => MataKuliah::select('id_mk', 'kode_mk_obe', 'kode_mk_undiksha', 'nama_mk', 'deskripsi_mk')
                ->where('id_prodi', $user->prodi)
                ->where('active', 1)
                ->get(),
            'maping' => DB::table('map_cpl_mk')
                ->join('cpl', 'map_cpl_mk.id_cpl', '=', 'cpl.id_cpl')
                ->join('mata_kuliah', 'map_cpl_mk.id_mk', '=', 'mata_kuliah.id_mk')
                ->where('map_cpl_mk.active', 1)
                ->where('cpl.id_prodi', 1)
                ->get(),
        ]);
    }

    public function mapingCplToMk(Request $request)
    {
        $id_cpl = $request->input('id_cpl');
        $id_mk = $request->input('id_mk');

        $exists = DB::table('map_cpl_mk')->select('id_map_cpl_mk')
            ->where('id_cpl', $id_cpl)
            ->where('id_mk', $id_mk)
            ->first();

        if ($exists != null) {
            // Delete Relation
            $mapCplMk = MapCplMk::where('id_mk', $id_mk)
                ->where('id_cpl', $id_cpl)
                ->first();
            $mapCplMk->delete();
        } else {
            // Create Relation
            MapCplMk::create([
                'id_mk' => $id_mk,
                'id_cpl' => $id_cpl,
            ]);
        }
    }

    // Maping CPMK - MK
    public function cpmkToMk()
    {
        $user = auth()->user();
        return Inertia::render("Main/KoorProdi/Feature/Map/CpmkToMk", [
            'cpmk' => CPMK::select('id_cpmk', 'kode_cpmk', 'deskripsi_cpmk')
                ->where('id_prodi', $user->prodi)
                ->where('active', 1)
                ->get(),
            'mk' => MataKuliah::select('id_mk', 'kode_mk_obe', 'kode_mk_undiksha', 'nama_mk', 'deskripsi_mk')
                ->where('id_prodi', $user->prodi)
                ->where('active', 1)
                ->get(),
            'maping' => DB::table('map_cpmk_mk')
                ->join('mata_kuliah', 'map_cpmk_mk.id_mk', '=', 'mata_kuliah.id_mk')
                ->where('map_cpmk_mk.active', 1)
                ->where('mata_kuliah.id_prodi', 1)
                ->get(),
        ]);
    }

    public function mapingCpmkToMk(Request $request)
    {
        $id_cpmk = $request->input('id_cpmk');
        $id_mk = $request->input('id_mk');

        $exists = DB::table('map_cpmk_mk')->select('id_map_cpmk_mk')
            ->where('id_cpmk', $id_cpmk)
            ->where('id_mk', $id_mk)
            ->first();

        if ($exists != null) {
            // Delete Relation
            $mapCpmkMk = MapCpmkMk::where('id_mk', $id_mk)
                ->where('id_cpmk', $id_cpmk)
                ->first();
            $mapCpmkMk->delete();
        } else {
            // Create Relation
            MapCpmkMk::create([
                'id_mk' => $id_mk,
                'id_cpmk' => $id_cpmk,
            ]);
        }
    }

    // Maping BK - CPL - MK
    public function bkCplMk()
    {
        $user = auth()->user();
        return Inertia::render("Main/KoorProdi/Feature/Map/BkCplMk", [
            'cpl' => CPL::select('id_cpl', 'kode_cpl', 'deskripsi_cpl')
                ->where('id_prodi', $user->prodi)
                ->where('active', 1)
                ->get(),
            'bk' => BahanKajian::select('id_bk', 'kode_bk', 'nama_bk', 'deskripsi_bk')
                ->where('id_prodi', $user->prodi)
                ->where('active', 1)
                ->get(),
            'mk' => DB::table('map_cpl_mk')
                ->select('id_cpl', 'id_bk', 'mata_kuliah.id_mk', 'kode_mk_obe', 'nama_mk')
                ->join('map_bk_mk', 'map_cpl_mk.id_mk', '=', 'map_bk_mk.id_mk')
                ->join('mata_kuliah', 'map_cpl_mk.id_mk', '=', 'mata_kuliah.id_mk')
                ->where('map_cpl_mk.active', 1)
                ->where('map_bk_mk.active', 1)
                ->where('mata_kuliah.active', 1)
                ->where('mata_kuliah.id_prodi', $user->prodi)
                ->orderBy('mata_kuliah.kode_mk_obe')
                ->get(),
        ]);
    }

    // Maping CPL - CPMK - MK
    public function cplCpmkMk()
    {
        $user = auth()->user();
        return Inertia::render("Main/KoorProdi/Feature/Map/CplCpmkMk", [
            'data' => DB::table('map_cpmk_mk')
                ->select(
                    'cpl.id_cpl',
                    'cpl.kode_cpl',
                    'cpl.deskripsi_cpl',
                    'cpmk.id_cpmk',
                    'cpmk.kode_cpmk',
                    'cpmk.deskripsi_cpmk',
                    'mata_kuliah.id_mk',
                    'mata_kuliah.kode_mk_obe',
                    'mata_kuliah.nama_mk',
                )
                ->join('mata_kuliah', 'map_cpmk_mk.id_mk', '=', 'mata_kuliah.id_mk')
                ->join('cpmk', 'map_cpmk_mk.id_cpmk', '=', 'cpmk.id_cpmk')
                ->join('cpl', 'cpmk.id_cpl', '=', 'cpl.id_cpl')
                ->where('mata_kuliah.id_prodi', $user->prodi)
                ->orderBy('cpl.id_cpl')
                ->get(),
        ]);
    }
}
