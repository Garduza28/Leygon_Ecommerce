<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compra; // Importa el modelo Compra

class PedidosController extends Controller
{
    public function index()
    {
        // Obtener las compras y ordenarlas por fecha de orden descendente
        $compras = Compra::with('user')
                         ->orderBy('created_at', 'desc')
                         ->get();

        return view('admin.products.index_pedidos', compact('compras'));
    }

    public function update(Request $request, $id)
    {
        $compra = Compra::findOrFail($id);

        // Validación de los datos del formulario
        $request->validate([
            'estatus' => 'required|in:En camino,Pendiente,Cancelado,Entregado', // Asegura que el estatus sea uno de los valores permitidos
        ]);

        // Guardar el estatus en la compra
        $compra->estatus = $request->estatus;
        $compra->save();

        return redirect()->route('admin.products.pedidos')->with('success', 'Estatus actualizado correctamente');
    }

    public function show($id)
    {
        $compra = Compra::with('user')->findOrFail($id);
        return view('admin.products.pedidos', compact('compra')); // Cambiado a la vista pedidos.blade.php
    }
}