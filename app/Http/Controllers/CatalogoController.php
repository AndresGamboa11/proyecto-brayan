<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Auto;

class CatalogoController extends Controller
{
    public function mostrarPorMarca($marca)
    {
        $autos = Auto::where('marca', $marca)->get();

        if (Auth::user()->role === 'administrador') {
            return view('dashboard-admin', compact('autos', 'marca'));
        } else {
            return view('dashboard-user', compact('autos', 'marca'));
        }
    }
}
