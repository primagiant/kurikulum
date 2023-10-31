<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Models\KategoriMatakuliah;
use Illuminate\Support\Facades\Auth;

class MatakuliahController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        return Inertia::render('Main/KoorProdi/Feature/MK', [
            'mk' => MataKuliah::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('kode_mk_obe', 'like', "%{$search}%")
                        ->OrWhere('kode_mk_undiksha', 'like', "%{$search}%")
                        ->OrWhere('nama_mk', 'like', "%{$search}%")
                        ->OrWhere('deskripsi_mk', 'like', "%{$search}%")
                        ->OrWhere('sks', 'like', "%{$search}%")
                        ->OrWhere('semester', 'like', "%{$search}%");
                })
                ->where('id_prodi', '=', $user->prodi)
                ->orderBy("kode_mk_obe")
                ->paginate(10)
                ->withQueryString(),
            'filters' => $request->only(["search"]),
            'kategori_mk_list' => KategoriMatakuliah::all()
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        //Validate
        $request->validate([
            "nama_mk" => "required",
            "deskripsi_mk" => "required", // nanti uncommand
            "sks" => "required",
            "semester" => "required",
            "kategori_matakuliah" => "required",
        ]);

        // Save
        MataKuliah::createMk([
            'id_prodi' => $user->prodi,
            'kode_mk_undiksha' => "-", // nanti di perbaiki ubah sesuai dengan prodi
            // 'kode_mk_undiksha' => $request->input('kode_mk_undiksha'), // nanti di perbaiki ubah sesuai dengan prodi
            'nama_mk' => $request->input('nama_mk'),
            'deskripsi_mk' => $request->input('deskripsi_mk'), // nanti uncommand
            'sks' => $request->input('sks'),
            'semester' => $request->input('semester'),
            'id_kategori_mk' => $request->input('kategori_matakuliah')
        ]);

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Create Success"
        ]);
    }

    public function update(Request $request, $id)
    {

        // Check If user exist
        $mk = MataKuliah::findOrFail($id);

        // Validate
        $request->validate([
            "nama_mk" => "required",
            "deskripsi_mk" => "required",
            "sks" => "required",
            "semester" => "required",
            "kategori_matakuliah" => "required",
        ]);

        // Update
        $mk->kode_mk_undiksha = "-";
        $mk->nama_mk = $request->input('nama_mk');
        $mk->deskripsi_mk = $request->input('deskripsi_mk');
        $mk->sks = $request->input('sks');
        $mk->semester = $request->input('semester');
        $mk->id_kategori_mk = $request->input('kategori_matakuliah');

        // Save Update
        $mk->save();

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Update Success"
        ]);
    }

    public function destroy($id)
    {
        // Check If user exist
        $mk = MataKuliah::findOrFail($id);

        // Delete
        $mk->delete();

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Deleted Success"
        ]);
    }
}
