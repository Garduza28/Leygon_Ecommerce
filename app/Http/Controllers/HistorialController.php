<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Compra;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    public function history()
    {
        $subcategorias = Category::with('clasificaciones')->get();
        $user = auth()->user();

        // Obtener las compras del usuario autenticado y ordenarlas por fecha de creación en orden descendente
        $compras = Compra::with('devolucion')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Validar y actualizar el estatus de las compras basándose en el JSON de cada compra
        foreach ($compras as $compra) {
            // Solo validar si no ha sido validada previamente
            if (!$compra->validated) {
                // Decodificar el JSON para obtener los datos de la compra
                $compraData = json_decode($compra->data, true);

                // Verificar el campo 'status' en el JSON y actualizar 'estatus' en consecuencia
                if (isset($compraData['status'])) {
                    if ($compraData['status'] === 'APROBADO') {
                        $compra->estatus = 'Pendiente';
                    } elseif ($compraData['status'] === 'FALLADO') {
                        $compra->estatus = 'Cancelado';
                    }
                }

                // Marcar la compra como validada
                $compra->validated = true;
                $compra->save(); // Guardar cambios en la base de datos
            }
        }

        return view('historial_compras', compact('subcategorias', 'compras'));
    }
}