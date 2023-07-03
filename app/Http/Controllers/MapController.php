<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MapController extends Controller
{
    public function cplToPl()
    {
        return Inertia::render("Main/KoorProdi/Feature/Map/CplToPl");
    }

    public function bkToCpl()
    {
        return Inertia::render("Main/KoorProdi/Feature/Map/BkToCpl");
    }

    public function bkToMk()
    {
        return Inertia::render("Main/KoorProdi/Feature/Map/BkToMk");
    }

    public function cplToMk()
    {
        return Inertia::render("Main/KoorProdi/Feature/Map/CplToMk");
    }
}
