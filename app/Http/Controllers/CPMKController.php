<?php

namespace App\Http\Controllers;

use App\Models\CPMK;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CPMKController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();
        return Inertia::render("Main/KoorProdi/Feature/CPMK", [
            'cpmk' => DB::table('cpmk')
                ->join('cpl', 'cpl.id_cpl', '=', 'cpmk.id_cpl')
                ->select([
                    'cpmk.id_cpmk', 'cpmk.kode_cpmk',
                    'cpmk.deskripsi_cpmk',
                    'cpmk.active as active_cpmk',
                    'cpl.id_cpl', 'cpl.kode_cpl'
                ])
                ->where('cpmk.id_prodi', '=', $user->prodi)
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('cpmk.kode_cpmk', 'like', "%{$search}%")
                        ->OrWhere('cpmk.deskripsi_cpmk', 'like', "%{$search}%")
                        ->OrWhere('cpl.kode_cpl', 'like', "%{$search}%");
                })
                ->orderBy('cpmk.kode_cpmk')
                ->paginate(10),
            'filters' => $request->only(["search"]),
            'cpl' => DB::table('cpl')
                ->where('cpl.id_prodi', '=', $user->prodi)
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        //Validate
        $request->validate([
            "id_cpl" => "required",
            "deskripsi_cpmk" => "required",
        ]);

        // Save
        CPMK::createCPMK([
            'id_prodi' => $user->prodi,
            'id_cpl' => $request->input('id_cpl'),
            'deskripsi_cpmk' => $request->input('deskripsi_cpmk'),
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
        $cpmk = CPMK::findOrFail($id);

        // Validate
        $request->validate([
            "deskripsi_cpmk" => "required",
        ]);

        // Update
        $cpmk->deskripsi_cpmk = $request->input('deskripsi_cpmk');

        // Save Update
        $cpmk->save();

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Updated Success"
        ]);
    }

    public function destroy($id)
    {
        // Check If user exist
        $cpmk = CPMK::findOrFail($id);

        // Delete
        $cpmk->delete();

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Deleted Success"
        ]);
    }
}
