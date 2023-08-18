<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Models\KategoriMatakuliah;
use Illuminate\Support\Facades\DB;

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
        return Inertia::render('Main/KoorProdi/Feature/MataKuliah/FormAdd', [
            'kategori_mk_list' => KategoriMatakuliah::all()
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        //Validate
        $validatedData = $request->validate([
            "kode_mk_obe" => "required|min:4|max:4|alpha_num",
            "kode_mk_undiksha" => "required|min:10|max:10|alpha_num",
            "nama_mk" => "required",
            "deskripsi_mk" => "required",
            "sks" => "required",
            "semester" => "required",
            "kategori_matakuliah" => "required",
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
            'id_kategori_mk' => $request->input('kategori_matakuliah')
        ]);

        // Redirect
        return to_route('mk.index')->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Created Success"
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('Main/KoorProdi/Feature/MataKuliah/FormEdit', [
            'mk' =>  MataKuliah::find($id),
            'kategori_mk_list' => KategoriMatakuliah::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            // Check If user exist
            $mk = MataKuliah::findOrFail($id);

            // Validate
            $request->validate([
                "kode_mk_obe" => "required|digits:4|alpha_num",
                "kode_mk_undiksha" => "required|digits:4|alpha_num",
                "nama_mk" => "required",
                "deskripsi_mk" => "required",
                "sks" => "required",
                "semester" => "required",
                "kategori_matakuliah" => "required",
            ]);

            // Update
            $mk->kode_mk_obe = $request->input('kode_mk_obe');
            $mk->kode_mk_undiksha = $request->input('kode_mk_undiksha');
            $mk->nama_mk = $request->input('nama_mk');
            $mk->deskripsi_mk = $request->input('deskripsi_mk');
            $mk->sks = $request->input('sks');
            $mk->semester = $request->input('semester');
            $mk->id_kategori_mk = $request->input('kategori_matakuliah');

            // Save Update
            $mk->save();

            // Redirect
            return to_route('mk.index')->with("msg", [
                "type" => "success", // success | error | warning | info | question
                "text" => "Updated Success"
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            // Check If user exist
            $mk = MataKuliah::findOrFail($id);

            // Delete
            $mk->delete();

            // Redirect
            return to_route('user.index')->with("msg", [
                "type" => "success", // success | error | warning | info | question
                "text" => "Deleted Success"
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
