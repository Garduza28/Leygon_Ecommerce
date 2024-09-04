<?php
namespace App\Http\Controllers;

use App\Models\clasifications;
use Illuminate\Http\Request;

class ClasificacionController extends Controller
{
    public function obtenerClasificaciones(Request $request, $categoryId)
    {
        $clasificaciones = clasifications::where('category_id', $categoryId)->get();
        return response()->json($clasificaciones);
    }
}