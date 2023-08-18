<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\MataKuliah;
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

    public function store()
    {
        // $user = Auth::user();
        // return Inertia::render('Main/KoorProdi/Pengampuan', [
        //     'dosen' => User::select('id', 'name')
        //         ->where('prodi', $user->prodi)
        //         ->get(),
        //     'mk' => MataKuliah::select('id_mk', 'kode_mk_obe', 'kode_mk_undiksha', 'nama_mk', 'deskripsi_mk')
        //         ->where('id_prodi', $user->prodi)
        //         ->where('active', 1)
        //         ->get(),
        //     'pengampuan' => DB::table('pengampuan')
        //         ->join('users', 'pengampuan.user_id', '=', 'users.id')
        //         ->join('mata_kuliah', 'pengampuan.id_mk', '=', 'mata_kuliah.id_mk')
        //         ->where('mata_kuliah.id_prodi', 1)
        //         ->get(),
        // ]);
        dd("Berhasil");
    }
}
