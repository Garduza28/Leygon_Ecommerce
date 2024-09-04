<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    public function mostrarFormulario()
    {
        $categories = Category::all();
        $user = auth()->user();
        $subcategorias = Category::with('clasificaciones')->get();
        return view('perfil', compact('user', 'categories', 'subcategorias'));
    }

    public function actualizarDatos(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string',
            'apellido' => 'required|string',
            'numero_telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
            'exterior_interior' => 'nullable|string',
            'codigo_postal' => 'nullable|string',
            'municipio' => 'required|string',
            'estado' => 'nullable|string',
            'instrucciones' => 'nullable|string',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'pais' => 'nullable|string',
            'region' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $requestData = $request->except('imagen');
        foreach ($requestData as $key => $value) {
            if (is_string($value)) {
                $requestData[$key] = ucwords(mb_strtolower($value));
            }
        }

        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $requestData['image_url'] = asset('storage/images/' . $imageName);
        }

        try {
            $user->update($requestData);
            return redirect()->route('perfil.formulario')->with('success', 'Datos actualizados con éxito');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Error al actualizar los datos.');
        }
    }

    public function subirOActualizarImagen(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($user->image_url) {
                Storage::delete('public/' . basename($user->image_url));
            }

            $imagen = $request->file('imagen');
            $rutaImagen = $imagen->store('images', 'public');
            $user->image_url = asset('storage/' . $rutaImagen);
            $user->save();

            return redirect()->back()->with('success', 'Imagen actualizada correctamente.');
        } else {
            return redirect()->back()->with('error', 'No se ha seleccionado ninguna imagen.');
        }
    }
    public function actualizarDatos2(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'apellido' => 'nullable|string',
            'direccion' => 'nullable|string',
            'numero_telefono' => 'nullable|string',
            'calle' => 'nullable|string',
            'estado' => 'nullable|string',
            'codigo_postal' => 'nullable|string',
            'pais' => 'nullable|string',
            'exterior_interior' => 'nullable|string',
            'instrucciones' => 'nullable|string',
        ]);
        try {
            $user->update($request->all());

            // Verificar si la solicitud espera una respuesta JSON
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Datos actualizados correctamente'], 200);
            }

            // Si no se espera una respuesta JSON, redirigir de nuevo con un mensaje de éxito
            return redirect()->back()->with('success', 'Datos actualizados con éxito');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            // Manejar el error de acuerdo a la expectativa de la solicitud
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Error al actualizar los datos.'], 500);
            }

            return redirect()->back()->with('error', 'Error al actualizar los datos.');
        }
    }
}