<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\BahanKajian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BahanKajianController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        return Inertia::render('Main/KoorProdi/Feature/BK', [
            'bk' => BahanKajian::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('kode_bk', 'like', "%{$search}%")
                        ->OrWhere('nama_bk', 'like', "%{$search}%")
                        ->OrWhere('deskripsi_bk', 'like', "%{$search}%");
                })
                ->where('id_prodi', '=', $user->prodi)
                ->orderby('kode_bk')
                ->paginate(10)
                ->withQueryString(),
            'filters' => $request->only(["search"]),
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        //Validate
        $request->validate([
            "nama_bk" => "required",
            "deskripsi_bk" => "required",
            "bobot_min" => "required|numeric",
            "bobot_max" => "required|numeric",
        ]);

        // Save
        BahanKajian::createBk([
            'id_prodi' => $user->prodi,
            'nama_bk' => $request->input('nama_bk'),
            'deskripsi_bk' => $request->input('deskripsi_bk'),
            'bobot_min' => $request->input('bobot_min'),
            'bobot_max' => $request->input('bobot_max'),
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
        $bk = BahanKajian::findOrFail($id);

        $request->validate([
            "nama_bk" => "required",
            "deskripsi_bk" => "required",
            "bobot_min" => "required|numeric",
            "bobot_max" => "required|numeric",
        ]);

        // Update
        $bk->nama_bk = $request->input('nama_bk');
        $bk->deskripsi_bk = $request->input('deskripsi_bk');
        $bk->bobot_max = $request->input('bobot_max');
        $bk->bobot_min = $request->input('bobot_min');

        // Save Update
        $bk->save();

        // Redirect
        return redirect()->back()->with("msg", [
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
