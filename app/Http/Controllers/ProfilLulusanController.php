<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\Auth;

class ProfilLulusanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        return Inertia::render('Main/KoorProdi/Feature/PL', [
            'pl' => ProfilLulusan::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('kode_pl', 'like', "%{$search}%")
                        ->OrWhere('unsur', 'like', "%{$search}%")
                        ->OrWhere('deskripsi_pl', 'like', "%{$search}%")
                        ->OrWhere('referensi', 'like', "%{$search}%");
                })
                ->where('id_prodi', '=', $user->prodi)
                ->paginate(10)
                ->withQueryString(),
            'filters' => $request->only(["search"]),
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        //Validate
        $validatedData = $request->validate([
            "deskripsi_pl" => "required",
            "unsur" => "required",
            "referensi" => "required",
        ]);
        // dd($request->input('unsur'));
        // Save
        ProfilLulusan::createProfilLulusan([
            'id_prodi' => $user->prodi,
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

    public function update(Request $request, $id)
    {
        // Check If user exist
        $profil = ProfilLulusan::findOrFail($id);

        $request->validate([
            "deskripsi_pl" => "required",
            "unsur" => "required",
            "referensi" => "required",
        ]);

        // Update
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
    }

    public function destroy($id)
    {
        // Check If user exist
        $profil = ProfilLulusan::findOrFail($id);

        // Delete
        $profil->delete();

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Deleted Success"
        ]);
    }
}
