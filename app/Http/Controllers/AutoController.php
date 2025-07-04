<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auto;
use Illuminate\Support\Facades\File;

class AutoController extends Controller
{
    public function dashboardUser()
    {
            $autos = Auto::all(); // 
            return view('dashboard-user', compact('autos'));
        }

        public function dashboardAdmin()
        {
            $autos = Auto::all(); // 
            return view('dashboard-admin', compact('autos'));
        }
        public function show($id)
        {
            $auto = Auto::findOrFail($id);
            return view('autos.show', compact('auto'));
        }
    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Guardar imagen
        $nombreImagen = time() . '.' . $request->imagen->extension();
        $request->imagen->move(public_path('uploads'), $nombreImagen);

        // Crear auto
        Auto::create([
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen' => $nombreImagen,
        ]);

        return redirect()->back()->with('success', 'Auto añadido con éxito');
    }
    public function edit($id)
    {
        $auto = Auto::findOrFail($id);
        return view('autos.edit', compact('auto'));
    }
    public function destroy($id)
    {
        $auto = Auto::findOrFail($id);

        // Elimina la imagen físicamente si existe
        $ruta = public_path('uploads/' . $auto->imagen);
        if (File::exists($ruta)) {

            File::delete($ruta);
        }

        $auto->delete();

        return redirect()->route('dashboard-admin')->with([
            'success' => 'Auto eliminado correctamente.',
            'marca' => strtolower($auto->marca)
        ]);}

}