<?php

namespace App\Http\Controllers;

use App\Models\clasifications;
use Illuminate\Http\Request;

class GetclasisController extends Controller
{
    public function getByCategory($category)
    {
        // Recuperar las clasificaciones donde id_category sea igual a la categoría proporcionada
        $clasificaciones = clasifications::where('category_id', $category)->get();

        // Devolver las clasificaciones en formato JSON
        return response()->json($clasificaciones);
    }
}
