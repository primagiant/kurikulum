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
}
