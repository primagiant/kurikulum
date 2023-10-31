<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Main/SuperAdmin/Account/Prodi/Prodi', [
            'prodis' => Prodi::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('kode_prodi', 'like', "%{$search}%")
                        ->OrWhere('nama_prodi', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString(),
            'filters' => $request->only(["search"]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Main/SuperAdmin/Account/Prodi/FormAdd');
    }

    public function store(Request $request)
    {
        //Validate
        $validatedData = $request->validate([
            "kode_prodi" => "required|alpha_num|max:12",
            "nama_prodi" => "required",
        ]);

        // Save
        Prodi::create([
            'kode_prodi' => $request->input('kode_prodi'),
            'nama_prodi' => $request->input('nama_prodi'),
            'active' => 1,
        ]);

        // Redirect
        return to_route('prodi.index')->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Created Success"
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('Main/SuperAdmin/Account/Prodi/FormEdit', [
            'prodi' => Prodi::select('id_prodi', 'kode_prodi', 'nama_prodi')->find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);

        //Validate
        $request->validate([
            "kode_prodi" => "required|alpha_num|max:12",
            "nama_prodi" => "required",
        ]);

        // Update
        $prodi->kode_prodi = $request->input('kode_prodi');
        $prodi->nama_prodi = $request->input('nama_prodi');

        // Save Update
        $prodi->save();

        // Redirect
        return to_route('prodi.index')->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Updated Success"
        ]);
    }

    public function destroy($id)
    {
        // Check If user exist
        $prodi = Prodi::findOrFail($id);

        // Delete
        $prodi->delete();

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Deleted Success"
        ]);
    }
}
