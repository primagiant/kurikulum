<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $roleName = $user->roles()->pluck('name')[0];
        if ($roleName == "super_admin") {
            return Inertia::render('Main/SuperAdmin/Dashboard');
        }
        return Inertia::render('Main/KoorProdi/Dashboard');
    }

    public function landing()
    {
        return Inertia::render('Landing');
    }
}
