<?php

namespace App\Http\Controllers;

use App\Models\CPL;
use App\Models\CPMK;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CPMKController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Main/KoorProdi/Feature/CPMK/CPMK', [
            'cpmk' => CPMK::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('kode_cpmk', 'like', "%{$search}%")
                        ->OrWhere('deskripsi_cpl', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString(),
            'filters' => $request->only(["search"]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Main/KoorProdi/Feature/CPMK/FormAdd', [
            'cpl' => CPL::All()
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        //Validate
        $validatedData = $request->validate([
            "id_cpl" => "required",
            "kode_cpmk" => "required",
            "deskripsi_cpmk" => "required",
        ]);

        // Save
        $cpl = CPMK::create([
            'id_prodi' => $user->prodi,
            'id_cpl' => $request->input('id_cpl'),
            'kode_cpmk' => $request->input('kode_cpmk'),
            'deskripsi_cpmk' => $request->input('deskripsi_cpmk'),
        ]);

        // Redirect
        return to_route('cpmk.index')->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Created Success"
        ]);
    }
}
