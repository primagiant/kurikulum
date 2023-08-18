<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ProfilLulusan;

class ProfilLulusanController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Main/KoorProdi/Feature/ProfilLulusan/ProfilLulusan', [
            'profil_lulusan' => ProfilLulusan::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('kode_pl', 'like', "%{$search}%")
                        ->OrWhere('unsur', 'like', "%{$search}%")
                        ->OrWhere('deskripsi_pl', 'like', "%{$search}%")
                        ->OrWhere('referensi', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString(),
            'filters' => $request->only(["search"]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Main/KoorProdi/Feature/ProfilLulusan/FormAdd');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        //Validate
        $validatedData = $request->validate([
            "kode_pl" => "required",
            "deskripsi_pl" => "required",
            "unsur" => "required",
            "referensi" => "required",
        ]);

        // Save
        $profi_lulusan = ProfilLulusan::create([
            'id_prodi' => $user->prodi,
            'kode_pl' => $request->input('kode_pl'),
            'deskripsi_pl' => $request->input('deskripsi_pl'),
            'unsur' => $request->input('unsur'),
            'referensi' => $request->input('referensi'),
        ]);

        // Redirect
        return to_route('profil.lulusan.index')->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Created Success"
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('Main/KoorProdi/Feature/ProfilLulusan/FormEdit', [
            'profil_lulusan' => ProfilLulusan::select('id_pl', 'kode_pl', 'deskripsi_pl', 'unsur', 'referensi')->find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            // Check If user exist
            $profil = ProfilLulusan::findOrFail($id);

            $request->validate([
                "kode_pl" => "required|max:4|min:4",
                "deskripsi_pl" => "required",
                "unsur" => "required",
                "referensi" => "required",
            ]);

            // Update
            $profil->kode_pl = $request->input('kode_pl');
            $profil->deskripsi_pl = $request->input('deskripsi_pl');
            $profil->unsur = $request->input('unsur');
            $profil->referensi = $request->input('referensi');

            // Save Update
            $profil->save();

            // Redirect
            return to_route('profil.lulusan.index')->with("msg", [
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
            $profil = ProfilLulusan::findOrFail($id);

            // Delete
            $profil->delete();

            // Redirect
            return to_route('profil.lulusan.index')->with("msg", [
                "type" => "success", // success | error | warning | info | question
                "text" => "Deleted Success"
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
