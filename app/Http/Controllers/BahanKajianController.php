<?php

namespace App\Http\Controllers;

use App\Models\BahanKajian;
use Inertia\Inertia;
use Illuminate\Http\Request;

class BahanKajianController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Main/KoorProdi/Feature/BahanKajian/BahanKajian', [
            'bahan_kajian' => BahanKajian::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('kode_bk', 'like', "%{$search}%")
                        ->OrWhere('nama_bk', 'like', "%{$search}%")
                        ->OrWhere('deskripsi_bk', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString(),
            'filters' => $request->only(["search"]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Main/KoorProdi/Feature/BahanKajian/FormAdd');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        //Validate
        $validatedData = $request->validate([
            "kode_bk" => "required|min:4|max:4|alpha_num",
            "nama_bk" => "required",
            "deskripsi_bk" => "required",
            "bobot_min" => "required|numeric",
            "bobot_max" => "required|numeric",
        ]);

        // Save
        $bahan_kajian = BahanKajian::create([
            'id_prodi' => $user->prodi,
            'kode_bk' => $request->input('kode_bk'),
            'nama_bk' => $request->input('nama_bk'),
            'deskripsi_bk' => $request->input('deskripsi_bk'),
            'bobot_min' => $request->input('bobot_min'),
            'bobot_max' => $request->input('bobot_max'),
        ]);

        // Redirect
        return to_route('bahan.kajian.index')->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Created Success"
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('Main/KoorProdi/Feature/BahanKajian/FormEdit', [
            'bk' => BahanKajian::select('id_bk', 'kode_bk', 'nama_bk', 'deskripsi_bk', 'bobot_min', 'bobot_max')->find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        // Check If user exist
        $bk = BahanKajian::findOrFail($id);

        $request->validate([
            "kode_bk" => "required|min:4|max:4|alpha_num",
            "nama_bk" => "required",
            "deskripsi_bk" => "required",
            "bobot_min" => "required|numeric",
            "bobot_max" => "required|numeric",
        ]);

        // Update
        $bk->kode_bk = $request->input('kode_bk');
        $bk->nama_bk = $request->input('nama_bk');
        $bk->deskripsi_bk = $request->input('deskripsi_bk');
        $bk->bobot_max = $request->input('bobot_max');
        $bk->bobot_min = $request->input('bobot_min');

        // Save Update
        $bk->save();

        // Redirect
        return to_route('bahan.kajian.index')->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Updated Success"
        ]);
    }

    public function destroy($id)
    {
        // Check If data exist
        $bk = BahanKajian::findOrFail($id);

        // Delete
        $bk->delete();

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Deleted Success"
        ]);
    }
}
