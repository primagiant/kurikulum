<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\MataKuliah;
use App\Models\Pengampuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PengampuanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('Main/KoorProdi/Pengampuan', [
            'dosen' => User::select('id', 'name')
                ->where('prodi', $user->prodi)
                ->get(),
            'mk' => MataKuliah::select('id_mk', 'kode_mk_obe', 'kode_mk_undiksha', 'nama_mk', 'deskripsi_mk')
                ->where('id_prodi', $user->prodi)
                ->where('active', 1)
                ->get(),
            'pengampuan' => DB::table('pengampuan')
                ->join('users', 'pengampuan.user_id', '=', 'users.id')
                ->join('mata_kuliah', 'pengampuan.id_mk', '=', 'mata_kuliah.id_mk')
                ->where('mata_kuliah.id_prodi', 1)
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $id_mk = $request->input('id_mk');
        $id_dosen = $request->input('id_dosen');

        $exists = false;
        $maping = Pengampuan::whereHas('user', function ($query) {
            $query->where('prodi', 1);
        })->select('id_mk', 'user_id')->get();
        foreach ($maping as $item) {
            if ($item->id_mk == $id_mk && $item->user_id == $id_dosen) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            // Delete Relation
            $pengampuan = Pengampuan::where('id_mk', $id_mk)
                ->where('user_id', $id_dosen)
                ->first();
            $pengampuan->delete();
        } else {
            // Create Relation
            Pengampuan::create([
                'id_mk' => $id_mk,
                'user_id' => $id_dosen,
            ]);
        }
    }
}
