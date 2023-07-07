<?php

namespace App\Http\Controllers;

use App\Models\CPL;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CPLController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Main/KoorProdi/Feature/CPL/CapaianProfilLulusan', [
            'cpl' => CPL::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('kode_cpl', 'like', "%{$search}%")
                        ->OrWhere('unsur', 'like', "%{$search}%")
                        ->OrWhere('deskripsi_cpl', 'like', "%{$search}%")
                        ->OrWhere('referensi', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString(),
            'filters' => $request->only(["search"]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Main/KoorProdi/Feature/CPL/FormAdd');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        //Validate
        $validatedData = $request->validate([
            "kode_cpl" => "required",
            "deskripsi_cpl" => "required",
            "unsur" => "required",
            "referensi" => "required",
        ]);

        // Save
        $cpl = CPL::create([
            'id_prodi' => $user->prodi,
            'kode_cpl' => $request->input('kode_cpl'),
            'deskripsi_cpl' => $request->input('deskripsi_cpl'),
            'unsur' => $request->input('unsur'),
            'referensi' => $request->input('referensi'),
        ]);

        // Redirect
        return to_route('cpl.index')->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Created Success"
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('Main/KoorProdi/Feature/CPL/FormEdit', [
            'cpl' => CPL::select('id_cpl', 'kode_cpl', 'deskripsi_cpl', 'unsur', 'referensi')->find($id),
        ]);
    }

    public function destroy($id)
    {
        try {
            // Check If data exist
            $cpl = CPL::findOrFail($id);

            // Delete
            $cpl->delete();

            // Redirect
            return to_route('cpl.index')->with("msg", [
                "type" => "success", // success | error | warning | info | question
                "text" => "Deleted Success"
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
