<?php

namespace App\Http\Controllers;

use App\Models\SubCpmk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IndikatorDeskripsiRps;

class IndikatorDeskripsiRpsController extends Controller
{
    public function store(Request $request, $id_deskripsi_rps)
    {
        $user = auth()->user();
        $request->validate([
            "id_map_cpmk_mk" => "required",
            "deskripsi_sub_cpmk" => "required",
        ]);

        DB::beginTransaction();

        try {
            // Save
            $subcpmk = SubCpmk::createSubCpmk([
                'id_prodi' => $user->prodi,
                'id_map_cpmk_mk' => $request->input('id_map_cpmk_mk'),
                'deskripsi_sub_cpmk' => $request->input('deskripsi_sub_cpmk'),
                'active' => 1,
            ]);

            IndikatorDeskripsiRps::create([
                'id_deskripsi_rps' => $id_deskripsi_rps,
                'id_sub_cpmk' => $subcpmk->id_sub_cpmk,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Created Success"
        ]);
    }

    public function destroy($id_sub_cpmk, $id_indikator_rps)
    {
        DB::beginTransaction();
        try {
            $indikator = IndikatorDeskripsiRps::findOrFail($id_indikator_rps);
            $indikator->delete();

            $subcpmk = SubCpmk::findOrFail($id_sub_cpmk);
            $subcpmk->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Deleted Success"
        ]);
    }
}
