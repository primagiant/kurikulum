<?php

namespace App\Http\Controllers;

use App\Models\CPL;
use App\Models\MapPlCpl;
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
        return Inertia::render("Main/KoorProdi/Feature/Map/BkToCpl");
    }

    public function bkToMk()
    {
        return Inertia::render("Main/KoorProdi/Feature/Map/BkToMk");
    }

    public function cplToMk()
    {
        return Inertia::render("Main/KoorProdi/Feature/Map/CplToMk");
    }
}
