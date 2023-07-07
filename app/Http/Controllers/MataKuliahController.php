<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Inertia\Inertia;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Main/KoorProdi/Feature/MataKuliah/MataKuliah', [
            'mata_kuliah' => MataKuliah::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('kode_mk_obe', 'like', "%{$search}%")
                        ->OrWhere('kode_mk_undiksha', 'like', "%{$search}%")
                        ->OrWhere('nama_mk', 'like', "%{$search}%")
                        ->OrWhere('deskripsi_mk', 'like', "%{$search}%")
                        ->OrWhere('sks', 'like', "%{$search}%")
                        ->OrWhere('semester', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString(),
            'filters' => $request->only(["search"]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Main/KoorProdi/Feature/MataKuliah/FormAdd');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        //Validate
        $validatedData = $request->validate([
            "kode_mk_obe" => "required",
            "kode_mk_undiksha" => "required",
            "nama_mk" => "required",
            "deskripsi_mk" => "required",
            "sks" => "required",
            "semester" => "required",
        ]);

        // Save
        $mk = MataKuliah::create([
            'id_prodi' => $user->prodi,
            'kode_mk_obe' => $request->input('kode_mk_obe'),
            'kode_mk_undiksha' => $request->input('kode_mk_undiksha'),
            'nama_mk' => $request->input('nama_mk'),
            'deskripsi_mk' => $request->input('deskripsi_mk'),
            'sks' => $request->input('sks'),
            'semester' => $request->input('semester'),
        ]);

        // Redirect
        return to_route('mk.index')->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Created Success"
        ]);
    }
}
