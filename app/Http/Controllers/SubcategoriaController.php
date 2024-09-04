<?php

namespace App\Http\Controllers;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    public function obtenerSubcategorias(Request $request, $clasificationId)
    {
        // Filtra las subcategorías por el campo clasification_id
        $subcategorias = Subcategoria::where('clasification_id', $clasificationId)->get();
      
        return response()->json($subcategorias);
        
    }
}

