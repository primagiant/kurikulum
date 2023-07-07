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
                    $query->where('kode_kode', 'like', "%{$search}%")
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
            "kode_bk" => "required",
            "nama_bk" => "required",
            "deskripsi_bk" => "required",
            "bobot_min" => "required",
            "bobot_max" => "required",
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
}
