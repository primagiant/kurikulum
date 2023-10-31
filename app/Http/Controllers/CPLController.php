<?php

namespace App\Http\Controllers;

use App\Models\CPL;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CPLController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        return Inertia::render('Main/KoorProdi/Feature/CPL', [
            'cpl' => CPL::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('kode_cpl', 'like', "%{$search}%")
                        ->OrWhere('unsur', 'like', "%{$search}%")
                        ->OrWhere('deskripsi_cpl', 'like', "%{$search}%")
                        ->OrWhere('referensi', 'like', "%{$search}%");
                })
                ->where('id_prodi', '=', $user->prodi)
                ->orderBy('kode_cpl')
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
            "deskripsi_cpl" => "required",
            "unsur" => "required",
            "referensi" => "required",
        ]);

        // Save
        CPL::createCPL([
            'id_prodi' => $user->prodi,
            'deskripsi_cpl' => $request->input('deskripsi_cpl'),
            'unsur' => $request->input('unsur'),
            'referensi' => $request->input('referensi'),
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
        $cpl = CPL::findOrFail($id);

        $request->validate([
            "deskripsi_cpl" => "required",
            "unsur" => "required",
            "referensi" => "required",
        ]);

        // Update
        $cpl->deskripsi_cpl = $request->input('deskripsi_cpl');
        $cpl->unsur = $request->input('unsur');
        $cpl->referensi = $request->input('referensi');

        // Save Update
        $cpl->save();

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Updated Success"
        ]);
    }

    public function destroy($id)
    {
        // Check If data exist
        $cpl = CPL::findOrFail($id);

        // Delete
        $cpl->delete();

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Deleted Success"
        ]);
    }
}
