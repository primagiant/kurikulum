<?php

namespace App\Http\Controllers;

use App\Models\SubCpmk;
use App\Models\MapCpmkMk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCPMKController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            "id_map_cpmk_mk" => "required",
            "deskripsi_sub_cpmk" => "required",
        ]);

        // Save
        SubCpmk::createSubCpmk([
            'id_prodi' => $user->prodi,
            'id_map_cpmk_mk' => $request->input('id_map_cpmk_mk'),
            'deskripsi_sub_cpmk' => $request->input('deskripsi_sub_cpmk'),
            'active' => 1,
        ]);

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Created Success"
        ]);
    }

    public function update(Request $request, $id)
    {
        // Check If user exist
        $subcpmk = SubCpmk::findOrFail($id);

        // Validate
        $request->validate([
            "deskripsi_sub_cpmk" => "required",
        ]);

        // Update
        $subcpmk->deskripsi_sub_cpmk = $request->input('deskripsi_sub_cpmk');

        // Save Update
        $subcpmk->save();

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Updated Success"
        ]);
    }

    public function destroy($id)
    {
        // Check If user exist
        $subcpmk = SubCpmk::findOrFail($id);

        // Delete
        $subcpmk->delete();

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Deleted Success"
        ]);
    }
}
