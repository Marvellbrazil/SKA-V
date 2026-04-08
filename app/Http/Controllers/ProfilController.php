<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\Marquee;

class ProfilController extends Controller
{
    public function index()
    {
        // Ambil data profil pertama
        $profil = Profil::first();

        return view('profil', ['profil' => $profil]);
    }
}
