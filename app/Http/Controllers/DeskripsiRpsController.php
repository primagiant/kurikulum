<?php

namespace App\Http\Controllers;

use App\Models\DeskripsiRps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeskripsiRpsController extends Controller
{
    public function store(Request $request, $id_rps)
    {
        // Save
        DeskripsiRps::create([
            'id_rps' => $id_rps,
            'pertemuan' => $request->input('pertemuan'),
            'id_bk' => $request->input('id_bk'),
            'bentuk_pembelajaran_synchronous' => $request->input('bentuk_pembelajaran_synchronous'),
            'bentuk_pembelajaran_asynchronous' => $request->input('bentuk_pembelajaran_asynchronous'),
            'waktu' => $request->input('waktu'),
            'tugas_dan_penilaian' => $request->input('tugas_dan_penilaian'),
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
        $deskripsiRps = DeskripsiRps::findOrFail($id);

        // Update
        $deskripsiRps->id_bk = $request->input('id_bk');
        $deskripsiRps->bentuk_pembelajaran_synchronous = $request->input('bentuk_pembelajaran_synchronous');
        $deskripsiRps->bentuk_pembelajaran_asynchronous = $request->input('bentuk_pembelajaran_asynchronous');
        $deskripsiRps->waktu = $request->input('waktu');
        $deskripsiRps->tugas_dan_penilaian = $request->input('tugas_dan_penilaian');

        // Save Update
        $deskripsiRps->save();

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Changes Have Been Saved"
        ]);
    }

    public function updateAll(Request $request)
    {
        DB::beginTransaction();
        try {
            for ($i = 0; $i < 16; $i++) {
                // Check If user exist
                $deskripsiRps = DeskripsiRps::findOrFail($request->input($i)['id_deskripsi_rps']);

                // Update
                $deskripsiRps->id_bk = $request->input($i)['id_bk'];
                $deskripsiRps->bentuk_pembelajaran_synchronous = $request->input($i)['bentuk_pembelajaran_synchronous'];
                $deskripsiRps->bentuk_pembelajaran_asynchronous = $request->input($i)['bentuk_pembelajaran_asynchronous'];
                $deskripsiRps->waktu = $request->input($i)['waktu'];
                $deskripsiRps->tugas_dan_penilaian = $request->input($i)['tugas_dan_penilaian'];

                // Save Update
                $deskripsiRps->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Changes Have Been Saved"
        ]);
    }
}
