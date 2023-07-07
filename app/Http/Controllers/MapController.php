<?php

namespace App\Http\Controllers;

use App\Models\BahanKajian;
use App\Models\CPL;
use App\Models\MapBkMk;
use App\Models\MapCplBk;
use App\Models\MapCplMk;
use App\Models\MapPlCpl;
use App\Models\MataKuliah;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
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

        $exists = false;
        $maping = MapPlCpl::whereHas('profilLulusan', function ($query) {
            $query->where('id_prodi', 1);
        })->select('id_cpl', 'id_pl')->where('active', 1)->get();
        foreach ($maping as $item) {
            if ($item->id_pl == $id_pl && $item->id_cpl == $id_cpl) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            // Delete Relation
            try {
                $mapPlCpl = MapPlCpl::where('id_cpl', $id_cpl)
                    ->where('id_pl', $id_pl)
                    ->first();
                $mapPlCpl->delete();
            } catch (\Throwable $th) {
            }
        } else {
            // Create Relation
            try {
                $mapPlCpl = MapPlCpl::create([
                    'id_cpl' => $id_cpl,
                    'id_pl' => $id_pl,
                ]);
            } catch (\Throwable $th) {
            }
        }
    }

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

        $exists = false;
        $maping = MapCplBk::whereHas('bahanKajian', function ($query) {
            $query->where('id_prodi', 1);
        })->select('id_cpl', 'id_bk')->where('active', 1)->get();
        foreach ($maping as $item) {
            if ($item->id_bk == $id_bk && $item->id_cpl == $id_cpl) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            // Delete Relation
            try {
                $mapCplBk = MapCplBk::where('id_cpl', $id_cpl)
                    ->where('id_bk', $id_bk)
                    ->first();
                $mapCplBk->delete();
            } catch (\Throwable $th) {
            }
        } else {
            // Create Relation
            try {
                $mapCplBk = MapCplBk::create([
                    'id_cpl' => $id_cpl,
                    'id_bk' => $id_bk,
                ]);
            } catch (\Throwable $th) {
            }
        }
    }

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

        $exists = false;
        $maping = MapBkMk::whereHas('bahanKajian', function ($query) {
            $query->where('id_prodi', 1);
        })->select('id_mk', 'id_bk')->where('active', 1)->get();
        foreach ($maping as $item) {
            if ($item->id_bk == $id_bk && $item->id_mk == $id_mk) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            // Delete Relation
            try {
                $mapBKMk = MapBkMk::where('id_mk', $id_mk)
                    ->where('id_bk', $id_bk)
                    ->first();
                $mapBKMk->delete();
            } catch (\Throwable $th) {
            }
        } else {
            // Create Relation
            try {
                $mapBKMk = MapBkMk::create([
                    'id_mk' => $id_mk,
                    'id_bk' => $id_bk,
                ]);
            } catch (\Throwable $th) {
            }
        }
    }

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

        $exists = false;
        $maping = MapCplMk::whereHas('cpl', function ($query) {
            $query->where('id_prodi', 1);
        })->select('id_mk', 'id_cpl')->where('active', 1)->get();
        foreach ($maping as $item) {
            if ($item->id_cpl == $id_cpl && $item->id_mk == $id_mk) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            // Delete Relation
            try {
                $mapCplMk = MapCplMk::where('id_mk', $id_mk)
                    ->where('id_cpl', $id_cpl)
                    ->first();
                $mapCplMk->delete();
            } catch (\Throwable $th) {
            }
        } else {
            // Create Relation
            MapCplMk::create([
                'id_mk' => $id_mk,
                'id_cpl' => $id_cpl,
            ]);
        }
    }

    public function bkCplMk()
    {
    }

    public function mapingBkCplMk(Request $request)
    {
    }
}
